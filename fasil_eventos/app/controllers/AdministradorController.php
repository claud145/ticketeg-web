<?php

use EntradasEventos\Entities\Eventos;
use EntradasEventos\Entities\User;
use EntradasEventos\Entities\Entregas;
use EntradasEventos\Entities\Entradafisicaventas;
use EntradasEventos\Entities\Ventasfisicas;
use EntradasEventos\Repositories\EventoRepo;

class AdministradorController extends BaseController {

    public function indexLogin() {
        return View::make('administrador/login');
        //dd($latest_eventos);
    }

    public function index() {
        return View::make('administrador/homeadmin');
        //dd($latest_eventos);
    }

    public function loginadminpost() {
        $data = Input::all();

        $credentials = ['email' => $data['email'], 'password' => $data['password']];
        //$eventoid = Input::get('evento_id');
        //$slug = Input::get('slug');

        if (Auth::attempt($credentials)) {
            //$urlx = Redirect::back();
            //return Redirect::to($url); // domain.com/welcome#hash
            return Redirect::to('administrador/dashboard');
        } else {
            return Redirect::back();
        }

        $auxurl = Redirect::back()->withErrors();

        return Redirect::to($auxurl)->withErrors()->withInput();

        //dd($credentials);
    }

    public function canjeEntradas() {
        //layoutcanje
        //administrador/canje/verificacion
        //administrador/canje/exitosa
        //administrador/canje/fallido
        return View::make('administrador/canje/verificacion');
    }

    public function ventaEntradaFisica() {
        return View::make('administrador/ventaEntradaFisica/verificacion');
    }

    public function entradaFisicaVerificar() {
        $result = array(
          'exito' => false,
          'mensaje' => 'Error inesperado. Consulte con el administrador.',
          'datos' => null
        );

        $data = Input::all();
        $codigos = explode('|', $data['codigos']);

        $query = DB::select('select entradafisicaventas.id, entradafisicaventas.entregado, sectorhorarios.id as id_sector, sectorhorarios.precio_sector, sectorhorarios.nombre_sector
                         from entradafisicaventas
                         inner join sectorhorarios on sectorhorarios.id = entradafisicaventas.sector_evento
                         where entradafisicaventas.codigo_entrada = "' . $data['codigo_venta'] . '"');
        
        if ($query != null) {
            if ($query[0]->entregado != 1) {
                if (!in_array($query[0]->id, $codigos)) {
                    $result['exito'] = true;
                    $result['mensaje'] = '';
                    $result['datos'] = $query[0];
                }
                else
                    $result['mensaje'] = 'La entrada ya se encuentra enlistada para ser vendida'; 
            }
            else
                $result['mensaje'] = 'Entrada ya entregada'; 
        }
        else
            $result['mensaje'] = 'Entrada no encontrada';

        return Response::json($result);
    }

    public function venderEntradaFisica() {
        $result = array(
          'exito' => false,
          'mensaje' => 'Error inesperado. Consulte con el administrador.',
        );

        $data = Input::all();
        $codigos = explode('|', $data['codigos']);

        if (count($codigos) > 0) {
            $clienteSamsung = $data['cliente_samsung'];
            $emailSamsung = trim($data['email_samsung']);

            if ($clienteSamsung == 0) {
                $ventas = Ventasfisicas::create(
                    ['cliente_samsung_plus' => $clienteSamsung,
                        'estado_venta' => 0,
                        'vendedor_ubicacion' => Auth::user()->ubicacion,
                        'id_vendedor' => Auth::user()->id
                    ]
                );

                foreach ($codigos as $codigo) {
                    $Entradafisicaventas = Entradafisicaventas::find($codigo);

                    if ($Entradafisicaventas->entregado == 0) {
                        if ($ventas->estado_venta == 0) {
                            $ventas->estado_venta = 1;

                            $ventas->save();
                        }

                        $Entradafisicaventas->entregado = 1;
                        $Entradafisicaventas->id_ventas_fisicas = $ventas->id;

                        $Entradafisicaventas->save();
                    }
                }

                if ($ventas->estado_venta == 1) {
                    $result['exito'] = true;
                    $result['mensaje'] = '';
                }
                else
                    $result['mensaje'] = 'Debe registrar al menos un ticket para realizar la venta. Verifique e intente nuevamente.';
            } else if ($clienteSamsung == 1 && $emailSamsung != '') {
                $ventas = Ventasfisicas::create(
                    ['cliente_samsung_plus' => $clienteSamsung,
                        'email_samsung_plus' => $emailSamsung,
                        'estado_venta' => 0,
                        'vendedor_ubicacion' => Auth::user()->ubicacion,
                        'id_vendedor' => Auth::user()->id
                    ]
                );

                foreach ($codigos as $codigo) {
                    $Entradafisicaventas = Entradafisicaventas::find($codigo);

                    if ($Entradafisicaventas->entregado == 0) {
                        if ($ventas->sector_samsung_plus == null) {
                            $ventas->estado_venta = 1;
                            $ventas->sector_samsung_plus = $Entradafisicaventas->sector_evento;
                            $ventas->cantidad_samsung_plus = 1;

                            $ventas->save();
                        }
                        
                        $Entradafisicaventas->entregado = 1;
                        $Entradafisicaventas->id_ventas_fisicas = $ventas->id;

                        $Entradafisicaventas->save();
                    }
                }

                if ($ventas->estado_venta == 1) {
                    $result['exito'] = true;
                    $result['mensaje'] = '';

                    $encrypt = $this->encryptText('[s]' . $ventas->id);

                    $this->sendMail($emailSamsung, $ventas->id, $encrypt);
                }
                else
                    $result['mensaje'] = 'Debe registrar al menos un ticket para realizar la venta. Verifique e intente nuevamente.';
            }
            else
                $result['mensaje'] = 'La dirección de correo es requerida para los clientes samsung plus';
        }
        else
            $result['mensaje'] = 'El monto a cobrar debe ser mayor a 0';

        return Response::json($result);
    }

    public function buscarinterno($userTelefono) {
        $queryusuario = DB::select('select ventas.id, users.user_nombre, ventas.estado_venta, users.email, users.user_ci, ventas.created_at, sectorhorarios.nombre_sector, sectorhorarios.precio_sector, ventas.cantidad_venta, entregas.id_venta, (ventas.cantidad_venta * sectorhorarios.precio_sector) as monto_total
            from ventas
            inner join users on ventas.user_venta = users.id
            inner join sectorhorarios on ventas.sector_evento = sectorhorarios.id
            left join entregas on ventas.id = entregas.id_venta
            where users.user_telefono = "' . $userTelefono . '"
            order by ventas.id');

        return View::make('administrador/usuario/buscarUsuario', compact('queryusuario', 'userTelefono'));
    }

    public function canjearBusqueda() {
        $data = Input::all();
        $queryEntregado = DB::select('select * from entregas where entregas.id_venta =' . $data['codigo_venta']);
        if ($queryEntregado == null) {
            $queryVenta = DB::select('select ventas.id, users.id AS user_id, sectorhorarios.id AS id_sector, users.user_nombre, users.email, users.user_telefono, users.user_ci, sectorhorarios.nombre_sector, ventas.cantidad_venta,
       ventas.cantidad_venta * sectorhorarios.precio_sector AS monto_total
       from ventas INNER JOIN users ON ventas.user_venta = users.id INNER JOIN sectorhorarios ON ventas.sector_evento = sectorhorarios.id
       where ventas.estado_venta=1 AND ventas.id = ' . $data['codigo_venta'] . ' ORDER BY ventas.id');
            if ($queryVenta != null) {
                foreach ($queryVenta as $queryVentas) {
                    Entregas::create(
                            ['user_venta' => $queryVentas->user_id,
                                'evento_venta' => 1,
                                'sector_evento' => $queryVentas->id_sector,
                                'estado_venta' => 1,
                                'cantidad_venta' => $queryVentas->cantidad_venta,
                                'id_venta' => $data['codigo_venta'],
                                'entregado' => 1,
                                'vendedor_ubicacion' => $data['ubicacion'],
                                'id_vendedor' => $data['user_id']
                            ]
                    );
                }
                return $this->buscarinterno($data['telefono']);
            }
        } else {
            return dd('ya fue queryEntregado');
        }

        return Redirect::back();
    }

    public function canjear() {
        $data = Input::all();
        $codigo_venta = (int) Input::get('codigo_venta');
        $queryVenta = DB::select('select ventas.id, users.id AS user_id, sectorhorarios.id AS id_sector, users.user_nombre, users.email, users.user_telefono, users.user_ci, sectorhorarios.nombre_sector, ventas.cantidad_venta,
       ventas.cantidad_venta * sectorhorarios.precio_sector AS monto_total
       from ventas INNER JOIN users ON ventas.user_venta = users.id INNER JOIN sectorhorarios ON ventas.sector_evento = sectorhorarios.id
       where ventas.estado_venta=1 AND ventas.id = ' . $codigo_venta . ' ORDER BY ventas.id');

        foreach ($queryVenta as $queryVentas) {
            Entregas::create(
                    ['user_venta' => $queryVentas->user_id,
                        'evento_venta' => 1,
                        'sector_evento' => $queryVentas->id_sector,
                        'estado_venta' => 1,
                        'cantidad_venta' => $queryVentas->cantidad_venta,
                        'id_venta' => $codigo_venta,
                        'entregado' => 1,
                        'vendedor_ubicacion' => $data['ubicacion'],
                        'id_vendedor' => $data['user_id']
                    ]
            );
        }
        return View::make('administrador/canje/verificacion');
    }

    public function canjeVerificar() {
        $data = Input::all();
        //18 = 03GLoBr/B2M=
        //19 = ekkEF8dgklo=
        $codigo_venta = (int) $this->decryptText(Input::get('codigo_venta'));

        $queryEntregado = DB::select('select * from entregas where entregas.id_venta = ' . $codigo_venta);

        if ($queryEntregado == null) {
            $queryVenta = DB::select('select ventas.id, users.id AS user_id, sectorhorarios.id AS id_sector, users.user_nombre, users.email, users.user_telefono, users.user_ci, sectorhorarios.nombre_sector, ventas.cantidad_venta,
       ventas.cantidad_venta * sectorhorarios.precio_sector AS monto_total, sectorhorarios.precio_sector
       from ventas INNER JOIN users ON ventas.user_venta = users.id INNER JOIN sectorhorarios ON ventas.sector_evento = sectorhorarios.id
       where ventas.estado_venta=1 AND ventas.id = ' . $codigo_venta . ' ORDER BY ventas.id');
            if ($queryVenta != null) {
                return View::make('administrador/canje/exitosa', compact('queryVenta'));
            } else {
                return View::make('administrador/canje/nullentrada');
            }

            return dd($queryVentasshow);
        } else {
            $queryVenta = DB::select('select ventas.id, users.id AS user_id, sectorhorarios.id AS id_sector, users.user_nombre, users.email, users.user_telefono, users.user_ci, sectorhorarios.nombre_sector, ventas.cantidad_venta,
       ventas.cantidad_venta * sectorhorarios.precio_sector AS monto_total, sectorhorarios.precio_sector
       from ventas INNER JOIN users ON ventas.user_venta = users.id INNER JOIN sectorhorarios ON ventas.sector_evento = sectorhorarios.id
       where ventas.estado_venta=1 AND ventas.id = ' . $codigo_venta . ' ORDER BY ventas.id');
            return View::make('administrador/canje/fallido', compact('queryVenta', 'queryEntregado'));
        }
        return dd('nel');
    }

    public function showbuscar() {
        $queryusuario = null;
        return View::make('administrador/usuario/buscarUsuario', compact('queryusuario'));
    }

    public function usuariobuscar() {
        $data = Input::all();
        $userTelefono = Input::get('user_telefono');
        $queryusuario = DB::select('select ventas.id, users.user_nombre, ventas.estado_venta, users.email, users.user_ci, ventas.created_at, sectorhorarios.nombre_sector, sectorhorarios.precio_sector, ventas.cantidad_venta, entregas.id_venta, (ventas.cantidad_venta * sectorhorarios.precio_sector) as monto_total
            from ventas
            inner join users on ventas.user_venta = users.id
            inner join sectorhorarios on ventas.sector_evento = sectorhorarios.id
            left join entregas on ventas.id = entregas.id_venta
            where users.user_telefono = "' . $data['user_telefono'] . '"
            order by ventas.id');
        
        return View::make('administrador/usuario/buscarUsuario', compact('queryusuario', 'userTelefono'));
    }

    public function showEntregasFechaSector() {
        $allEntregados_g = null;
        return View::make('administrador/entregas/entregasFechaSectores',compact('allEntregados_g'));
    }

    public function buscarEntregasFechaSector(){
        $dataFecha = Input::all();
        $fecha = Input::get('fecha');
        
        $allEntregados_g = DB::select('
            select entregas.id_venta, 
                users.user_nombre, 
                entregas.estado_venta, 
                users.email, 
                users.user_ci, 
                entregas.created_at, 
                sectorhorarios.nombre_sector, 
                sectorhorarios.precio_sector, 
                entregas.cantidad_venta,
                (entregas.cantidad_venta * sectorhorarios.precio_sector) as monto_total 
            from entregas
            inner join users on entregas.user_venta = users.id 
            inner join sectorhorarios on entregas.sector_evento = sectorhorarios.id  
            where entregas.created_at like "'.$dataFecha['fecha'].'%"');

        $EntregadosPorSectores_c = DB::select('
            select sum(e.cantidad_venta) as entregas,
                sh.nombre_sector as sector,
                sh.id, e.vendedor_ubicacion
            from ventas v
            inner join sectorhorarios sh on sh.id = v.sector_evento
            inner join entregas e on e.id_venta = v.id
            where v.estado_venta = 1 and e.entregado = 1 and e.created_at like "'.$dataFecha['fecha'].'%"
            group by sh.nombre_sector');

        $EntregadosPorUbicacion_c = DB::select('
            select sum(e.cantidad_venta) as entregas,
                sh.nombre_sector as sector,
                sh.id, e.vendedor_ubicacion
            from ventas v
            inner join sectorhorarios sh on sh.id = v.sector_evento
            inner join entregas e on e.id_venta = v.id
            where v.estado_venta = 1 and e.entregado = 1 and e.created_at like "'.$dataFecha['fecha'].'%"
            group by e.vendedor_ubicacion');

        return View::make('administrador/entregas/entregasFechaSectores', compact('allEntregados_g','fecha', 'EntregadosPorSectores_c', 'EntregadosPorUbicacion_c'));
    }
 



    private function decryptText($cryptedText) {
        try {
            //$key = 'TV5NBUWTWEZT0H6ZQE69SC3D'; /* $key de sitio de pruebas */
            $key = 'PFNIIMTJ6K4OYDTUKQII8QNP';
            $plainText = $cryptedText;

            $mcopen = mcrypt_module_open(MCRYPT_TripleDES, '', MCRYPT_MODE_ECB, '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($mcopen), MCRYPT_RAND);
            $td = mcrypt_module_open('tripledes', '', 'ecb', '');
            $cryptedHash = '';

            if (mcrypt_generic_init($td, $key, $iv) != -1) {
                $cryptedHash = base64_decode($cryptedText);

                $plainText = mdecrypt_generic($td, $cryptedHash);

                mcrypt_generic_deinit($td);
                mcrypt_module_close($td);
            }

            return $plainText;
        } catch (Exception $ex) {
            return '';
        }
    }

    private function encryptText($plainText) {
        try {
            //$key = 'TV5NBUWTWEZT0H6ZQE69SC3D'; /* $key de sitio de pruebas */
            $key = 'PFNIIMTJ6K4OYDTUKQII8QNP';
            $cryptedText = $plainText;

            $mcopen = mcrypt_module_open(MCRYPT_TripleDES, '', MCRYPT_MODE_ECB, '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($mcopen), MCRYPT_RAND);
            $td = mcrypt_module_open('tripledes', '', 'ecb', '');
            $cryptedHash = '';

            if (mcrypt_generic_init($td, $key, $iv) != -1) {
                $cryptedHash = mcrypt_generic($td, $plainText);

                mcrypt_generic_deinit($td);
                mcrypt_module_close($td);

                $cryptedText = base64_encode($cryptedHash);
            }

            return $cryptedText;
        } catch (Exception $ex) {
            return '';
        }
    }

    private function sendMail($toEmail, $orderId, $encrypt) {
        $purchaseNumber = str_pad($orderId, 10, '0', STR_PAD_LEFT);
        $qrFile = public_path('tmp\\[s]' . $orderId . '.png');

        QrCode::format('png')->size(200)->generate($encrypt, $qrFile);

        Mail::queue('users.mails.test-samsung', array(
            'purchaseNumber' => $purchaseNumber,
            'qrFile' => $qrFile
                ), function($message) use ($toEmail) {
                    $message->to($toEmail)->cc('soporte@ticketeg.com.bo', 'TICKETEG')->subject('Recibiste una entrada adicional por cortesía de Samsung Club y Tigo!');
                });

        File::delete($qrFile);
    }

}

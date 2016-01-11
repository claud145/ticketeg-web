<?php

/**
 *
 */
use EntradasEventos\Repositories\EventoRepo;
use EntradasEventos\Entities\Eventos;
use EntradasEventos\Entities\Sectorhorario;
use EntradasEventos\Entities\Ventas;

class PeliculasController extends BaseController {

    protected $eventoRepo;

    public function __construct(EventoRepo $eventoRepo) {
        $this->eventoRepo = $eventoRepo;
    }

    public function pelicula() {
        $evento = $this->eventoRepo->all();

        return View::make('eventos/evento', compact('evento'));
    }

    public function tipoPelicula() {
        $evento = $this->eventoRepo->findTipoPeliculas();

        return View::make('eventos/eventoTipoPelicula', compact('evento'));
    }

    public function tipoConcierto() {
        $evento = $this->eventoRepo->findTipoConciertos();

        return View::make('eventos/eventoTipoConcierto', compact('evento'));
    }

    public function tipoPartido() {
        $evento = $this->eventoRepo->findTipoPartidos();

        return View::make('eventos/eventoTipoPartido', compact('evento'));
    }

    public function show($slug, $id) {
        $evento = $this->eventoRepo->find($id);
        $sector = Sectorhorario::where('evento', '=', $id)->get();
        $queryVentasSect = DB::select('select sh.id, sh.nombre_sector as Sector, sh.estado, sh.limitestock, IFNULL(SUM(v.cantidad_venta), 0) as Ventas from sectorhorarios as sh left join ventas as v on v.sector_evento = sh.id and v.estado_venta = 1 group by sh.id, Sector, sh.estado, sh.limitestock ORDER BY sh.orden_sector ASC;');


        return View::make('eventos/show', compact('evento', 'sector', 'queryVentasSect'));
    }

    public function showToBuy($id) {
        if (Auth::check()) {
            $venta = Ventas::find($id);
            $evento = $this->eventoRepo->find($venta->evento_venta);
            $sector = Sectorhorario::find($venta->sector_evento);

            return View::make('eventos/showToBuy', compact('evento', 'sector', 'venta'));
        }

        $auxurl = URL::route('pelicula', ['evento-tigo', '1']) . '#tigofest';

        return Redirect::to($auxurl);
    }

    public function continueToBuy() {
        $data = Input::only(['sector_id']);

        $rules = [
            'sector_id' => 'required',
        ];

        $messages = array(
            'sector_id.required' => 'Por favor, seleccione un sector del concierto'
        );

        $validation = \Validator::make($data, $rules, $messages);

        if ($validation->passes()) {
            $sector_id_precio = trim(Input::get('sector_id'));
            $sector = explode('_', $sector_id_precio);

            $idEvento = Input::get('evento_id');
            $idSector = $sector[0];
            $cantidad = trim(Input::get('cantidad_venta'));

            $venta = Ventas::create([
                        'evento_venta' => $idEvento,
                        'sector_evento' => $idSector,
                        'cantidad_venta' => $cantidad,
                        'estado_venta' => 0
            ]);

            $auxurl = (Auth::check() ? URL::route('buy', [$venta->id]) . '#tigofest' : URL::route('signUpToBuy', [$venta->id]) . '#forms');

            return Redirect::to($auxurl);
        }

        $auxurl = URL::route('pelicula', ['evento-tigo', '1']) . '#tigofest';

        return Redirect::to($auxurl)->withErrors($validation->messages())->withInput();
    }

    public function buyByTigoMoney() {
        $ventaId = Input::get('venta_id');
        $validacionTerminos = Input::get('validarcondicions');

        if ($validacionTerminos != NULL) {
            $venta = Ventas::find($ventaId);

            $horaLimite = strtotime('+10 minute' ,strtotime($venta->created_at));
            $ahora = time();

            if ($horaLimite >= $ahora) {
                if ($venta->estado_venta == '0') {
                    $query = DB::select('select sh.id, sh.nombre_sector as sector, sh.estado, sh.limitestock, IFNULL(SUM(v.cantidad_venta), 0) as cantidad_ventas from sectorhorarios as sh left join ventas as v on v.sector_evento = sh.id and v.estado_venta = 1 where sh.id = ' . $venta->sector_evento . ' group by sh.id, sector, sh.estado, sh.limitestock;');
                    
                    if ($query[0]->estado == '1') {
                        if ($query[0]->cantidad_ventas <= $query[0]->limitestock) {
                            $userId = Auth::user()->id;

                            $venta->user_venta = $userId;
                            $venta->save();

                            $ci = trim(Auth::user()->user_ci);
                            $nombreCompleto = trim(Auth::user()->user_nombre);
                            $telefono = trim(Auth::user()->user_telefono);
                            $precioSector = trim(Input::get('precio_sector'));
                            $email = trim(Auth::user()->email);
                            $nombreSector = trim(Input::get('nombre_sector'));

                            return $this->postTigomoney($venta, $ci, $nombreCompleto, $telefono, $precioSector, $email, $nombreSector);
                        }
                        else {
                            $auxurl = URL::route('buy', $ventaId) . '#tigofest';

                            return Redirect::to($auxurl)->with('validation', 'Ya no hay stock para la compra de tickets en el sector ' . $query[0]->sector . ', por favor intente una nueva compra en otro sector <a href="' . URL::route('pelicula', ['evento-tigo', '1']) . '#tigofest">aquí</a>');
                        }
                    }
                    else {
                        $auxurl = URL::route('buy', $ventaId) . '#tigofest';

                        return Redirect::to($auxurl)->with('validation', 'El sector ' . $query[0]->sector . ' no se encuentra habilitado para la compra, por favor intente una nueva compra en otro sector <a href="' . URL::route('pelicula', ['evento-tigo', '1']) . '#tigofest">aquí</a>');
                    }

                } else if ($venta->estado_venta == '1') {
                    $auxurl = URL::route('buy', $ventaId) . '#tigofest';

                    return Redirect::to($auxurl)->with('validation', 'La transacción ya ha sido procesada con anterioridad, si no ha recibido el correo electrónico de confirmación llamenos al teléfono 3257141 ó escribanos a <a href="mailto:soporte@ticketeg.com.bo">soporte@ticketeg.com.bo</a>');
                } else {
                    $auxurl = URL::route('buy', $ventaId) . '#tigofest';

                    return Redirect::to($auxurl)->with('validation', 'La transacción ya ha sido procesada con anterioridad, si desea realizar una nueva compra presione <a href="' . URL::route('pelicula', ['evento-tigo', '1']) . '#tigofest">aquí</a>');
                }
            }

            $auxurl = URL::route('buy', $ventaId) . '#tigofest';

            return Redirect::to($auxurl)->with('validation', 'Intento de compra caducada, por favor intente una nueva compra <a href="' . URL::route('pelicula', ['evento-tigo', '1']) . '#tigofest">aquí</a>');
        }

        $auxurl = URL::route('buy', $ventaId) . '#tigofest';

        return Redirect::to($auxurl)->with('validation', 'Debe de aceptar los términos y condiciones para realizar la compra');
    }

//
//TIGO MONEY -------------------------------------------------------->

    public function getSuccessful() {
        $response = $this->getResponse();

        return View::make('SuccessfulTigo')->with('response', $response['mensaje']);
    }

    public function getFailed() {
        $response = $this->getResponse();

        return View::make('FailedTigo')->with('response', $response['mensaje']);
    }

    public function postTigomoney($venta, $idCard, $fullName, $line, $precioSector, $email, $sectorName) {
        $orderId = $venta->id;
        $amount = $precioSector * $venta->cantidad_venta;
        $successfulUrl = URL::to('walkwaytigo/successful');
        $failedUrl = URL::to('walkwaytigo/failed');
        $confirmation = 'a TICKETEG';
        $notification = 'Código: ' . $orderId;

        $parameters = 'pv_nroDocumento=' . $idCard;
        $parameters .= ';pv_linea=' . $line;
        $parameters .= ';pv_monto=' . $amount;
        $parameters .= ';pv_orderId=' . $orderId;
        $parameters .= ';pv_nombre=' . $fullName;
        $parameters .= ';pv_confirmacion=' . $confirmation;
        $parameters .= ';pv_notificacion=' . $notification;
        $parameters .= ';pv_urlCorrecto=' . $successfulUrl;
        $parameters .= ';pv_urlError=' . $failedUrl;

        //$key = 'eb9fd1782db9136fe8e5d048e17878ce214ece647a71bb28d2899e33fd2e50b85b9b85c40ab22bd153e2fc54a2b5ab8e55d060e579b85bd9c8423896cbb7a8a0';
        //$parameters = $this->encryptText($parameters);
        //$url = 'http://190.129.208.178:96/vipagos/faces/payment.xhtml?key=' . $key . '&parametros=' . $parameters;
        //return Redirect::to($url);

        $response = $this->callRequestPayment($orderId, $parameters);

        if ($response['codRes'] == '0') {
            $venta->estado_venta = 1;
            $venta->save();

            $this->sendMail($fullName, $email, $venta->id, $venta->created_at, $sectorName, $venta->cantidad_venta, $amount, $line, $response['orderId']);

            $message = $response['mensajeClienteFinal'] . ' <i class="material-icons blue-text">thumb_up</i>';
        } else {
            $venta->estado_venta = 2;
            $venta->save();

            //$this->sendMail($fullName . ' PRUEBAS', $email, $venta->id, $venta->created_at, $sectorName, $venta->cantidad_venta, $amount, $line, $response['orderId']);

            $message = $response['mensajeClienteFinal'] . ' <i class="material-icons blue-text">thumb_down</i>';
        }

        $auxurl = URL::route('buy', [$venta->id]) . '#tigofest';

        return Redirect::to($auxurl)->with('success', $message);
    }

    private function encryptText($plainText) {
        try {
            $key = 'TV5NBUWTWEZT0H6ZQE69SC3D'; /* $key de sitio de pruebas */
            //$key = 'PFNIIMTJ6K4OYDTUKQII8QNP';
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

    private function decryptText($cryptedText) {
        try {
            $key = 'TV5NBUWTWEZT0H6ZQE69SC3D'; /* $key de sitio de pruebas */
            //$key = 'PFNIIMTJ6K4OYDTUKQII8QNP';
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

    private function getResponse() {
        $result = array();

        try {
            $queryString = urldecode(Request::getQueryString());
            $queryString = str_replace(' ', '+', $queryString);

            $queryArray = explode('&', $queryString);

            foreach ($queryArray as $value) {
                if (strpos($value, 'r=') === 0) {
                    $value = substr($value, 2);
                    $value = $this->decryptText($value);

                    $response = explode('&', $value);

                    foreach ($response as $r) {
                        $rArray = explode('=', $r);

                        $result[$rArray[0]] = utf8_encode($rArray[1]);
                    }

                    break;
                }
            }

            return $result;
        } catch (Exception $ex) {
            return $result;
        }
    }

    private function callRequestPayment($orderId, $parameters) {
        $result = array();

        try {
            $key = 'eb9fd1782db9136fe8e5d048e17878ce214ece647a71bb28d2899e33fd2e50b85b9b85c40ab22bd153e2fc54a2b5ab8e55d060e579b85bd9c8423896cbb7a8a0'; /* key de sitio de pruebas */
            //$key = '5d9a0de6caadad23217d47837ff8643ba93e3f6bf2476227004e77059e5ba564ede8e65c6a0a49bae27ffb01276593a51cc927d3cbfaa45ad47027d548813dad';
            $orderId = $this->encryptText($orderId);
            $parameters = $this->encryptText($parameters);

            $soapClient = new SoapClient('http://190.129.208.178:96/PasarelaServices/CustomerServices?wsdl'); /* sitio de pruebas */
            //$soapClient = new SoapClient('https://vipagos.com.bo/PasarelaServices/CustomerServices?wsdl');

            $soapReturn = $soapClient->solicitarPago(array('key' => $key, 'parametros' => $parameters));

            $response = explode('&', $this->decryptText($soapReturn->return));

            foreach ($response as $r) {
                $rArray = explode('=', $r);

                $result[$rArray[0]] = utf8_encode($rArray[1]);
            }

            $result['mensajeClienteFinal'] = $this->getMessageEndCustomer($result['codRes'], $result['mensaje']);
            $result['orderId'] = $orderId;
        } catch (Exception $ex) {
            $result['codRes'] = -500;
            $result['mensaje'] = 'Ocurrio un error inesperado. Por favor, intente nuevamente.';
            $result['mensajeClienteFinal'] = $this->getMessageEndCustomer(-500, 'Ocurrio un error inesperado. Por favor, intente nuevamente.');
            $result['orderId'] = $orderId;
        }

        try {
            if ($result['codRes'] != 0) {
                for ($attempt = 0; $attempt < 3; $attempt++) {
                    sleep(60);

                    $soapReturn = $soapClient->consultarEstado(array('key' => $key, 'parametros' => $orderId));

                    $response = explode(';', $this->decryptText($soapReturn->return));

                    if ($response[0] === 0) {
                        $result['codRes'] = 0;
                        $result['mensaje'] = 'Transaccion finalizada exitosamente.';
                        $result['mensajeClienteFinal'] = $this->getMessageEndCustomer(0, 'Transaccion finalizada exitosamente');
                        $result['orderId'] = $orderId;

                        break;
                    }
                }
            }
        } catch (Exception $ex) {
            $result['codRes'] = -500;
            $result['mensaje'] = 'Ocurrio un error inesperado. Por favor, intente nuevamente.';
            $result['mensajeClienteFinal'] = $this->getMessageEndCustomer(-500, 'Ocurrio un error inesperado. Por favor, intente nuevamente.');
            $result['orderId'] = $orderId;
        }

        return $result;
    }

    private function getMessageEndCustomer($code, $message) {
        switch ($code) {
            case -500:
                return 'Ocurrio un error inesperado. Por favor, intente nuevamente.';
            case 4:
                return 'Comercio no Registrado';
            case 7:
                return 'Acceso Denegado por favor intente nuevamente y verifique los datos incorporados';
            case 8:
                return 'PIN no valido, vuelva a intentar';
            case 11:
                return 'Tiempo de respuesta excedido, por favor inicie la transaccion nuevamente';
            case 14:
                return 'Billetera Movil destino no registrada, favor verifique sus datos';
            case 17:
                return 'Monto no valido, verifique los datos proporcionados';
            case 19:
                return 'Comercio no habilitado para el pago, favor comunicarse con el comercio';
            case 23:
                return 'El monto introducido es menor al requerido, favor verifique los datos';
            case 24:
                return 'El monto introducido es mayor al requerido, favor verifique los datos';
            case 1001:
                return 'Los fondos en su Billetera movil son insuficientes, para cargar su billetera vaya al Punto Tigo Money mas cercano, marque *555#';
            case 1002:
                return 'No ingresaste tu PIN, tu transaccion no pudo ser completada, inicia la transaccion nuevamente y verifica en transacciones por completar';
            case 1003:
                return 'N/A';
            case 1004:
                return 'Estimado Cliente llego a su limite de monto transaccionado, si tiene alguna consulta comuniquese con el *555';
            case 1012:
                return 'Estimado Cliente excedio su limite de intentos de introducir su PIN, por favor comuniquese con el *555 para solicitar su nuevo PIN';
            case 560:
                return 'Señor Cliente su transaccion no fue completada favor intente nuevamente en 1 minuto';
            default:
                return $message;
        }
    }

    private function sendMail($fullName, $toEmail, $orderId, $date, $sector, $quantity, $amount, $line, $encrypt) {
        $purchaseNumber = str_pad($orderId, 10, '0', STR_PAD_LEFT);
        $datePurchase = date('d/m/Y', strtotime($date));
        $qrFile = public_path('tmp\\' . $orderId . '.png');

        QrCode::format('png')->size(200)->generate($encrypt, $qrFile);

        Mail::queue('users.mails.test', array('fullName' => $fullName,
            'purchaseNumber' => $purchaseNumber,
            'datePurchase' => $datePurchase,
            'sector' => $sector,
            'quantity' => $quantity,
            'amount' => $amount,
            'line' => $line,
            'qrFile' => $qrFile
                ), function($message) use ($fullName, $toEmail) {
                    $message->to($toEmail, $fullName)->cc('soporte@ticketeg.com.bo', 'TICKETEG')->subject('Gracias por comprar con Tigo Money!');
                });

        File::delete($qrFile);
    }

    /*private function sendMailSes($fullName, $toEmail, $orderId, $date, $sector, $quantity, $amount, $line, $encrypt) {
        use Aws\Ses\SesClient;

        $purchaseNumber = str_pad($orderId, 10, '0', STR_PAD_LEFT);
        $datePurchase = date('d/m/Y', strtotime($date));
        $qrFile = public_path('tmp\\' . $orderId . '.png');

        QrCode::format('png')->size(200)->generate($encrypt, $qrFile);

        $client = SesClient::factory(array(
                    'key' => 'aws_key',
                    'secret' => 'aws_secret',
                    'region' => 'us-east-1'
        ));

        $bodyHtml = 'Gracias <i>' . $fullName . '</i>, tu compra ha finalizado con éxito.<br><br>';
        $bodyHtml .= 'Te damos la bienvenida a la segunda versión del Tigo Music Fest!<br>';
        $bodyHtml .= 'Tu número de compra es: ' . $purchaseNumber . '<br>';
        $bodyHtml .= 'Fecha: ' . $datePurchase . '<br>';
        $bodyHtml .= 'Lugar: Estadio Tahuichi Aguilera. Santa Cruz-Bolivia';
        $bodyHtml .= 'Sector: ' . $sector . '. Cantidad de entradas: ' . $quantity . '<br>';
        $bodyHtml .= 'Pago realizado: ' . $amount . ' Bs.<br>';
        $bodyHtml .= 'Número de teléfono: ' . $line . '<br><br>';
        $bodyHtml .= '<b>Puedes imprimir este correo o presentarlo desde tu celular para ingresar el día del evento al estadio.</b><br><br>';
        $bodyHtml .= 'Tu código de seguridad de ingreso al el evento es el  siguiente, válido por ' . $quantity . ' ENTRADA(s) ' . $sector . ':<br><br>';
        $bodyHtml .= '*Recuerda este código es único y no deberás compartirlo con nadie, una vez escaneado el código, el mismo quedará invalidado para un nuevo ingreso.<br><br>';
        $bodyHtml .= '<img src="{{$message->embed($qrFile)}}">';
        $bodyHtml .= '<br><br>';
        $bodyHtml .= '<b>IMPORTANTE:</b><br><br>';
        $bodyHtml .= '<u><b>NO COMPARTAS  CON NADIE ESTE CORREO NI ESTE CODIGO DE SEGURIDAD.</b></u><br>';
        $bodyHtml .= 'PORQUE SI ALGUIEN VIENE ANTES QUE TÚ CON ESTE CODIGO IMPRESO O DESDE SU CELULAR,  EL CODIGO QUEDA AUTOIMATICAMENTE CANCELADO Y ESA PERSONA QUE PRESENTÓ PRIMERO QUIE ENTRE AL EVENTO O REALICE EL CANJE EN SU DEFECTO.<br><br>';
        $bodyHtml .= '<b>SOBRE POLITICA DE CANJE:</b><br>';
        $bodyHtml .= 'Si vas directamente el día del evento con tu email impreso o en tu celular, se validará su autenticidad y estado (canjeado, cancelado o pendiente) en puerta de control de ingreso y se entregará ahí mismo la entrada prevalorada.<br><br>';
        $bodyHtml .= 'Si prefieres canjear tu(s) entrada(s), días antes del evento puedes hacerlo en las oficinas autorizadas  en  Santa Cruz de la Sierra a partir del 7 de noviembre.<br>';
        $bodyHtml .= 'Mas información en <a href="http://www.ticketeg.com.bo">www.ticketeg.com.bo</a><br>';
        $bodyHtml .= 'Si tienes alguna pregunta, llama a nuestros expertos en entradas al 3257141 ó escríbenos a <a href="mailto:soporte@ticketeg.com.bo">soporte@ticketeg.com.bo</a><br><br>';
        $bodyHtml .= 'Quieres seguir comprando? <a href="http://www.ticketeg.com.bo/tigo-fest/1#tigofest">www.ticketeg.com.bo</a><br><br>';

        //Now that you have the client ready, you can build the message
        $message = array();
        $message['Source'] = 'soporte@ticketeg.com.bo';
        //ToAddresses must be an array
        $message['Destination']['ToAddresses'][] = 'paolar@qubotech.com';
        $message['Destination']['CcAddresses'][] = 'paolairv@gmail.com';

        $message['Message']['Subject']['Data'] = 'Gracias por comprar con Tigo Money! (PRUEBAS POR SES)';
        $message['Message']['Subject']['Charset'] = 'UTF-8';

        $message['Message']['Body']['Html']['Data'] = $bodyHtml;
        $message['Message']['Body']['Html']['Charset'] = 'UTF-8';

        try {
            $result = $client->sendEmail($message);

            return $result->get('MessageId');
        } catch (Exception $e) {
            return -500;
        }
    }*/

}

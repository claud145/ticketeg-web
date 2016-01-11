<?php
use EntradasEventos\Entities\User;
use EntradasEventos\Entities\Eventos;
use EntradasEventos\Repositories\EventoRepo;
use EntradasEventos\Entities\Sectorhorario;

class VentasController extends BaseController {
  protected $eventoRepo;
  protected $sectorRepo;

  public function __construct(EventoRepo $eventoRepo) {
      $this->eventoRepo = $eventoRepo;
  }

  public function verVentasOnline() {
    $queryVentas = DB::select('select ventas.id, users.user_nombre, users.email, users.user_telefono, sectorhorarios.nombre_sector, ventas.cantidad_venta, (ventas.cantidad_venta * sectorhorarios.precio_sector) as monto_total
      from ventas
      inner join users on ventas.user_venta = users.id
      inner join sectorhorarios on ventas.sector_evento = sectorhorarios.id
      where ventas.estado_venta = 1
      order by ventas.id');

    return View::make('administrador/ventas/ventasOnline', compact('queryVentas'));
  }

  public function verVentasSectores(){
    $queryVentasSect = DB::select('select sum(v.cantidad_venta) as ventas, sh.nombre_sector as sector, sh.id, sh.stock, sh.limitestock,sh.estado
      from ventas v
      inner join sectorhorarios sh on sh.id = v.sector_evento
      where v.estado_venta = 1
      group by sector');
    
    return View::make('administrador/ventas/ventasCantidadSectores', compact('queryVentasSect'));
  }

  public function verVentasDetalle($id) {
    $sector = Sectorhorario::find($id);
    $queryVentasshow = DB::select('select ventas.id, users.user_nombre, users.email, users.user_telefono, sectorhorarios.nombre_sector, ventas.cantidad_venta, (ventas.cantidad_venta * sectorhorarios.precio_sector) as monto_total
      from ventas
      inner join users on ventas.user_venta = users.id
      inner join sectorhorarios on ventas.sector_evento = sectorhorarios.id
      where ventas.estado_venta = 1 and sectorhorarios.id = '. $id . '
      order by ventas.id');

    return View::make('administrador/ventas/ventasShow', compact('queryVentasshow', 'sector'));
  }

  public function busquedaUsuario(){
    $data = Input::all();

    $queryVentas = 'select ventas.id, users.user_nombre, users.user_ci, users.email, sectorhorarios.nombre_sector, ventas.cantidad_venta, (ventas.cantidad_venta * sectorhorarios.precio_sector) as monto_total
      from ventas inner join users on ventas.user_venta = users.id
      inner join sectorhorarios on ventas.sector_evento = sectorhorarios.id
      where ventas.estado_venta = 1 and users.user_nombre like ' + '%' + $data['search'] + '%' + ' or users.email like ' + '%' + $data['search'] + '%' + ' or users.user_telefono like ' + '%' + $data['search'] + '%' + '
      order by ventas.id';

    return dd($data['search'], $queryVentas);
  }

  public function verVentasFisicas() {
    $queryVentas = DB::select('select entradafisicaventas.id_ventas_fisicas as id_venta,
      ventasfisicas.created_at, ventasfisicas.vendedor_ubicacion, sectorhorarios.nombre_sector, count(entradafisicaventas.id) as cantidad_venta, sum(sectorhorarios.precio_sector) as total,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, if(ventasfisicas.cliente_samsung_plus = 1, "Sí", "No"), "No") as cliente_samsung_plus,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, ventasfisicas.email_samsung_plus, "") as email_samsung_plus,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, ventasfisicas.cantidad_samsung_plus, "") as regalo_samsung_plus
      from entradafisicaventas
      inner join ventasfisicas on ventasfisicas.id = entradafisicaventas.id_ventas_fisicas
      inner join sectorhorarios ON sectorhorarios.id = entradafisicaventas.sector_evento
      where ventasfisicas.estado_venta = 1
      and entradafisicaventas.entregado = 1
      group by entradafisicaventas.id_ventas_fisicas
      order by entradafisicaventas.id_ventas_fisicas');

    return View::make('administrador/ventas/ventasFisicas', compact('queryVentas'));
  }

  public function verVentasFisicasSectores(){
    $queryVentasSect = DB::select('select v.id_sector, v.nombre_sector, sum(v.cantidad_venta) as ventas, sum(v.regalo_samsung_plus) as regalos
      from (select sectorhorarios.id as id_sector, sectorhorarios.nombre_sector,
                  count(entradafisicaventas.id) as cantidad_venta,
                  if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, ventasfisicas.cantidad_samsung_plus, 0) as regalo_samsung_plus
            from entradafisicaventas
            inner join ventasfisicas on ventasfisicas.id = entradafisicaventas.id_ventas_fisicas
            inner join sectorhorarios ON sectorhorarios.id = entradafisicaventas.sector_evento
            where ventasfisicas.estado_venta = 1 and entradafisicaventas.entregado = 1
            group by entradafisicaventas.id_ventas_fisicas) as v
      group by v.nombre_sector');
    
    return View::make('administrador/ventas/ventasFisicasCantidadSectores', compact('queryVentasSect'));
  }

  public function verVentasFisicasSectorDetalle($id) {
    $sector = Sectorhorario::find($id);
    $queryVentasshow = DB::select('select entradafisicaventas.id_ventas_fisicas as id_venta,
      ventasfisicas.created_at, ventasfisicas.vendedor_ubicacion, sectorhorarios.nombre_sector, count(entradafisicaventas.id) as cantidad_venta, sum(sectorhorarios.precio_sector) as total,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, if(ventasfisicas.cliente_samsung_plus = 1, "Sí", "No"), "No") as cliente_samsung_plus,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, ventasfisicas.email_samsung_plus, "") as email_samsung_plus,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, ventasfisicas.cantidad_samsung_plus, "") as regalo_samsung_plus
      from entradafisicaventas
      inner join ventasfisicas on ventasfisicas.id = entradafisicaventas.id_ventas_fisicas
      inner join sectorhorarios ON sectorhorarios.id = entradafisicaventas.sector_evento
      where ventasfisicas.estado_venta = 1
      and entradafisicaventas.entregado = 1
      and sectorhorarios.id = ' . $id . '
      group by entradafisicaventas.id_ventas_fisicas
      order by entradafisicaventas.id_ventas_fisicas');

    return View::make('administrador/ventas/ventasFisicasSectorShow', compact('queryVentasshow', 'sector'));
  }

  public function verVentasFisicasUbicaciones(){
    $queryVentasSect = DB::select('select  v.vendedor_ubicacion, sum(v.cantidad_venta) as ventas, sum(v.regalo_samsung_plus) as regalos
      from (select ventasfisicas.vendedor_ubicacion,
                  count(entradafisicaventas.id) as cantidad_venta,
                  if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, ventasfisicas.cantidad_samsung_plus, 0) as regalo_samsung_plus
            from entradafisicaventas
            inner join ventasfisicas on ventasfisicas.id = entradafisicaventas.id_ventas_fisicas
            inner join sectorhorarios ON sectorhorarios.id = entradafisicaventas.sector_evento
            where ventasfisicas.estado_venta = 1 and entradafisicaventas.entregado = 1
            group by entradafisicaventas.id_ventas_fisicas) as v
      group by v.vendedor_ubicacion');
    
    return View::make('administrador/ventas/ventasFisicasCantidadUbicaciones', compact('queryVentasSect'));
  }

  public function verVentasFisicasUbicacionDetalle($id) {
    $ubicacion = $id;
    $queryVentasshow = DB::select('select entradafisicaventas.id_ventas_fisicas as id_venta,
      ventasfisicas.created_at, ventasfisicas.vendedor_ubicacion, sectorhorarios.nombre_sector, count(entradafisicaventas.id) as cantidad_venta, sum(sectorhorarios.precio_sector) as total,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, if(ventasfisicas.cliente_samsung_plus = 1, "Sí", "No"), "No") as cliente_samsung_plus,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, ventasfisicas.email_samsung_plus, "") as email_samsung_plus,
      if(ventasfisicas.sector_samsung_plus = entradafisicaventas.sector_evento, ventasfisicas.cantidad_samsung_plus, "") as regalo_samsung_plus
      from entradafisicaventas
      inner join ventasfisicas on ventasfisicas.id = entradafisicaventas.id_ventas_fisicas
      inner join sectorhorarios ON sectorhorarios.id = entradafisicaventas.sector_evento
      where ventasfisicas.estado_venta = 1
      and entradafisicaventas.entregado = 1
      and ventasfisicas.vendedor_ubicacion = "' . $id . '"
      group by entradafisicaventas.id_ventas_fisicas
      order by entradafisicaventas.id_ventas_fisicas');

    return View::make('administrador/ventas/ventasFisicasUbicacionShow', compact('queryVentasshow', 'ubicacion'));
  }

}

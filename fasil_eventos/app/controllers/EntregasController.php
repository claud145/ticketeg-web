<?php
use EntradasEventos\Entities\User;
use EntradasEventos\Entities\Eventos;
use EntradasEventos\Repositories\EventoRepo;
use EntradasEventos\Entities\Sectorhorario;

class EntregasController extends BaseController {
  protected $eventoRepo;
  protected $sectorRepo;


  public function __construct(EventoRepo $eventoRepo) {
      $this->eventoRepo = $eventoRepo;
  }

   public function verEntregasSectores(){
    $queryEntregaSect = DB::select('
      select sum(e.cantidad_venta) as entregas, 
	           sh.nombre_sector as sector, 
	           sh.id, e.vendedor_ubicacion
      from ventas v
      inner join sectorhorarios sh on sh.id = v.sector_evento
      inner join entregas e on e.id_venta = v.id
      where v.estado_venta = 1 and e.entregado = 1
      group by sh.nombre_sector');

    return View::make('administrador/entregas/entregasCantidadSectores', compact('queryEntregaSect'));
  }

  public function verEntregasPorUbicacion(){
    $queryEntregaSect = DB::select('
      select sum(e.cantidad_venta) as entregas,
             sh.nombre_sector as sector, 
             sh.id, e.vendedor_ubicacion
      from ventas v
      inner join sectorhorarios sh on sh.id = v.sector_evento
      inner join entregas e on e.id_venta = v.id
      where v.estado_venta = 1 and e.entregado = 1
      group by e.vendedor_ubicacion');

    return View::make('administrador/entregas/entregasCantidadUbicacion', compact('queryEntregaSect'));
  }

}
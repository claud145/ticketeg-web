<?php namespace EntradasEventos\Entities;

class Entregas extends \Eloquent {
	protected $fillable = array(
    'user_venta',
    'evento_venta',
    'sector_evento',
    'estado_venta',
	'cantidad_venta',
	'id_venta',
	'entregado',
	'vendedor_ubicacion',
	'id_vendedor'
);




}

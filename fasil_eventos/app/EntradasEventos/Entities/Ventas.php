<?php namespace EntradasEventos\Entities;

class Ventas extends \Eloquent {
	protected $fillable = array(
    'user_venta',
    'evento_venta',
    'sector_evento',
    'estado_venta',
		'cantidad_venta'
);




}

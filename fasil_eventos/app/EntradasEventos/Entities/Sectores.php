<?php namespace EntradasEventos\Entities;

class Sectores extends \Eloquent {
	protected $fillable = array(
		'fk_evento' ,
		'sector_nombre' ,
		'sector_descripcion' ,
		'sector_precio' ,
		'sector_stock' ,
		'sector_limite' ,
		'sector_estado'
	);
}

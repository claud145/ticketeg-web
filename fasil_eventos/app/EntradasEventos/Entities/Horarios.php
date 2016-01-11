<?php namespace EntradasEventos\Entities;

class Horarios extends \Eloquent {
	protected $fillable = array(
		'fk_evento' ,
		'horario_nombre' ,
		'horario_descripcion' ,
		'horario_precio' ,
		'horario_stock',
		'horario_limiteStock', 
		'horario_estado',
		'horario_horaInicio',
		'horario_horaFin'
	);
}

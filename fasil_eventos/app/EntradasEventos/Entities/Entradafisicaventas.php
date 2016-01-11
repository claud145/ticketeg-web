<?php namespace EntradasEventos\Entities;

class Entradafisicaventas extends \Eloquent {
	protected $fillable = array(
    'sector_evento',
    'codigo_entrada',
    'entregado',
    'id_ventas_fisicas'
);




}
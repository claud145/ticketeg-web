<?php 

namespace EntradasEventos\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Eventos extends \Eloquent implements UserInterface, RemindableInterface{

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'eventos';

	protected $fillable = array(
		'evento_nombre',
		'evento_genero',
		'evento_descripcion',
		'evento_img',
		'evento_youtube',
		'evento_tipo',
		'CP_lugar',
		'CP_hora',
		'evento_fechaInicio',
		'evento_fechaFin',
		'evento_user',
		'evento_password',
		'evento_principal',
		'evento_background',
		'slug'
	);
	public function setPasswordAttribute($value)
	{
		if (!empty($value)) {
			$this->attributes['evento_password'] =  \Hash::make($value);
		}

	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('evento_password');
}

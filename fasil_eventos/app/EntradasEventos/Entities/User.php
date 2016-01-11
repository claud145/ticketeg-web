<?php
namespace EntradasEventos\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

 protected $fillable = array('user_nombre',
 					'user_apellido',
 					'user_telefono',
 					'user_ci',
 					'email',
 					'password');

public function setPasswordAttribute($value)
{
	if (!empty($value)) {
		$this->attributes['password'] =  \Hash::make($value);
	}

}
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}

<?php

use EntradasEventos\Entities\Eventos;


class SuperAdminController extends BaseController {

    public function vhomeSuperAdmin() {
        return View::make('superAdmin/homeSuperAdmin');
    }


    public function vIniciarSesion(){
        return View::make('superAdmin/authAdmin/authAdmin');
    }

     public function pIniciarSesion()
    {
        $rules = [
            'email' => 'required|exists:users',
            'password' => 'required'
        ];

        $input = Input::only('email', 'password');

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'role' => 'administrador'
        ];

        if ( ! Auth::attempt($credentials))
        {
            return Redirect::back()
                ->withInput()
                ->withErrors([
                    'credentials' => 'We were unable to sign you in.'
                ]);
        }
        return Redirect::route('vhomeSuperAdmin');
    }

}
<?php

use EntradasEventos\Entities\User;
use EntradasEventos\Entities\Eventos;
use EntradasEventos\Entities\Ventas;

class UsersController extends BaseController {

    public function vRegistrarUsuario(){
        return View::make('users/registrarUsuario');
    }
    public function pRegistrarUsuario(){
        $data = Input::only(['user_nombre',
                            'user_apellido', 
                            'user_telefono',
                            'user_ci',
                            'email',
                            'password', 
                            'password_confirmation']);

        $rules = [
            'user_nombre' => 'required',
            'user_apellido' => 'required', 
            'user_telefono' => 'required|numeric',
            'user_ci' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed', 
            'password_confirmation' => 'required'
            ];

        $messages = array(
            'user_nombre.required' => '¿Cómo te llamas?',
            'email.required' => 'Nosotros necesitamos tu correo electrónico',
            'email.email' => 'El correo electrónico que nos diste no es válido',
            'user_ci.required' => 'Nosotros necesitamos de tu carnet de identidad',
            'user_telefono.required' => '¿Cuál es tu número de teléfono celular?',
            'user_telefono.numeric' => 'El teléfono que nos diste no es válido',
            //'user_fechaNac.required' => '¿Cuál es tu fecha de nacimiento?',
            'password.required' => 'Por favor, introduce una contraseña',
            'password.confirmed' => 'El campo de confirmación de tu contraseña no coincide.',
            'password_confirmation.required' => 'Por favor, repite tu contraseña'
        );

        $validation = \Validator::make($data, $rules, $messages);

        if ($validation->passes()) {
            $confirmation_code = str_random(30);
            $user = new User($data);
                $user->confirmation_code = $confirmation_code; 
                $user->role = 'cliente';  
            $user->save();
            //Auth::login($user);
            Mail::send('emails.verify',array('confirmation_code'=>$confirmation_code), function($message) {
                $message->to(Input::get('email'), Input::get('user_nombre'))
                    ->subject('Verify your email address');
            });        
            return Redirect::home();
        }
        return Redirect::back()->withErrors($validation->messages())->withInput();
    }

    public function vConfirmacionCorreo(){
        return View::make('users/confirmacion');
    }
     public function vErrorConfirmacionCorreo(){
        return View::make('users/errorConfirmacion');
    }

    public function vEsperaConfirmacionCorreo(){
        return View::make('users/esperaConfirmar');
    }

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            return dd($confirmation_code);
        }
        $user = User::where('confirmation_code', '=', $confirmation_code)->first();
        if ( ! $user)
        {
            return Redirect::route('vErrorConfirmacionCorreo');
        }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $credentials = ['email' => $user->email, 'password' => $user->password];
        Auth::login($user);
        $user->save();
        return Redirect::route('vConfirmacionCorreo');
    }

    public function vIniciarSesion(){
        return View::make('users/iniciarSesion');
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
            'confirmed' => 1
        ];

        if ( ! Auth::attempt($credentials))
        {
            return Redirect::back()
                ->withInput()
                ->withErrors([
                    'credentials' => 'We were unable to sign you in.'
                ]);
        }
        return Redirect::home();
    }
    public function vCerrarSesion(){
        Auth::logout();
        return Redirect::route('home');
    }

    //USUARIO PERFIL

    public function vVerUsuario($nombre, $id)
    {
        $user = User::find($id);
        return View::make('users/usuario-perfil-ver',compact('user'));
    }

    public function vEditarUsuario($slug,$id){
        $user = User::find($id);
        return View::make('users/usuario-editar',compact('user'));
     }
     public function pEditarUsuario(){
       $data = Input::only(['id',
                            'user_nombre',
                            'user_apellido', 
                            'user_telefono',
                            'user_ci',
                            'password', 
                            'password_confirmation'
                            ]);

        $rules = [
            'user_nombre' => 'required',
            'user_apellido' => 'required', 
            'user_telefono' => 'required|numeric',
            'user_ci' => 'required',
            'password' => 'required|confirmed', 
            'password_confirmation' => 'required'
            ];
   $messages = array(
            'user_nombre.required' => '¿Cómo te llamas?',
            'user_ci.required' => 'Nosotros necesitamos de tu carnet de identidad',
            'user_telefono.required' => '¿Cuál es tu número de teléfono celular?',
            'user_telefono.numeric' => 'El teléfono que nos diste no es válido',
            //'user_fechaNac.required' => '¿Cuál es tu fecha de nacimiento?',
            'password.required' => 'Por favor, introduce una contraseña',
            'password.confirmed' => 'El campo de confirmación de tu contraseña no coincide.',
            'password_confirmation.required' => 'Por favor, repite tu contraseña'
        );
         $validation = \Validator::make($data, $rules, $messages);

        if ($validation->passes()) {
            $user = User::find($data['id']);
                $user->user_nombre = $data['user_nombre'];
                $user->user_apellido = $data['user_apellido'];
                $user->user_telefono = $data['user_telefono'];  
                $user->user_ci = $data['user_ci'];
                $user->password = $data['password'];
            $user->save();     
            return Redirect::route('vVerUsuario',[$user->user_nombre, $user->id]);
        }
        return Redirect::back()->withErrors($validation->messages())->withInput();
     }


}





/*
    public function signUp() {
        return View::make('users/sign-up');
    }

    public function signUpToBuy($sale_id) {
        $venta = Ventas::find($sale_id);

        return View::make('users/signUpToBuy', compact('venta'));
    }

    public function registerToBuy() {
        $data = Input::only(['user_nombre', 'email', 'user_ci','user_telefono_contacto', 'user_telefono', 'user_fechaNac', 'password', 'password_confirmation']);
        $sale_id = Input::get('sale_id');

        $rules = [
            'user_nombre' => 'required',
            'email' => 'required|email|unique:users,email',
            'user_ci' => 'required',
            'user_telefono' => 'required|numeric',
            'user_telefono_contacto' => 'required|numeric',
            //'user_fechaNac' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        $messages = array(
            'user_nombre.required' => '¿Cómo te llamas?',
            'email.required' => 'Nosotros necesitamos de tu correo electrónico',
            'email.email' => 'El correo electrónico que nos diste no es válido',
            'user_ci.required' => 'Nosotros necesitamos de tu carnet de identidad',
            'user_telefono.required' => '¿Cuál es tu número de teléfono celular?',
            'user_telefono.numeric' => 'El teléfono que nos diste no es válido',

            'user_telefono_contacto.required' => '¿Cuál es tu número de teléfono celular?',
            'user_telefono_contacto.numeric' => 'El teléfono que nos diste no es válido',
            
            //'user_fechaNac.required' => '¿Cuál es tu fecha de nacimiento?',
            'password.required' => 'Por favor, introduce una contraseña',
            'password.confirmed' => 'El campo de confirmación de tu contraseña no coincide.',
            'password_confirmation.required' => 'Por favor, repite tu contraseña'
        );

        $validation = \Validator::make($data, $rules, $messages);

        if ($validation->passes()) {
            $user = new User($data);

            $user->user_tipo = 'suscriptor';
            $user->save();

            Auth::login($user);

            $auxurl = URL::route('buy', [$sale_id]) . '#tigofest';

            return Redirect::to($auxurl);
        }

        $auxurl = URL::route('signUpToBuy', [$sale_id]) . '#forms';

        return Redirect::to($auxurl)->withErrors($validation->messages())->withInput();
    }

    public function profile() {
        return View::make('users/profileUser');
    }

    public function account() {
        $user = Auth::user();

        return View::make('users/account', compact('user'));
    }

    public function Updateaccount() {
        $user = Auth::user();

        $data = Input::only(['user_nombre', 'email', 'user_ci','user_telefono_contacto', 'user_telefono', 'user_fechaNac', 'password', 'password_confirmation']);

        $rules = [
            'user_nombre' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'user_ci' => 'required',
            'user_telefono' => 'required',
            'user_telefono_contacto' => 'required',
            'password' => 'confirmed',
            'password_confirmation' => ''
        ];

        $validation = \Validator::make($data, $rules);

        if ($validation->passes()) {
            $user->fill($data);
            $user->save();

            return Redirect::route('home');
        }

        return Redirect::back()->withInput()->withErrors($validation->messages());
    }*/
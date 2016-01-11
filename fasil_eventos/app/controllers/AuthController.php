<?php

use Illuminate\Support\Facades\Input;
use EntradasEventos\Entities\User;
class AuthController extends BaseController {


    public function store(){
        $rules = [
            'user_nombre' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ];

        $input = Input::only(
            'user_nombre',
            'email',
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $confirmation_code = str_random(30);
            $user = new User();
                $user->user_nombre = Input::get('user_nombre');
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password'));
                $user->confirmation_code = $confirmation_code;
            $user->save();
         
        Mail::send('emails.verify',array('confirmation_code'=>$confirmation_code), function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Verify your email address');
        });

         

        return Redirect::home();
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
            return dd('no hay usuario');
        }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        return Redirect::route('loginprueba');
    }

    public function login() {
        $data = Input::all();

        $credentials = ['email' => $data['email'], 'password' => $data['password']];
        $eventoid = Input::get('evento_id');
        //$slug = Input::get('slug');

        if (Auth::attempt($credentials)) {
            //$urlx = Redirect::back();
            //return Redirect::to($url); // domain.com/welcome#hash
            $auxurl = Redirect::back();

            return Redirect::to($auxurl);
        }

        $auxurl = Redirect::back();

        return Redirect::to($auxurl)->with('login_error', 1);

        //dd(Input::only('user_email', 'user_password'));
    }

    public function loginToBuy() {
        $data = Input::all();

        $credentials = ['email' => $data['email_login'], 'password' => $data['password_login']];
        $sale_id = Input::get('sale_id');

        if (Auth::attempt($credentials)) {
            $auxurl = URL::route('buy', [$sale_id]) . '#tigofest';

            return Redirect::to($auxurl);
        }

        $auxurl = URL::route('signUpToBuy', [$sale_id]) . '#forms';

        return Redirect::to($auxurl)->with('login_error', 1);
    }

    public function logout() {
        Auth::logout();

        return Redirect::route('home');
    }

}

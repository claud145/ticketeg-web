<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>.:: TICKETEG ::.</title>
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{asset('styles/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="{{asset('styles/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body id="templatelogin">
        <div class="row">
            <div class="offset-m4 col s12 m4 offset-m4">
                <div class="row">
                    <div class="col m12">
                        <img src="{{asset('styles/img/logo_tigo_music_fest.png')}}" class=" center responsive-img" alt="" />
                    </div>
                    {{Form::open(['route' => 'loginadminpost','method'=> 'POST', 'role' => 'form','class'=>'col s12 m12 l12'])}}
                        <div class="card-panel row indigo">
                            <div class="login-title">
                                <h2 class="center white-text">Login</h2>
                            </div>
                                <div class="row admin-login-form">
                                    <div class="input-field col s12">
                                      {{Form::email('email', null, ['class'=> 'validate', 'id'=>'email_login'])}}
                                      <label for="email">Correo electrónico</label>
                                      {{$errors->first('email','<span class="note red-text">:message</span>')}}
                                    </div>
                                    <div class="input-field col s12">
                                      {{Form::password('password', null, ['class'=> 'validate', 'id'=>'password_login'])}}
                                      <label for="password">Contraseña</label>
                                      {{$errors->first('password','<span class="note red-text">:message</span>')}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light btn-large pink" type="submit" name="action">Ingresar
                                                <i class="material-icons right">send</i>
                                            </button>
                                    </div>
                                </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="{{asset('styles/js/materialize.js')}}"></script>
        <script src="{{asset('styles/js/init.js')}}"></script>

    </body>
</html>

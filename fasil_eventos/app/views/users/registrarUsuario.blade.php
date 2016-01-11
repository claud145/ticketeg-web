<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <meta name="google-site-verification" content="8azxWk1KXynu010uOj1Fyl8Q0-IoOc3udOe0KOCjW6Q" />
        <title>.:: TICKETEG ::.</title>
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{asset('styles/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="{{asset('styles/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body class="registro">
        <div class="container">
             <div class="row">
                <div class="col m5 offset-m4">
                  <div class="card white">
                    <div class="card-content card-register white-text">
                    <img src="{{asset('styles/img/logotipo1.png')}}" class="responsive-img">
                      <span class="card-title black-text">Registra tu cuenta</span>
                        <div class="row">
                            {{Form::open(['route' => 'pRegistrarUsuario', 'method' => 'POST', 'class' => 'col m12 black-text'])}}
                              <div class="row">
                                <div class="input-field col s12">
                                {{form::text('user_nombre',null,['class'=>'validate','id'=>'user_nombre'])}}
                                  <label for="user_nombre">Nombre</label>
                                  {{$errors->first('user_nombre','<span class="note red-text">:message</span>')}}
                                </div>
                                <div class="input-field col s12">
                                  {{form::text('user_apellido',null,['class'=>'validate','id'=>'user_apellido'])}}
                                  <label for="user_apellido">Apellido</label>
                                  {{$errors->first('user_apellido','<span class="note red-text">:message</span>')}}
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  {{form::text('user_telefono',null,['class'=>'validate','id'=>'user_telefono'])}}
                                  <label for="user_telefono">Telefono Celular</label>
                                  {{$errors->first('user_telefono','<span class="note red-text">:message</span>')}}
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  {{form::text('user_ci',null,['class'=>'validate','id'=>'user_ci'])}}
                                  <label for="user_ci">Carnet de Identidad</label>
                                  {{$errors->first('user_ci','<span class="note red-text">:message</span>')}}
                                </div>
                                <div class="input-field col s12">
                                  {{form::email('email',null,['class'=>'validate','id'=>'email'])}}
                                  <label for="email">Correo electronico</label>
                                  {{$errors->first('email','<span class="note red-text">:message</span>')}}
                                </div>
                                <div class="input-field col s12 m6">
                                  {{Form::password('password',['class'=>'validate','id'=>'password'])}}
                                  <label for="password">Contraseña</label>
                                  {{$errors->first('password','<span class="note red-text">:message</span>')}}
                                </div>
                                <div class="input-field col s12 m6">
                                  {{Form::password('password_confirmation',['class'=>'validate','id'=>'password_confirmation'])}}
                                  <label for="password">Confirmar Contraseña</label>
                                  {{$errors->first('password_confirmation','<span class="note red-text">:message</span>')}}
                                </div>
                              </div>
                              <div class="row">
                                  <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light blue darken-4" type="submit" name="action">Registrar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                              </div>
                           {{Form::close()}}
                        </div>
                    </div>  
                    </div>
                  </div>
                </div>
              </div>
          <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="{{asset('styles/js/materialize.js')}}"></script>
    <script src="{{asset('styles/js/init.js')}}"></script>

    </body>
</html>

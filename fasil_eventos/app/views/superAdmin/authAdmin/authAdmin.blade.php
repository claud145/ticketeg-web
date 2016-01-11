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
                <div class="col m4 offset-m4">
                  <div class="card white">
                    <div class="card-content white-text">
                    <img src="{{asset('styles/img/logotipo1.png')}}" class="responsive-img">
                      <span class="card-title black-text">Iniciar Sesion como Administrador</span>
                        <div class="row">
                            {{Form::open(['route' => 'pIniciarSesionAdministrador', 'method' => 'POST', 'class' => 'col m12 black-text'])}}
                               
                             
                              <div class="row">
                                <div class="input-field col s12">
                                  {{form::email('email',null,['class'=>'validate','id'=>'email'])}}
                                  <label for="email">Correo electronico</label>
                                  {{$errors->first('email','<span class="note red-text">:message</span>')}}
                                </div>
                                <div class="input-field col s12 m12">
                                  {{Form::password('password',['class'=>'validate','id'=>'password'])}}
                                  <label for="password">Contraseña</label>
                                  {{$errors->first('password','<span class="note red-text">:message</span>')}}
                                </div>
                              </div>
                              <div class="row">
                                  <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light blue darken-4" type="submit" name="action">Iniciar Sesion
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

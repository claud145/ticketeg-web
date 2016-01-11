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
<body class="grey lighten-3">
  <header>
    <nav>
      <div class="nav-wrapper white">
          <a href="#" class="brand-logo center black-text">Administrador Ticketeg</a>
      </div>
    </nav>
  </header>
  <div class="row">
    <div class="col m2  ">
      <ul id="slide-out" class="side-nav fixed nav-wrapper menu-lateral blue-grey darken-3">
        <li class="logo-entradas">
          <a id="logo-container" href="#" class="brand-logo">
            <img src="{{asset('styles/img/logo.png')}}" class="responsive-img" alt="" />
          </a>
        </li>
        <!--
        <div class="row">
          <div class="col s12 m12 l12">
            <div class="card-panel  pink">
              <span class="white-text">
                Bienvenido al Panel de Ticketeg
              </span>
            </div>
          </div>
        </div>-->
        <li class="no-padding listfirstadmin">
          <ul class="collapsible collapsible-accordion">
              <li class="bold active crearEvento">
                <a class="collapsible-header grey-text title-list">
                  <i class="large material-icons icon-list">note_add</i>
                    Crear Eventos
                </a>
                <div class="collapsible-body" style="display: block;">
                  <ul class="blue-grey darken-3">
                   <!-- <li><a href="#" class="gray-text disable">Crear Concierto</a></li> -->
                    <li><a href="{{route('vCrearEventoPartido')}}" class="white-text disable">Crear Partido</a></li>
                    <li><a href="{{route('vCrearEventoPelicula')}}" class="white-text">Crear Pelicula</a></li>
                   <!-- <li><a href="#" class="white-text disable">Crear Conferencias</a></li> -->
                  </ul>
                </div>
              </li>
              <li class="bold active crearEvento">
                <a class="collapsible-header grey-text title-list" href="{{route('vBuscarEventos')}}">
                  <i class="large material-icons">search</i>
                    Ver Evento
                </a>
              </li>
          </ul>
        </li>
        <li class="bold">
          <a class="blue-grey darken-3 grey-text" href="{{route('logout')}}">
            <i class="Small material-icons">lock_outline</i>
              Cerrar
            </a>
        </li>
      </ul>
      <a href="#" data-activates="slide-out" class="button-collapse"><i class="medium mdi-navigation-menu"></i></a>
    </div>
    @yield('content')
  </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="{{asset('styles/js/materialize.js')}}"></script>
  <script src="{{asset('styles/js/init.js')}}"></script>

    </body>
</html>

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
  <body  id="landscape">
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
      <a class="btn-floating btn-large red">
        <i class="large material-icons">mode_edit</i>
      </a>
      <ul>
        <li>
          <a href="{{route('showbuscar')}}" class="btn-floating yellow tooltipped" data-position="left" data-delay="50" data-tooltip="Busqueda por telefono">
            <i class="material-icons">search</i>
          </a>
        </li>

        <li>
          <a href="{{route('showbuscar')}}" class="btn-floating green tooltipped" data-position="left" data-delay="50" data-tooltip="Volver al dashboard">
            <i class="material-icons">replay</i>
          </a>
        </li>
      </ul>
    </div>
    <div>
      <div class="caption center-align">
        <img src="{{asset('styles/img/logo_tigo_music_fest.png')}}" class="responsive-img" alt="" />
      </div>
    </div>
    <div class="row">
      <div class="col m2  ">
        <ul id="slide-out" class="side-nav fixed nav-wrapper menu-lateral">
          <li class="logo-entradas indigo">
            <a id="logo-container" href="#" class="brand-logo">
              <img src="{{asset('styles/img/logo_tigo_music_fest.png')}}" class="responsive-img" alt="" />
            </a>
          </li>
          <div class="divider"></div>
          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel  pink">
                <span class="white-text">
                  Bienvenido al Panel de Administrador :)
                </span>
              </div>
            </div>
          </div>
          <li class="no-padding ">
            <ul class="collapsible collapsible-accordion">
              @if(Auth::user()->user_tipo == 'admin')
                <li class="bold active">
                  <a class="collapsible-header waves-effect waves-red">
                    <i class="large material-icons">trending_up</i>
                    Ventas</a>
                  <div class="collapsible-body" style="display: block;">
                    <ul>
                      <li><a href="{{route('verVentasOnline')}}" class="waves-effect waves-red">Ver ventas online</a></li>
                      <li><a href="{{route('verVentasSectores')}}" class="waves-effect waves-red">Ver ventas online por sectores</a></li>
                      <li><a href="{{route('verVentasFisicas')}}" class="waves-effect waves-red">Ver ventas físicas</a></li>
                    <li><a href="{{route('verVentasFisicasSectores')}}" class="waves-effect waves-red">Ver ventas físicas por sectores</a></li>
                    <li><a href="{{route('verVentasFisicasUbicaciones')}}" class="waves-effect waves-red">Ver ventas físicas por ubicación</a></li>
                    </ul>
                  </div>
                </li>
                <li class="bold active">
                  <a class="collapsible-header waves-effect waves-red">
                    <i class="large material-icons">trending_up</i>
                    Entregas</a>
                  <div class="collapsible-body" style="display: block;">
                    <ul>
                      <li><a href="{{route('verEntregasSectores')}}" class="waves-effect waves-red">Ver canjes por sector</a></li>
                      <li><a href="{{route('verEntregasPorUbicacion')}}" class="waves-effect waves-red">Ver canjes por ubicación</a></li>
                      <li><a href="{{route('showEntregasFechaSector')}}" class="waves-effect waves-red">Ver canjes por fecha</a></li></ul>
                    </ul>
                  </div>
                </li>
              @endif
              @if (Auth::user()->user_tipo == 'vendedor')
              <li class="bold active">
                <a class="collapsible-header waves-effect waves-red">
                  <i class="large material-icons">trending_up</i>Canje</a>
                <div class="collapsible-body" style="display: block;">
                  <ul>
                    <li><a href="{{route('canjeEntradas')}}" class="waves-effect waves-red">Canje entradas</a></li>
                    <li><a href="{{route('showbuscar')}}" class="waves-effect waves-red">Busqueda por teléfono</a></li>
                  </ul>
                </div>
              </li>
              <li class="bold active">
                <a class="collapsible-header waves-effect waves-red">
                  <i class="large material-icons">trending_up</i>Entradas físicas</a>
                <div class="collapsible-body" style="display: block;">
                  <ul>
                    <li><a href="{{route('ventaEntradaFisica')}}" class="waves-effect waves-red">Venta entradas</a></li>
                  </ul>
                </div>
              </li>
              @endif
              <!-- <li class="bold active">
                <a class="collapsible-header waves-effect waves-red">
                  <i class="large material-icons">dashboard</i>
                  Sectores</a>
                <div class="collapsible-body" style="display: block;">
                  <ul>
                    <li><a href="{{route('verVentasOnline')}}" class="waves-effect waves-red">Habilitar/Desahabilitar sector</a></li>
                    <li><a href="{{route('verVentasSectores')}}" class="waves-effect waves-red">Ver cantidad de ventas por sectores</a></li>
                  </ul>
                </div>
              </li>-->

            </ul>
          </li>
          <li class="bold">
            <a class="waves-effect waves-red  white" href="{{route('logout')}}">
              <i class="Small material-icons">power_settings_new</i>
              Cerrar</a>
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

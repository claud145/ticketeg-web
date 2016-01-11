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
    <body>
        <div>
            <header>
                <nav class="white navlayout" role="navigation">
                    <div class="nav-wrapper container">
                        <div class="col s12">
                            <a id="logo-container cartelera-logo" href="{{ route('home')}}" class="brand-logo hide-on-med-and-down">
                                <img id="logoscroll" src="{{asset('styles/img/logo.png')}}" alt="saretera" class="logo-img z-depth-3" />
                            </a>
                            
                            <a href="{{ route('home')}}" class="hide-on-med-and-down brand-logo">
                                <img id="logotiposcroll" src="{{asset('styles/img/logotipo.png')}}" alt="saretera" class="responsive-img" />
                            </a>

                            <a href="{{ route('home')}}" class="hide-on-med-and-up brand-logo ticketeglogotipo">
                                <img src="{{asset('styles/img/logotipo.png')}}" alt="saretera" class="responsive-img" />
                            </a>
                            @if (Auth::check())
                            <div class="right hide-on-med-and-down menu-registro">
                                <a href="{{route('vCerrarSesion')}}" class="waves-effect waves-light btn blue darken-4 white-text">Cerrar Sesion</a>        
                            </div>
                            @else
                            <div class="right hide-on-med-and-down menu-registro">
                                <a href="{{route('vIniciarSesion')}}" class="waves-effect waves-light btn-large blue darken-4">Iniciar Sesion</a>
                                <!--
                                    <a href="{{route('vRegistrarUsuario')}}" class="waves-effect waves-light btn-large blue darken-4">Registrarse</a>
                                -->
                            </div>
                            @endif
                            <ul class="right hide-on-med-and-down movie-menu-top menu-top">
                                <li{{ Request::is('/') ? ' class="active"' : null }}>
                                    <a href="{{route('home')}}">Inicio</a>
                                </li>
                                <li{{ Request::is('categorias') ? ' class="active"' : null }}>
                                    <a href="{{route('categorias')}}">Categorias</a>
                                </li>
                                <li {{ Request::is('nosotros') ? ' class="active"' : null }}>
                                    <a href="{{route('nosotros')}}#us">Nosotros</a>
                                </li>
                                <li>
                                    <a href="#contact-us">Contáctanos</a>
                                </li>
                                @if (Auth::check())
                                <li>
                                    <a 
                                    href="{{route('vVerUsuario',[Auth::user()->user_nombre,Auth::user()->id])}}" 
                                    class="blue-text text-darken-4">{{Auth::user()->user_nombre}}</a>
                                </li>
                                @endif
                            </ul>
                            <ul id="nav-mobile" class="side-nav">
                                <li>
                                    <a href="{{route('home')}}">Inicio</a>
                                </li>
                                <li>
                                    <a href="{{route('categorias')}}">Categorias</a>
                                </li>
                                <li>
                                    <a href="{{route('nosotros')}}#us">Nosotros</a>
                                </li>
                                <li>
                                    <a href="#contact-us">Contáctanos</a>
                                </li>
                                    @if (Auth::check())
                                <li>
                                    <a href="{{route('vCerrarSesion')}}">Cerrar Sesion</a>       
                                </li>
                                     @else 
                                <li>        
                                    <a href="{{route('vRegistrarUsuario')}}">Registrarse</a>
                                </li>
                                <li>
                                    <a href="{{route('vIniciarSesion')}}">Iniciar Secion</a>
                                </li>
                                    @endif
                                    
                                @if (Auth::check())
                                <li>
                                    <a 
                                    href="{{route('vVerUsuario',[Auth::user()->user_nombre,Auth::user()->id])}}" 
                                    class="blue-text text-darken-4">{{Auth::user()->user_nombre}}</a>
                                </li>
                                @endif
                            </ul>
                            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="icon-responsive material-icons blue darken-4" style="color:white;">menu</i></a>        
                        </div>
                    </div>
                </nav>
            </header>
                @yield('content')

                <footer>
                    <div class="row footer-content">
                        <div class="col s12 m4 l4">
                            <div id="contact-us" class="contact-title">
                                <h2>Contáctanos</h2>
                            </div>
                            <div class="contact-description">
                                <p>Somos una empresa de Manejo y administración de entradas y soluciones informáticas</p>
                            </div>
                            <div class="contact-details">
                                <ul>
                                    <li>
                                        <div>
                                            <p class="contact_us_address"><strong>Dirección: </strong> Av. Cañoto Nro. 879 esquina Libertad, Edificio Celina 2do. Piso<br>  Santa Cruz - Bolivia</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <p class="contact_us_email"><strong>Email: </strong><a href="#">soporte@ticketeg.com.bo</a></p>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <p class="contact_us_phone"><strong>Teléfono: </strong>(591) 3 325 7141</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="{{asset('styles/js/materialize.js')}}"></script>
        <script src="{{asset('styles/js/init.js')}}"></script>
        
        <script src="{{asset('styles/js/jquery.bxslider.js')}}"> </script>
    </body>
</html>

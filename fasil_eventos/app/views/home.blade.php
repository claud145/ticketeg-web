@extends('layout')

@section('content')
<div class="row">
    <div class="cover section no-pad-top ">
        @foreach ($queryEventoPrincipal as $queryEventoPrincipals)
            <div class="cover-img" style="background: url('{{asset('img/' . $queryEventoPrincipals->evento_background)}}');" >
                <div class="container ">
                    <br><br>
                    <div class="row center eventoEspecial">
                        <div class="col m12 hide-on-small-only">
                            <img class="responsive-img" src="{{asset('img/' . $queryEventoPrincipals->evento_img)}}" height = "280px" width="195px" alt="{{$queryEventoPrincipals->slug}}">
                        </div>
                        <div class="col m12 hide-on-med-and-up">
                            <img class="responsive-img" src="{{asset('img/' . $queryEventoPrincipals->evento_img)}}" alt="{{$queryEventoPrincipals->slug}}">
                        </div>
                        <div class="col m12">
                            <h5 class="header col s12 white-text">{{$queryEventoPrincipals->evento_nombre}}</h5>
                            <div class="row center">
                                <a href="{{route('vVerEvento', [$queryEventoPrincipals->slug, $queryEventoPrincipals->id]) }}" class="btn-large waves-effect waves-light blue darken-4">VER INFORMACION</a>
                            </div>
                        </div> 
        @endforeach
                    </div>
                    <br><br>
                </div>
            </div>
    </div>
</div>
            

    <div class="container content-cartelera" style="opacity: 0;">
        <div class="row content-semana">
            <div class="col m12">
                <div class="content-estrenos">
                    <h2 class="content-estrenos-title"><span>Cartelera </span>CINE CENTER</h2>
                </div>
                <div class="content-estrenos-listmovie">
                  @foreach ($queryEventoPeliculas as $queryEventoPeliculass)
                    <figure class="z-depth-3" >
                        <img alt="cartel" src="{{asset('img/' . $queryEventoPeliculass->evento_img)}}" />
                        <figcaption>
                            <h3>{{$queryEventoPeliculass->evento_nombre}}</h3>
                            <div>
                                <ul>
                                    <li>
                                        <a href="{{route('vVerEvento', [$queryEventoPeliculass->slug, $queryEventoPeliculass->id]) }}" class="icon-play-1"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icon-ticket"></a>
                                    </li>
                                </ul>
                            </div>
                        </figcaption>
                    </figure>
                    @endforeach
                </div>
            </div>
            <div class="col m12 ">
                <div class="content-estrenos">
                    <h2 class="content-estrenos-title"> <span> Eventos </span> Pasados</h2>
                </div>
                <div class="content-estrenos-listmovie">
                  @foreach ($queryEventosPasados as $queryEventosPasadoss)
                    <figure class="z-depth-3" >
                        <img alt="cartel" src="{{asset('img/' . $queryEventosPasadoss->evento_img)}}" />
                        <figcaption>
                            <h3>{{$queryEventosPasadoss->evento_nombre}}</h3>
                            <div>
                                <ul>
                                    <li>
                                        <h4>{{$queryEventosPasadoss->evento_fechaInicio}}</h4>
                                    </li>
 
                                </ul>
                            </div>
                        </figcaption>
                    </figure>
                    @endforeach
                </div>
            </div>
        </div>
        </div>

@stop

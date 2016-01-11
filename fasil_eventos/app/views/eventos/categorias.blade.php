@extends('layout')

@section('content')
<div class="row">
    <div class="cover section no-pad-top ">
                <div class="cover-img" style="background: url('{{asset('styles/img/backgroundlogin.png')}}');" >
                    <div class="container ">
                        <br><br>
                        <div class="row center eventoEspecial">
                    
                        <div class="col m12">
                            <h1 class="header col s12 white-text">EVENTOS</h1>
                            <div class="row center">
                                <h3 class="white-text">Conciertos-Peliculas-Partidos</h3>
                            </div>
                        </div> 
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
            <div class="col m12">
                <div class="content-estrenos">
                    <h2 class="content-estrenos-title"><span>Partidos de futbol </span>LIGA BOLIVIANA</h2>
                </div>
                <div class="content-estrenos-listmovie">
                  @foreach ($queryEventoPartidos as $queryEventoPartidoss)
                    <figure class="z-depth-3" >

                        <img alt="cartel" src="{{asset('img/' . $queryEventoPartidoss->evento_img)}}" />
                        <figcaption>
                            <h3>{{$queryEventoPartidoss->evento_nombre}}</h3>
                            <div>
                                <ul>
                                    <li>
                                        <a href="{{route('vVerEvento', [$queryEventoPartidoss->slug, $queryEventoPartidoss->id]) }}" class="icon-play-1"></a>
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
            <div class="col m12">
                <div class="content-estrenos">
                    <h2 class="content-estrenos-title"><span></span>Concientos</h2>
                </div>
                <div class="content-estrenos-listmovie">
                  @foreach ($queryEventoConciertos as $queryEventoConciertoss)
                    <figure class="z-depth-3" >
                        <img alt="cartel" src="{{$queryEventoConciertoss->evento_img}}" />
                        <figcaption>
                            <h3>{{$queryEventoConciertoss->evento_nombre}}</h3>
                            <div>
                                <ul>
                                    <li>
                                        <a href="{{route('vVerEvento', [$queryEventoConciertoss->slug, $queryEventoPeliculass->id]) }}" class="icon-play-1"></a>
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
        </div>
    </div>
@stop

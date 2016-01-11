@extends('layout')
@section('content')
<div class="row">
     <div class="cover section no-pad-top ">
                <div class="cover-img" style="background: url('{{asset('img/' . $evento->evento_background)}}');" >
                    <div class="container ">
                        <br><br>
                        <div class="row center eventoEspecial">
                        
                        <div class="col m12 hide-on-small-only">
                            <img class="responsive-img" src="{{asset('img/' . $evento->evento_img)}}" height = "280px" width="195px" alt="{{$evento->slug}}">
                        </div>
                        <div class="col m12 hide-on-med-and-up">
                            <img class="responsive-img" src="{{asset('img/' . $evento->evento_img)}}" alt="{{$evento->slug}}">
                        </div>
                        <div class="col m12">
                            <h5 class="header col s12 white-text">{{$evento->evento_nombre}}</h5>
                            <div class="row center">
                                <!--
                                <a href="#" class="btn-large waves-effect waves-light blue darken-4">Reservar</a>
                                -->
                            </div>
                        </div>
                             
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
</div>
           

            <div class="container content-cartelera"style="opacity: 0;">
                <div class="row content-perfilEvento">
                    <div class="col m12">
                        <h2>{{$evento->evento_nombre}}</h2>
                    </div>
                    <div class="col m4">
                        <img src="{{asset('img/' . $evento->evento_img)}}" class="responsive-img" height = "500px" width="300px">
                    </div>  
                    <div class="col m8">
                        <ul>
                            <li>
                                <p class="gray-text"><strong>Titulo:</strong></p>
                                <p><i class="small material-icons center">theaters</i>{{$evento->evento_nombre}}</p>
                            </li>
                            <li>
                                <p class="gray-text"><strong>Genero:</strong></p>
                                <p><i class="material-icons">location_on</i>{{$evento->evento_genero}}</p>
                            </li>
                            <li>
                                <p class="gray-text"><strong>Lugar:</strong></p>
                                <p><i class="material-icons">video_library</i> {{$evento->CP_lugar}}</p>
                            </li>
                        </ul>
                        <div>
                            <h5>Sinopsis</h5>
                            <blockquote>
                              {{$evento->evento_descripcion}}
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col m12">
                        <div class="content-estrenos">
                            <h2 class="content-estrenos-title">
                                <span>Reserva tus </span>Entradas</h2>
                        </div>
                    </div>
                    <div class="col m12">
                        
                    </div>
                </div>
            </div>
@stop

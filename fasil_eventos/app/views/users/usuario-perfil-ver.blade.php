@extends('layout')
@section('content')
<div class="row">
     <div class="cover section no-pad-top ">
                <div class="cover-img" style="background: url('{{asset('styles/img/backgroundlogin.png')}}');" >
                    <div class="container ">
                        <br><br>
                        <div class="row center eventoEspecial">
                            <div class="col m12">
                                <h1 class="header col s12 white-text">{{$user->user_nombre}} {{$user->user_apellido}}</h1>
                                <div class="row center">
                                    <h3 class="white-text">Perfil</h3>
                                </div>
                            </div>
                             
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
    </div>
           

            <div class="container content-cartelera">
                <div class="row content-perfilEvento">
                    <div class="col m12">
                        <h2>{{$user->user_nombre}} {{$user->user_apellido}}</h2>
                    </div>
                    <div class="col m12">
                        <ul>
                            <li>
                                <p class="gray-text"><strong>Nombre:</strong></p>
                                <p>{{$user->user_nombre}} </p>
                            </li>
                            <li>
                                <p class="gray-text"><strong>Apellido:</strong></p>
                                <p>{{$user->user_apellido}} </p>
                            </li>
                            <li>
                                <p class="gray-text"><strong>Carnet de identidad</strong></p>
                                <p>{{$user->user_ci}}</p>
                            </li>
                            <li>
                                <p class="gray-text"><strong>Telefono</strong></p>
                                <p>{{$user->user_telefono}}</p>
                            </li>
                            <li>
                                <p class="gray-text"><strong>Correo Electronico:</strong></p>
                                <p>{{$user->email}}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col m12">
                        <a class="btn-large waves-effect waves-light blue darken-4 white-text" href="{{route('vEditarUsuario',[Auth::user()->user_nombre,Auth::user()->id])}}">Editar</a>
                    </div>
                </div>
            </div>
@stop

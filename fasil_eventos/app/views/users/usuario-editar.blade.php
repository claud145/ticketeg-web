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
                                    <h3 class="white-text">Editar Perfil</h3>
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
                         {{Form::open(['route' => 'pEditarUsuario', 'method' => 'POST', 'class' => 'col s12'])}}
                            {{form::hidden('id', $user->id,['class'=>'validate','id'=>'fk_evento'])}}
                         <div class="row">
                          <div class="input-field col s6">
                            {{form::text('user_nombre',$user->user_nombre,['class'=>'validate','id'=>'evento_nombre'])}}
                            <label for="evento_nombre">Nombre de usuario</label>
                          </div>
                          <div class="input-field col s6">
                            {{form::text('user_apellido',$user->user_apellido,['class'=>'validate','id'=>'evento_genero'])}}
                            <label for="evento_genero">Apellido</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s6">
                            {{form::text('user_telefono',$user->user_telefono,['class'=>'validate','id'=>'evento_img'])}}
                            <label for="evento_img">telefono</label>
                          </div>
                          <div class="input-field col s6">
                            {{form::text('user_ci',$user->user_ci,['class'=>'validate','id'=>'evento_youtube'])}}
                            <label for="evento_youtube">Carnet de identidad</label>
                          </div>
                        </div>
                        <div class="row">
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
                            <button class="btn btn-large blue darken-3" type="submit" name="action">Editar Usuario
                                    <i class="material-icons right">send</i>
                            </button>
                          </div>
                          <div class="input-field col s12">
                            <a class="btn btn-large red darken-3" href="#" name="action">Cancelar
                                <i class="material-icons right">assignment_late</i>
                            </a>
                          </div>
                        </div>
                      {{Form::close()}}
                    </div>
                </div>
            </div>
@stop

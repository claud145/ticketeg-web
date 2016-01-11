@extends('layout')
@section('content')

<div id="forms" class="row content-semana">
    <div class="row">
        <div class="col m12">
            <h4>Registrar Usuario</h4>
        </div>

        {{Form::open(['route' => 'registertigo', 'method' => 'POST', 'class' => 'col s12'])}}
        <?php
            if (Session::has('venta_id'))
                form::hidden('venta_id', Session::get('venta_id'))
        ?>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                {{form::text('user_nombre',null,['class'=>'validate','id'=>'user_nombre'])}}
                <label for="user_nombre">Nombre</label>
                {{$errors->first('user_nombre','<span class="note red-text">:message</span>')}}
            </div>
            <div class="input-field col s12 m6 l6">
                {{form::email('email',null,['class'=>'validate','id'=>'email'])}}
                <label for="email">Correo electrónico <span class="note">(Donde se enviará tu código de compra)</span></label>
                {{$errors->first('email','<span class="note red-text">:message</span>')}}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                {{form::text('user_ci',null,['class'=>'validate','id'=>'user_ci'])}}
                <label for="user_ci">Carnet de identidad</label>
                {{$errors->first('user_ci','<span class="note red-text">:message</span>')}}
            </div>
            <div class="input-field col s12 m6 l6">
                {{form::text('user_telefono',null,['class'=>'validate','id'=>'user_telefono'])}}
                <label for="user_telefono">Teléfono celular <span class="note">(Donde te llegará la solicitud de confirmación de tu compra)</span></label>
                {{$errors->first('user_telefono','<span class="note red-text">:message</span>')}}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                {{Form::input('date', 'user_fechaNac', null, ['class' => 'datepicker'])}}
                {{Form::label('user_fechaNac','Fecha de nacimiento',['for'=>'user_fechaNac'])}}
                {{$errors->first('user_fechaNac','<span class="note red-text">:message</span>')}}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                {{Form::password('password',['class'=>'validate','id'=>'password'])}}
                <label for="password">Contraseña</label>
                {{$errors->first('password','<span class="note red-text">:message</span>')}}
            </div>
            <div class="input-field col s12 m6 l6">
                {{Form::password('password_confirmation',['class'=>'validate','id'=>'password_confirmation'])}}
                <label for="password_confirmation">Repetir contraseña</label>
                {{$errors->first('password_confirmation','<span class="note red-text">:message</span>')}}
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light blue darken-4" type="submit" name="action">Registrar
                    <i class="material-icons right">send</i>
                </button>
            </div>
            <div class="input-field col s12">
                <a class="modal-trigger" href="#modal1">¿Ya tienes una cuenta?</a>
                @if (Session::has('login_error'))
                  <span class="red-text">Credenciales no válidas</span>
                @endif
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>

@endsection

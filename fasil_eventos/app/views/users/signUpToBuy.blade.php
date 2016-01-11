@extends('layout')
@section('content')

<div id="forms" class="row content-semana">
    <div class="row">
        <div class="input-field col s12">
            <a class="modal-trigger" href="#modal_login_to_buy">¿Ya tienes una cuenta?</a>
            @if (Session::has('login_error'))
              <span class="red-text">Credenciales no válidas</span>
            @endif
        </div>
        <div class="col m12">
            <h4>Registra tus datos para comprar</h4>
        </div>

        {{Form::open(['route' => 'registerToBuy', 'method' => 'POST', 'class' => 'col s12'])}}
        {{form::hidden('sale_id', $venta->id)}}
        <div class="row">
            <div class="nput-field col s12 m12 l12">
                <p>Datos del usuario</p>
            </div>
            <div class="input-field col s12 m6 l6">
                {{form::text('user_nombre',null,['class'=>'validate','id'=>'user_nombre'])}}
                <label for="user_nombre">Nombre</label>
                {{$errors->first('user_nombre','<span class="note red-text">:message</span>')}}
            </div>
            <div class="input-field col s12 m6 l6">
                {{form::email('email',null,['class'=>'validate','id'=>'email'])}}
                <label for="email">Correo electrónico <span class="note blue-text">(Donde se enviará tu código de compra)</span></label>
                {{$errors->first('email','<span class="note red-text">:message</span>')}}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                {{form::text('user_ci',null,['class'=>'validate','id'=>'user_ci'])}}
                <label for="user_ci">Carnet de identidad</label>
                {{$errors->first('user_ci','<span class="note red-text">:message</span>')}}
            </div>
            
        </div>
        <div class="row">
            <div class="nput-field col s12 m12 l12">
                <p>Telefonos</p>
            </div>
            <div class="input-field col s12 m6 l6">
                {{form::text('user_telefono_contacto',null,['class'=>'validate','id'=>'user_telefono_contacto'])}}
                <label for="user_telefono_contacto">Teléfono contacto</label>
                {{$errors->first('user_telefono_contacto','<span class="note red-text">:message</span>')}}
            </div>
            <div class="input-field col s12 m6 l6">
                {{form::text('user_telefono',null,['class'=>'validate','id'=>'user_telefono'])}}
                <label for="user_telefono">Cuenta Tigo Money <span class="note blue-text">(Número de línea registrada donde se procesará el pago)</span></label>
                {{$errors->first('user_telefono','<span class="note red-text">:message</span>')}}
            </div>
            <!--
            <div class="input-field col s12 m6 l6">
                {{Form::input('date', 'user_fechaNac', null, ['class' => 'datepicker'])}}
                {{Form::label('user_fechaNac','Fecha de nacimiento',['for'=>'user_fechaNac'])}}
                {{$errors->first('user_fechaNac','<span class="note red-text">:message</span>')}}
            </div>-->
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                {{Form::password('password',['class'=>'validate','id'=>'password'])}}
                <label for="password">Crea una contraseña <span class="note blue-text">(Para ingresar posteriormente)</span></label>
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
        </div>
        {{Form::close()}}
    </div>
</div>

<!-- MODAL LOGIN-->
<div id="modal_login_to_buy" class="modal">
  <div class="modal-content">
    <div class="modal-title">
      <h3 class="black-text">Iniciar Sesion</h3>
    </div>
    <div class="row">
      {{Form::open(['route' => 'loginToBuy','method'=> 'POST', 'role' => 'form','class'=>'col s12 m6'])}}
        {{form::hidden('sale_id', $venta->id)}}
        <div class="input-field col s12">
          {{Form::email('email_login', null, ['class'=> 'validate', 'id'=>'email_login'])}}
          <label for="email_login">Correo electrónico</label>
        </div>
        <div class="input-field col s12">
          {{Form::password('password_login', null, ['class'=> 'validate', 'id'=>'password_login'])}}
          <label for="password_login">Contraseña</label>
        </div>
        <div class="input-field col s12">
          <input type="checkbox" id="test5" />
          <label for="test5">Recordarme</label>
        </div>
        <div class="input-field col s12">
          <br>
          <button class="btn waves-effect waves-light blue darken-4" type="submit" name="action">Ingresar
            <i class="material-icons right">send</i>
          </button>
        </div>
      {{Form::close()}}
    </div>
  </div>
</div>
<!--FIN -->

@endsection

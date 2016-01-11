@extends('layout')

@section('content')

<div id="forms" class="row content-semana">

    <div class="row">
      <div class="col m12">
         <h4>Editar perfil <strong>{{Auth::user()->user_nombre}}</strong> </h4>
      </div>
      {{Form::model($user,['route' => 'update_account', 'method' => 'PUT', 'class' => 'col s12'])}}
          {{ Form::text('user_nombre') }}
          {{ Form::text('user_telefono')}}
          {{ Form::text('user_ci')}}
          {{ Form::email('email') }}
          {{ Form::text('user_fechaNac')}}

          {{ Form::password('password') }}
          {{ Form::password('password_confirmation', ['placeholder' => 'Repite tu clave']) }}
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
             <i class="material-icons right">send</i>
           </button>
          </div>
      {{Form::close()}}
    </div>



</div>




@endsection

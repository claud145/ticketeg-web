@extends('layoutCanje')

@section('content')

<div class="col m10">
  {{Form::open(['route' => 'canjeVerificar','method'=> 'POST', 'role' => 'form','class'=>'container'])}}
    <div class="card-panel col s10 m10 l10 white">
      <div class="row">
        <div class="input-field col s12">
          {{Form::text('codigo_venta', null, ['class'=> 'validate', 'id'=>'codigo_venta'])}}
          <label for="codigo_venta">codigo de venta</label>
          {{$errors->first('email','<span class="note red-text">:message</span>')}}
        </div>
        <div class="input-field col s6">
          <button class="btn waves-effect waves-light indigo" type="submit" name="action">Verificar
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
    </div>
  {{Form::close()}}
</div>

@stop

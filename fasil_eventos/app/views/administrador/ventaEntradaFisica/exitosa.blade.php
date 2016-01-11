@extends('layoutCanje')

@section('content')


<div class="caption center-align">
  <div class="container">
    <div class="col s12 m6">
      <div class="card white">
        @foreach  ($queryVenta as $queryVentas)
        <div class="card-content white-text profile-venta row">
          <div class="col s12 m6">
            <i class="center-align green-text large material-icons" >verified_user</i>
            <h3 class="center-align black-text nombre-user-entrada">{{$queryVentas->user_nombre}}
            </h3>
            <p class="left-align black-text ci-user-entrada"><span class="grey-text text-darken-1">Carnet: </span>{{$queryVentas->user_ci}}</p>
            <p class="left-align black-text telefono-user-entrada"><span class="grey-text text-darken-1">Telefono: </span>{{$queryVentas->user_telefono}}</p>
            <p class="left-align black-text correo-user-entrada"><span class="grey-text text-darken-1">Correo: </span>{{$queryVentas->email}}</p>
          </div>
          <div class="col s12 m6">
            <i class="center-align red-text text-darken-1 large material-icons" >receipt</i>
            <h3 class="center-align black-text nombre-user-entrada">Entradas</h3>
              <div class="left-align black-text">
                <h4><p class="icon-location grey-text text-darken-1">    Nombre Sector:</p>{{$queryVentas->nombre_sector}} de {{$queryVentas->precio_sector}} Bs.</h4>
              </div>
              <div class="left-align black-text">
                <h4><p class="icon-ticket grey-text text-darken-1">  Cantidad compradas:</p> {{$queryVentas->cantidad_venta}}</h4>
              </div>
              <div class="left-align black-text">
                <h4><p class="icon-dollar grey-text text-darken-1">   Monto total:</p>{{$queryVentas->monto_total}} Bs.</h4>
              </div>
          </div>
        </div>
        <div class="card-action">
          {{Form::open(['route' => 'canjear','method'=> 'POST', 'role' => 'form','class'=>'container'])}}
            {{form::hidden('codigo_venta', $queryVentas->id,['class'=>'validate','id'=>'venta_id'])}}
            {{form::hidden('user_id', Auth::user()->id,['class'=>'validate','id'=>'user_id'])}}
            {{form::hidden('user_nombre', Auth::user()->user_nombre,['class'=>'validate','id'=>'user_nombre'])}}
            <button class="btn waves-effect waves-light btn-large indigo" type="submit" name="action">Entregar entradas
              <i class="material-icons right">done_all</i>
            </button>
          {{Form::close()}}
          <a class="indigo-text" href="{{ route('canjeEntradas')}}">Atras</a>
        </div>
      </div>
    </div>
      @endforeach
  </div>
</div>


@stop

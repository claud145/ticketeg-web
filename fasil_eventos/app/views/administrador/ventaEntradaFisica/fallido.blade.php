@extends('layoutCanje')

@section('content')


<div class="caption center-align">
  <div class="container">
    <div class="col s12 m6">
      <div class="card white darken-1 lighten-1">
        <div class="card-content white-text profile-venta row ">
          <div class="col s12 m6">  
              <i class="center-align red-text large material-icons" >error</i>
              <h3 class="center-align black-text nombre-user-entrada">Ya fue Entregada
              </h3>   
          </div>
        </div>
        <div class="card-action">
          <a class="red-text" href="{{ route('canjeEntradas')}}">Atras</a>
        </div>
      </div>
    </div>
  </div>
</div>


@stop

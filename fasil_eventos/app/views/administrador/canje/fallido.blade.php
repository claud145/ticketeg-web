@extends('layoutCanje')

@section('content')

<div class="col m10">
  <div class="caption center-align">
    <div class="container">
      <div class="col s12 m12">
        <div class="card white darken-1 lighten-1">
          <div class="card-content white-text profile-venta row ">
            <div class="col s12 m6">  
              @foreach  ($queryVenta as $queryVentas)
                <i class="center-align red-text large material-icons" >error</i>
                <h3 class="center-align black-text nombre-user-entrada">Ya fue canjeada por <br> <strong>{{$queryVentas->user_nombre}}</strong>
                </h3>
              @foreach  ($queryEntregado as $queryEntregados)
              <p class="left-align grey-text text-darken-1"><span class="black-text">Fecha:  </span>{{$queryEntregados->created_at}}</p>
              @endforeach
              <p class="left-align grey-text text-darken-1"><span class="black-text">CI: </span>{{$queryVentas->user_ci}}</p>
              <p class="left-align grey-text text-darken-1"><span class="black-text">Telefono: </span>{{$queryVentas->user_telefono}}</p>
              <p class="left-align grey-text text-darken-1"><span class="black-text">Correo: </span>{{$queryVentas->email}}</p>
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
            @endforeach
          </div>
          <div class="card-action">
            <a class="red-text" href="{{ route('canjeEntradas')}}">Reportar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@stop

@extends('layoutadmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="">
      <div class="admin-title">
          <h1 class="grey-text text-lighten-5">Cantidad de Entradas Online Vendidas</h1>
      </div>
      <div class="row">
        <div class="col s12 m11">
          <div class="row">
           @foreach  ($queryVentasSect as $queryVentasSects)
              <div class="col s12 m6">
                <div class="card indigo">
                  <a href="{{route('verVentasDetalle', [$queryVentasSects->id]) }}">
                  <div class="card-content white-text">
                    <h4 class="center white-text">{{$queryVentasSects->sector}}</h4>
                    <h3 class="center">{{$queryVentasSects->ventas}}</h3>
                    <p class="center grey-text text-lighten-1">Entradas Vendidas</p>
                    <p class="left grey-text text-lighten-1">
                      <span class="pink-text">Stock: </span>
                      {{$queryVentasSects->stock}}
                      <span class="pink-text">- Permitido hasta: </span>
                      {{$queryVentasSects->limitestock}}
                      <span class="pink-text">- *Estado: </span>
                      {{$queryVentasSects->estado}}
                    </p>
                    <p class="left">* 1 = Habilitado 2 = Deshabilitado</p>
                  </div>
                  </a>
                </div>
              </div>
          @endforeach
           </div>
        </div>
      </div>
    </div>
  </div>
@endsection

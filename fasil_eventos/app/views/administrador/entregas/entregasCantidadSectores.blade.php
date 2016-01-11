@extends('layoutadmin')

@section('content')

  <div class="col m9 admin-background">
    <div class="">
      <div class="admin-title">
          <h1 class="grey-text text-lighten-5">Cantidad de Entradas Entegadas por Sectores</h1>
      </div>
      <div class="row">
        <div class="col s12 m11">
          <div class="row">
           @foreach  ($queryEntregaSect as $queryEntregaSects)
              <div class="col s12 m6">
                <div class="card indigo">
                  <div class="card-content white-text">
                    <h4 class="center white-text">{{$queryEntregaSects->sector}}</h4>
                    <h3 class="center">{{$queryEntregaSects->entregas}}</h3>
                  </div> 
                </div>
              </div>
          @endforeach
           </div>
        </div>
      </div>
    </div>
  </div>
@endsection

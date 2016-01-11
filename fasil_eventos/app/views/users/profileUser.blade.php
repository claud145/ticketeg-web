@extends('layout')

@section('content')

<div id="forms" class="row content-semana">

    <div class="row">
      <div class="col m12">
         <h3>{{Auth::user()->user_nombre}}</h3>
      </div>

      <div class="row">
          <h5>Nombre</h5>
          <p>
            {{Auth::user()->user_nombre}}
          </p>
          <h5>Telefono</h5>
          <p>
            {{Auth::user()->user_telefono}}
          </p>
          <h5>Carnet de identidad</h5>
          <p>
            {{Auth::user()->user_ci}}
          </p>
          <h5>Correo Electronico</h5>
          <p>
            {{Auth::user()->email}}
          </p>
          <h5>Fecha de naciemiento</h5>
          <p>
            {{Auth::user()->user_fechaNac}}
          </p>

      </div>



</div>

</div>




@endsection

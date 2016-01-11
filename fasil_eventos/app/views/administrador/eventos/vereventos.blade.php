@extends('layoutadmin')

@section('content')

<div class="col m9 admin-background">
  <div class="">
    <div class="admin-title">
        <h1 class="grey-text text-lighten-5">Registrar Evento</h1>
    </div>
    <div class="row">
      <div class="col s12 m11">
        <div class="row">
          <div class="col s12 card-panel white admin-form">
            <h6>Buscar</h6>
            <nav>
              <div class="nav-wrapper">
                <form>
                  <div class="input-field">
                    <input id="search" type="search" required>
                    <label for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                  </div>
                </form>
              </div>
            </nav>



            <table>
   <thead>
     <tr>
         <th data-field="id">Evento</th>
         <th data-field="name">Tipo Evento</th>
         <th data-field="price">Fecha Estreno</th>
         <th data-field="price"></th>
         <th data-field="price"></th>
     </tr>
   </thead>
    @foreach  ($evento as $eventos)
   <tbody>
     <tr>
       <td>  {{$eventos->nombre_evento}}</td>
       <td>{{$eventos->tipo_evento}} </td>
       <td>{{$eventos->lanzamiento_evento}} </td>
       <td> <a class="waves-effect waves-light btn-large" href="#">Editar</a></td>
       <td> <a class="waves-effect waves-light btn-large" href="#">Eliminar</a></td>
     </tr>
   </tbody>
   @endforeach
 </table>
          </div>
         </div>
      </div>
    </div>
  </div>
</div>

@endsection

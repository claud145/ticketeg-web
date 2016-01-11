@extends('layoutadmin')

@section('content')

  <div class="col m9 admin-background">
    <div class="">
      <div class="admin-title">
          <h3 class="grey-text text-lighten-5">Registrar Sector</h3>
      </div>
      <div class="row">
        <div class="col s12 m11">
          <div class="row">
            {{Form::open(['route' => 'registersector', 'method' => 'POST', 'role' => 'form' , 'class'=> 'col s12 card-panel white admin-form'])}}
               <div class="row">
                 <div class="input-field col s4">
                   {{form::text('nombre_sector',null,['class'=>'validate','id'=>'nombre_sector'])}}
                   {{Form::label('nombre_sector','Nombre Sector',['for'=>'nombre_sectorevento'])}}
                   {{$errors->first('nombre_sector')}}
                 </div>
                 <div class="input-field col s4">
                   {{form::text('precio_sector',null,['class'=>'validate','id'=>'precio_sector'])}}
                   {{Form::label('precio_sector','Precio',['for'=>'precio_sector'])}}
                   {{$errors->first('nombre_sector')}}
                 </div>
                 <!--
                 <div class="col s4">
                   <a id="addsectores" href="#" class="btn-floating btn-large waves-effect waves-light red">
                    <i class="material-icons right">done</i>
                  </a>
                </div>
               </div>
               <div class="row">
                 <ul id="selectsectores " class="collection with-header">
                    <li class="collection-header"><h4>Sectores Agregados</h4></li>
                </ul>
               </div>
               -->
               <div class="row">
                 <div class="col s12">
                   <table>
                      <thead>
                        <tr>
                            <th data-field="id">Evento</th>
                            <th data-field="name">Fecha Estreno</th>
                            <th data-field="price">Agregar</th>
                        </tr>
                      </thead>
                       @foreach  ($evento as $eventos)
                      <tbody>
                        <tr>
                          <td>{{$eventos->evento_nombre}}</td>
                          <td>{{$eventos->evento_fecha}} </td>
                          <td>
                            <p>
                              {{form::radio('evento',$eventos->id, false ,['class'=>'validate','id'=> $eventos->id])}}
                                 <label for="{{$eventos->id}}" >Seleccionar</label>
                           </p>

                            </td>
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
                 </div>
               </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Crear Sector
                 <i class="material-icons right">send</i>
               </button>
              {{Form::close()}}
           </div>
        </div>
      </div>
    </div>
  </div>
@endsection

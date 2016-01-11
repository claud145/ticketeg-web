@extends('layoutadmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="">
      <div class="admin-title col s12 m11 l11">
          <h1 class="grey-text text-lighten-5">Busquedas</h1>
      </div>

      <div class="row">
        <div class="col s12 m12">
          <div class="row">
            <div class="col s12 m12 l12 card-panel white admin-form">
                {{Form::open(['route' => 'usuariobuscar','method'=> 'POST', 'role' => 'form','class'=>'col s12 m12 l12'])}}          
                            <div class="login-title">
                                <h2 class="center black-text">Buscar usuario por teléfono</h2>
                            </div>
                                <div class="row admin-login-form">
                                    <div class="input-field col s12">
                                      {{Form::text('user_telefono', null, ['class'=> 'validate', 'id'=>'user_telefono'])}}
                                      <label for="email">Telefono TIGO</label>
                                      {{$errors->first('user_telefono','<span class="note red-text">:message</span>')}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light btn-large indigo" type="submit" name="action">Buscar
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>         
                    {{Form::close()}}
                    @if($queryusuario != null)
                    <h2>{{$userTelefono}}</h2>
                    
                    <table class="centered">
                      <thead>
                        <tr>
                            <th data-field="id_venta">Numero transacción</th>
                            <th data-field="fecha_intento">Fecha transacción</th>
                            <th data-field="id">Nombre</th>
                            <th data-field="user_name">Email</th>
                            <th data-field="user_ci">CI</th>
                            <th data-field="nombre_sector">Sector</th>
                            <th data-field="cantidad_venta">Cantidad</th>
                            <th data-field="precio_sector">Precio unitario</th>
                            <th data-field="monto">Total</th>
                            <th data-field="estadoTransaccion">Estado transacción</th>
                            <th data-field="estadoTransaccion">Entregas</th>
                              
                        </tr>
                      </thead>
                        @foreach  ($queryusuario as $queryusuarios)
                      <tbody>
                        <tr>
                          <td>{{$queryusuarios->id}}</td>
                          <td>{{$queryusuarios->created_at}}</td>
                          <td>{{$queryusuarios->user_nombre}}</td>
                          <td>{{$queryusuarios->email}}</td>        
                          <td>{{$queryusuarios->user_ci}}</td>
                          <td><strong>{{$queryusuarios->nombre_sector}}</strong></td>
                          <td>{{$queryusuarios->cantidad_venta}}</td>
                          <td>{{$queryusuarios->precio_sector}} Bs.</td>
                          <td>{{$queryusuarios->monto_total}} Bs.</td>
                          @if($queryusuarios->estado_venta == 1)
                            <td class =" gree-text" >Realizada</td>
                          @else
                            <td class =" red-text" >Fallida</td>
                          @endif
                          @if($queryusuarios->id_venta == null && $queryusuarios->estado_venta == 1)
                            <td class =" gree-text" >
                              {{Form::open(['route' => 'canjearBusqueda','method'=> 'POST', 'role' => 'form','class'=>'container'])}}
                                   {{form::hidden('codigo_venta', $queryusuarios->id,['class'=>'validate','id'=>'venta_id'])}}
                                   {{form::hidden('telefono', $userTelefono,['class'=>'validate','id'=>'venta_id'])}}
                                   {{form::hidden('user_id', Auth::user()->id,['class'=>'validate','id'=>'user_id'])}}
                                   {{form::hidden('ubicacion', Auth::user()->ubicacion,['class'=>'validate','id'=>'ubicacion'])}}
                                   <button class="waves-effect waves-light btn indigo" type="submit" name="action">Entregar entradas
                                      <i class="material-icons right">send</i>
                                   </button>
                                {{Form::close()}}
                            </td>
                          @elseif($queryusuarios->id_venta != null)
                            <td class =" red-text">Entregada</td>
                          @else
                            <td class =" red-text">Transacion no completada</td>
                          @endif
                        </tr>                      
                      </tbody>
                       @endforeach
                    </table>
                    @else     
                  @endif
            </div>
           </div>
        </div>
      </div>
    </div>
  </div>
@endsection

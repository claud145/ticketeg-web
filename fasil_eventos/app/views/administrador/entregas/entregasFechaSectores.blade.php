@extends('layoutadmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="">
      <div class="admin-title col s12 m11 l11">
          <h1 class="grey-text text-lighten-5">Informes por fecha</h1>
      </div>

      <div class="row">
        <div class="col s12 m12">
          <div class="row">
            <div class="col s12 m12 l12 card-panel white admin-form">
                {{Form::open(['route' => 'buscarEntregasFechaSector','method'=> 'POST', 'role' => 'form','class'=>'col s12 m12 l12'])}}          
                            <div class="login-title">
                                <h2 class="center black-text">Informe</h2>
                            </div>
                                <div class="row admin-login-form">
                                    <div class="input-field col s12">
                                    {{Form::text('fecha', null, ['class'=> 'datepicker', 'placeholder'=>'Elija la fecha que necesita'])}}
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
                @if($allEntregados_g != null)
                  <h2>{{$fecha}}</h2>
                  <h3>Por sectores: </h3>
                  <div class="row">
                    <div class="col s12 m11">
                      <div class="row">
                       @foreach  ($EntregadosPorSectores_c as $EntregadosPorSectores_cs)
                          <div class="col s12 m6">
                            <div class="card indigo">
                              <div class="card-content white-text">
                                <h4 class="center white-text">{{$EntregadosPorSectores_cs->sector}}</h4>
                                <h3 class="center">{{$EntregadosPorSectores_cs->entregas}}</h3>
                              </div> 
                            </div>
                          </div>
                      @endforeach
                       </div>
                    </div>
                  </div>
                  <div class="divider"></div>
                  <h3>Por ubicacion: </h3>
                  <div class="row">
                    <div class="col s12 m11">
                      <div class="row">
                       @foreach  ($EntregadosPorUbicacion_c as $EntregadosPorUbicacion_cs)
                          <div class="col s12 m6">
                            <div class="card indigo">
                              <div class="card-content white-text">
                                <h4 class="center white-text">{{$EntregadosPorUbicacion_cs->vendedor_ubicacion}}</h4>
                                <h3 class="center">{{$EntregadosPorUbicacion_cs->entregas}}</h3>
                              </div> 
                            </div>
                          </div>
                      @endforeach
                       </div>
                    </div>
                  </div>
                  <div class="divider"></div>
                  <h3>Entradas Entregadas del dia {{$fecha}}: </h3>
                   <table>
                    <thead>
                      <tr>
                          <th data-field="id_venta">Número transacción</th>
                          <th data-field="fecha_intento">Fecha transacción</th>
                          <th data-field="user_nombre">Nombre usuario</th>
                          <th data-field="email">Email</th>
                          <th data-field="user_ci">CI</th>
                          <th data-field="nombre_sector">Sector</th>
                          <th data-field="cantidad_venta">Cantidad</th>
                          <th data-field="precio_sector">Precio unitario</th>
                          <th data-field="monto">Total</th>
                      </tr>
                    </thead>    
                      @foreach  ($allEntregados_g as $allEntregados_gs)
                      <tbody>
                        <tr>
                          <td>{{$allEntregados_gs->id_venta}}</td>
                          <td>{{$allEntregados_gs->created_at}}</td>
                          <td>{{$allEntregados_gs->user_nombre}}</td>
                          <td>{{$allEntregados_gs->email}}</td>        
                          <td>{{$allEntregados_gs->user_ci}}</td>
                          <td><strong>{{$allEntregados_gs->nombre_sector}}</strong></td>
                          <td>{{$allEntregados_gs->cantidad_venta}}</td>
                          <td>{{$allEntregados_gs->precio_sector}} Bs.</td>
                          <td>{{$allEntregados_gs->monto_total}} Bs.</td>
                        </tr>
                      </tbody>
                      @endforeach           
                  </table>
                @endif
            </div>
           </div>
        </div>
      </div>
    </div>
  </div>
@endsection

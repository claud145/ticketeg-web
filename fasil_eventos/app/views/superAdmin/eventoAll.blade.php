@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
            
              <span class="card-title black-text">Todos los Eventos</span>
                <table class="responsive-table">
                <thead>
                  <tr>
                      <th data-field="evento_nombre">Nombre del Evento</th>
                      <th data-field="evento_tipo">Tipo de Evento</th>
                      <th data-field="evento_user">Usuario Evento</th>
                      <th data-field="evento_password">Password</th>

                      <th data-field=""> </th>
                  </tr>
                </thead>
                  @foreach  ($queryEventosHabilitados as $queryEventosHabilitadoss)
                <tbody>
                  <tr>
                    <td>{{$queryEventosHabilitadoss->evento_nombre}}</td>
                    <td>{{$queryEventosHabilitadoss->evento_tipo}}</td>
                    <td>{{$queryEventosHabilitadoss->evento_user}}</td>
                    <td>{{$queryEventosHabilitadoss->evento_password}}</td>
                    @if($queryEventosHabilitadoss->evento_tipo == 'pelicula')
                    <td><a class="btn blue darken-3" href="{{route('vVerEvemtoPelicula', [$queryEventosHabilitadoss->slug, $queryEventosHabilitadoss->id]) }}">Ver</a></td>
                    @endif
                    @if($queryEventosHabilitadoss->evento_tipo == 'partido')
                    <td><a class="btn blue darken-3" href="{{route('vVerEventoPartido', [$queryEventosHabilitadoss->slug, $queryEventosHabilitadoss->id]) }}">Ver</a></td>
                    @endif
                  </tr>
                </tbody>
                 @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>

  </div>
@endsection

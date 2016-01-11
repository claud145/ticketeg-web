@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
            @if($evento != null)
              <span class="card-title black-text">Registrar Horario para la pelicula <strong>{{$evento->evento_nombre}}</strong></span>
                <div class="row">
                  {{Form::open(['route' => 'pRegistrarHorarioPelicula', 'method' => 'POST', 'class' => 'col s12'])}}
                    {{form::hidden('fk_evento', $evento->id,['class'=>'validate','id'=>'fk_evento'])}}
                    {{form::hidden('slug_evento', $evento->slug,['class'=>'validate','id'=>'fk_evento'])}}
                    <div class="row">
                      <div class="input-field col s12">
                        {{form::text('horario_descripcion',null,['class'=>'materialize-textarea','id'=>'horario_descripcion','length'=>'500'])}}
                        <label for="horario_descripcion">Descripcion del Horario</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('horario_precio',null,['class'=>'validate','id'=>'horario_precio'])}}
                        <label for="horario_precio">Precio del Horario</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('horario_stock',null,['class'=>'validate','id'=>'horario_stock'])}}
                        <label for="horario_stock">Stock del Horario</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('horario_limiteStock',null,['class'=>'validate','id'=>'horario_limiteStock'])}}
                        <label for="horario_limiteStock">Limite Stock del Horario</label>
                      </div>
                    </div>
                    <div class="row">
                    <h4>Hora inicio</h4>
                      <div class="input-field col s12">
                        {{form::text('horario_horaInicio',null,['class'=>'validate','id'=>'horario_horaInicio'])}}
                        <label for="horario_horaInicio">Hora Inicio</label>
                      </div>
                    </div>
                    <div class="row">
                    <h4>Hora Fin</h4>
                      <div class="input-field col s12">
                         {{form::text('horario_horaFin',null,['class'=>'validate','id'=>'horario_horaFin'])}}
                        <label for="horario_horaFin">Hora Fin</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <button class="btn btn-large blue darken-3" type="submit" name="action">Registrar Horario
                                <i class="material-icons right">send</i>
                        </button>
                      </div>
                      <div class="input-field col s12">
                        <a class="btn btn-large red darken-3" type="submit" name="action">Cancelar
                            <i class="material-icons right">assignment_late</i>
                        </a>
                      </div>
                    </div>
                  {{Form::close()}}
                </div>
                @endif
            </div>
          </div>
        </div>
      </div>

  </div>
@endsection

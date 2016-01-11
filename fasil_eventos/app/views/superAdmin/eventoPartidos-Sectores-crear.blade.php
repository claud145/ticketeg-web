@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
            @if($evento != null)
              <span class="card-title black-text">Registrar Sector del partido <strong>{{$evento->evento_nombre}}</strong></span>
                <div class="row">
                  {{Form::open(['route' => 'pRegistrarSectorPartido', 'method' => 'POST', 'class' => 'col s12'])}}
                    {{form::hidden('fk_evento', $evento->id,['class'=>'validate','id'=>'fk_evento'])}}
                    {{form::hidden('slug_evento', $evento->slug,['class'=>'validate','id'=>'fk_evento'])}}
                    <div class="row">
                      <div class="input-field col s12">
                        {{form::text('sector_nombre',null,['class'=>'validate','id'=>'sector_nombre'])}}
                        <label for="horario_precio">Nombre del Sector</label>
                      </div>
                      <div class="input-field col s12">
                        {{form::text('sector_descripcion',null,['class'=>'materialize-textarea','id'=>'sector_descripcion','length'=>'255'])}}
                        <label for="sector_descripcion">Descripcion del Sector</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('sector_precio',null,['class'=>'validate','id'=>'sector_precio'])}}
                        <label for="sector_precio">Precio del Sector</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('sector_stock',null,['class'=>'validate','id'=>'sector_stock'])}}
                        <label for="sector_stock">Stock del Sector</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('sector_limiteStock',null,['class'=>'validate','id'=>'sector_limiteStock'])}}
                        <label for="sector_limiteStock">Limite Stock del Sector</label>
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

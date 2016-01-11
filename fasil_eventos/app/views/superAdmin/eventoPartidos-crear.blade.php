@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
              <span class="card-title black-text">Registrar Partido</span>
                <div class="row">
                  {{Form::open(['route' => 'pRegistrarEventoPartido', 'method' => 'POST', 'class' => 'col s12','files'=>true])}}
                  
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('evento_nombre',null,['class'=>'validate','id'=>'evento_nombre'])}}
                        <label for="evento_nombre">Nombre del Partido</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_genero',null,['class'=>'validate','id'=>'evento_genero'])}}
                        <label for="evento_genero">Genero del Partido</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        {{form::text('evento_descripcion',null,['class'=>'materialize-textarea','id'=>'evento_descripcion','length'=>'500'])}}
            
                        <label for="textarea1">Descripcion del Partido</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class=" col s6">
                        {{Form::file('image')}}<br>
                        <label for="evento_img">Imagen cover del Partido </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('CP_lugar',null,['class'=>'validate','id'=>'CP_lugar'])}}
                        <label for="CP_lugar">Lugar del Evento</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_principal',null,['class'=>'validate','id'=>'evento_principal'])}}
                        <label for="evento_principal">¿Evento Principal? 0 = false - 1 = true</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('evento_fechaInicio',null,['class'=>'datepicker','id'=>'evento_fechaInicio'])}}
                        <label for="evento_fechaInicio">Fecha Inicio del Partido</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_fechaFin',null,['class'=>'datepicker','id'=>'evento_fechaFin'])}}
                        <label for="evento_fechaFin">Fecha Fin del Partido</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12">
                        {{Form::file('imageBackground')}}<br>
                        <label for="evento_img">Image Background del Partido</label>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <h5>Usuario Administrador del evento</h5>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('evento_user',null,['class'=>'validate','id'=>'evento_user'])}}
                        <label for="evento_user">Usuario</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_password',null,['class'=>'validate','id'=>'evento_password'])}}
                        <label for="evento_password">Password</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <button class="btn btn-large blue darken-3" type="submit" name="action">Registrar Pelicula
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
            </div>
          </div>
        </div>
      </div>

  </div>
@endsection

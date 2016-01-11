@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
              <span class="card-title black-text">Editar Evento {{$evento->evento_nombre}}</span>
                <div class="row">
                  {{Form::open(['route' => 'pEditarEventoPelicula', 'method' => 'POST', 'class' => 'col s12','files'=>true])}}
                    {{form::hidden('fk_evento', $evento->id,['class'=>'validate','id'=>'fk_evento'])}}
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('evento_nombre',$evento->evento_nombre,['class'=>'validate','id'=>'evento_nombre'])}}
                        <label for="evento_nombre">Nombre de la Pelicula</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_genero',$evento->evento_genero,['class'=>'validate','id'=>'evento_genero'])}}
                        <label for="evento_genero">Genero de la Pelicula</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        {{form::text('evento_descripcion',$evento->evento_descripcion,['class'=>'materialize-textarea','id'=>'evento_descripcion','length'=>'500'])}}
                         
                        <label for="textarea1">Descripcion de la Pelicula</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s6">
                        {{Form::file('image')}}<br>
                        <label for="evento_img">Imagen cover de la pelicula </label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_youtube',$evento->evento_youtube,['class'=>'validate','id'=>'evento_youtube'])}}
                        <label for="evento_youtube">Link youtube del trailer</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('CP_lugar',$evento->CP_lugar,['class'=>'validate','id'=>'CP_lugar'])}}
                        <label for="CP_lugar">Lugar del Evento</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_principal',$evento->evento_principal,['class'=>'validate','id'=>'evento_principal'])}}
                        <label for="evento_principal">¿Evento Principal? 0 = false - 1 = true</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('evento_fechaInicio',$evento->evento_fechaInicio,['class'=>'datepicker','id'=>'evento_fechaInicio'])}}
                        <label for="evento_fechaInicio">Fecha Inicio de la Pelicula</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_fechaFin',$evento->evento_fechaFin,['class'=>'datepicker','id'=>'evento_fechaFin'])}}
                        <label for="evento_fechaFin">Fecha Fin de la Pelicula</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12">
                        {{Form::file('imageBackground')}}<br>
                        <label for="evento_img">Image Background de la pelicula</label>
                      </div>
                    </div>
                    <div class="divider"></div>
                    <h5>Usuario Administrador del evento</h5>
                    <div class="row">
                      <div class="input-field col s6">
                        {{form::text('evento_user',$evento->evento_user,['class'=>'validate','id'=>'evento_user'])}}
                        <label for="evento_user">Usuario</label>
                      </div>
                      <div class="input-field col s6">
                        {{form::text('evento_password',$evento->evento_password,['class'=>'validate','id'=>'evento_password'])}}
                        <label for="evento_password">Password</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <button class="btn btn-large blue darken-3" type="submit" name="action">Editar Pelicula
                                <i class="material-icons right">send</i>
                        </button>
                      </div>
                      <div class="input-field col s12">
                        <a class="btn btn-large red darken-3" href="#" name="action">Cancelar
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

@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
              <span class="card-title black-text">***Nombre Concierto***</span>
                <div class="row">
                  <form class="col s12">
                    <div class="row">
                      <div class="input-field col s6">
                        <label for="evento_nombre">Nombre del Evento</label>
                      </div>
                      <div class="input-field col s6">
                        <label for="evento_genero">Genero del evento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <label for="textarea1">Descripcion del evento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <label for="evento_img">Imagen cover del Evento</label>
                      </div>
                      <div class="input-field col s6">
                        <label for="evento_youtube">Link youtube del artista</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <label for="CP_lugar">Lugar del Evento</label>
                      </div>
                      <div class="input-field col s6">
                        <label for="CP_hora">Hora del Evento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <label for="evento_fechaInicio">Fecha Inicio del evento</label>
                      </div>
                      <div class="input-field col s6">
                        <label for="evento_fechaFin">Fecha Fin del evento</label>
                      </div>
                    </div>
                    <div class="row submit-ver">
                        <div class="input-field col s4">
                          <button class="btn btn-large  blue darken-3" type="submit" name="action">Editar Concierto
                                  <i class="material-icons right">business</i>
                          </button>
                        </div>
                        <div class="input-field col s4">
                          <a class="btn btn-large blue darken-3" href="{{route('vCrearSectorConcierto')}}" name="action">Agregar Sectores
                              <i class="material-icons right">note_add</i>
                          </a>
                        </div>
                        <div class="input-field col s4">
                          <a class="btn btn-large red darken-3" type="submit" name="action">Eliminar Evento
                              <i class="material-icons right">delete</i>
                          </a>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>

  </div>
@endsection

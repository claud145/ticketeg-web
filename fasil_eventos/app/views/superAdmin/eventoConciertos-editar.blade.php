@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
              <span class="card-title black-text">Editar Evento ***Nombre***</span>
                <div class="row">
                  <form class="col s12">
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="evento_nombre" type="text" class="validate">
                        <label for="evento_nombre">Nombre del Evento</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="evento_genero" type="text" class="validate">
                        <label for="evento_genero">Genero del evento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="evento_descripcion" class="materialize-textarea" length="500"></textarea>
                        <label for="textarea1">Descripcion del evento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="evento_img" type="text" class="validate">
                        <label for="evento_img">Imagen cover del Evento</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="evento_youtube" type="text" class="validate">
                        <label for="evento_youtube">Link youtube del artista</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="CP_lugar" type="text" class="validate">
                        <label for="CP_lugar">Lugar del Evento</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="CP_hora" type="text" class="validate">
                        <label for="CP_hora">Hora del Evento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="evento_fechaInicio" type="date" class="datepicker">
                        <label for="evento_fechaInicio">Fecha Inicio del evento</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="evento_fechaFin" type="date" class="datepicker">
                        <label for="evento_fechaFin">Fecha Fin del evento</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <button class="btn btn-large  indigo darken-4" type="submit" name="action">Registrar Concierto
                                <i class="material-icons right">send</i>
                        </button>
                      </div>
                      <div class="input-field col s12">
                        <a class="btn btn-large red darken-3" type="submit" name="action">Cancelar
                            <i class="material-icons right">assignment_late</i>
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

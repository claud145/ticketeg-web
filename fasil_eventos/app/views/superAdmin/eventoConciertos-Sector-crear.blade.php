@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
              <span class="card-title black-text">Registrar Sector para el evento ***Nombre***</span>
                <div class="row">
                  <form class="col s12">
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="sector_nombre" type="text" class="validate">
                        <label for="sector_nombre">Nombre del Sector</label>
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
                        <input id="sector_precio" type="text" class="validate">
                        <label for="sector_precio">Precio del sector</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="sector_stock" type="text" class="validate">
                        <label for="sector_stock">Stock Sector</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="sector_limiteStock" type="text" class="validate">
                        <label for="sector_limiteStock">Limite Stock del Sector</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <button class="btn btn-large blue darken-3" type="submit" name="action">Registrar Concierto
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

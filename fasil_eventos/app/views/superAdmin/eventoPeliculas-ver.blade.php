@extends('layoutsuperAdmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="row">
        <div class="col s12 m12">
          <div class="card white">
            <div class="card-content black-text">
              <span class="card-title black-text"><strong></strong>{{$evento->evento_nombre}}</span>
                <div class="row">
                  <div class="col s12 m5">
                    <img src="{{asset('img/' . $evento->evento_img)}}" class="img-responsive" height = "600px" width="405">
                  </div>
                  <form class="col s12 m7">
                    <div class="row">
                      <div class="col s6">
                        <label for="evento_nombre">Nombre del Evento: </label>
                        <p><strong>{{$evento->evento_nombre}}</strong></p>
                      </div>
                      <div class="col s6">
                        <label for="evento_genero">Genero del evento: </label>
                        <p><strong>{{$evento->evento_genero}}</strong></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12">
                        <label for="textarea1">Descripcion del evento: </label>
                        <p><strong>{{$evento->evento_descripcion}}</strong></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s6">
                        <label for="evento_img">Imagen cover del Evento: </label>
                        <p><strong>{{$evento->evento_img}}</strong></p>
                      </div>
                      <div class="col s6">
                        <label for="evento_youtube">Link youtube del artista:</label>
                         <p><strong>{{$evento->evento_youtube}}</strong></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s6">
                        <label for="CP_lugar">Lugar del Evento: </label>
                        <p><strong>{{$evento->CP_lugar}}</strong></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s6">
                        <label for="evento_fechaInicio">Fecha Inicio del evento: </label>
                        <p><strong>{{$evento->evento_fechaInicio}}</strong></p>
                      </div>
                      <div class="col s6">
                        <label for="evento_fechaFin">Fecha Fin del evento: </label>
                        <p><strong>{{$evento->evento_fechaFin}}</strong></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s6">
                        <label for="evento_user">User: </label>
                        <p><strong>{{$evento->evento_user}}</strong></p>
                      </div>
                      <div class="col s6">
                        <label for="evento_password">Password:</label>
                        <p> <strong>{{$evento->evento_password}}</strong></p>
                      </div>
                    </div>
                  </form>
                  <div></div>
                  <div class="row submit-ver">
                      <div class="col m12">
                          <div class="row">
                            <div class="col s4">
                            <a class="btn btn-large  blue darken-3" href="{{route('vEditarEventoPelicula',[$evento->slug, $evento->id])}}" name="action">Editar Pelicula<i class="material-icons right">business</i>
                            </a>
                          </div>
                          <div class="col s4">
                            <a class="btn btn-large blue darken-3" href="{{route('vCrearHorarioPelicula',[$evento->slug, $evento->id])}}" name="action">Agregar Horarios<i class="material-icons right">note_add</i>
                            </a>
                          </div>
                          <div class="col s4">
                            <a class="btn btn-large red darken-3" href="{{route('vEliminarEventoPelicula',[$evento->slug, $evento->id])}}" name="action">Eliminar Evento<i class="material-icons right">delete</i>
                            </a>
                          </div>  
                        </div>
                      </div>   
                    </div>
                  <div class="row">
                   @foreach  ($queryPeliculaHorarios as $queryPeliculaHorarioss)
                  
                    <div class="col s12 m6">
                      <div class="card-panel yellow lighten-1">
                      <span class="card-title black-text">Horario</span> <br>
                        <span class="black-text">
                          <strong>{{$queryPeliculaHorarioss->horario_horaInicio}} -- {{$queryPeliculaHorarioss->horario_horaFin}}</strong>
                          {{$queryPeliculaHorarioss->horario_descripcion}} <br>
                          Precio: {{$queryPeliculaHorarioss->horario_precio}} Bs. <br>
                          Stock: {{$queryPeliculaHorarioss->horario_stock}}<br>
                          Limite Stock: {{$queryPeliculaHorarioss->horario_limiteStock}}<br>
                          @if($queryPeliculaHorarioss->horario_estado == 1)
                           Estado: Habilitado
                          @endif
                        </span>
                      </div>
                    </div>
                  
                  @endforeach
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>

  </div>
@endsection

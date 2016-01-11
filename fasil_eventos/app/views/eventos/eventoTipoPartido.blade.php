@extends('layout')

@section('content')
<h1>Partidos</h1>
<div class="row content-semana list-movies-content">
  <div class="col m12">
    <ul class="row">
      @foreach  ($evento as $eventos)
       <li class="col m12">
        <div class="row content-list-cartelera">
          <div class=" col m4 movie-img">
            <img class="responsive-img z-depth-3" src="{{$eventos->urlImagencover}}">
          </div>
          <div class="col m8 movies-descripcion">
            <h2 class="list-movies-title">
              {{$eventos->nombre_evento}}
            </h2>
            <div class="row">
              <div class="col m6">
                <ul>
                  <li class="event_list_item icon-tags">
                    <p><strong>Categoria:</strong></p>
                    <p>{{$eventos->categoria_evento}}</p>
                  </li>

                  <li class="event_list_item icon-calendar">
                    <p><strong>Fecha de estreno:</strong></p>
                    <p>{{$eventos->lanzamiento_evento}}</p>
                  </li>
                  <li class="event_list_item icon-clock">
                    <p><strong>Duracion:</strong></p>
                    <p>{{$eventos->duracion_evento}} Hrs.</p>
                  </li>
                </ul>
              </div>
              <div class="col m6">
                 <ul>
                 <li class="event_list_item icon-user">
                    <p><strong>Director: </strong></p>
                    <p>{{$eventos->director_pelicula}}</p>
                  </li>
                  <li class="event_list_item icon-users">
                    <p><strong>Actores:</strong></p>
                    <p>{{$eventos->actores_pelicula}}</p>
                  </li>
                  <li class="event_list_item icon-list">
                    <p><strong>Tipo Evento:</strong></p>
                    <p>{{$eventos->tipo_evento}}</p>
                  </li>
                </ul>
              </div>
            </div>
            <div>
            <a class="movie-trailer icon-play-1 hover_right" href="{{ route('pelicula', [$eventos->slug, $eventos->id]) }}">Ver</a>
              <a class="  buttonred icon-ticket" href="movies_details.html#reserva">Reservar</a>
            </div>
          </div>
        </div>

      </li>
      @endforeach
    </ul>
  </div>
</div>

@endsection

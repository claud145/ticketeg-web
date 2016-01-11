@extends('layoutCanje')

@section('content')

<div class="col m10">
  <div class="caption center-align">
    <div class="container">
      <div class="col s12 m12">
        <div class="card white darken-1 lighten-1">
          <div class="card-content white-text row">
            <i class="large material-icons yellow-text">info</i>
              <h5 class="black-text">No existe la entrada</h5>
          </div>
          <div class="card-action">
            <a class="red-text" href="{{ URL::previous() }}">Atras</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop
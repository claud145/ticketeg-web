@extends('layoutadmin')

@section('content')

  <div class="col m9 admin-background">
    <div class="">
      <div class="admin-title">
          <h1 class="grey-text text-lighten-5">Registrar Evento</h1>
      </div>
      <div class="row">
        <div class="col s12 m11">
          <div class="row">
            {{Form::open(['route' => 'register', 'method' => 'POST', 'role' => 'form' , 'class'=> 'col s12 card-panel white admin-form'])}}
               <div class="row">
                 <div class="input-field col s6">
                   {{form::text('evento_nombre',null,['class'=>'validate','id'=>'evento_nombre'])}}
                   {{Form::label('evento_nombre','Nombre Evento',['for'=>'evento_nombre'])}}
                   {{$errors->first('nombre_evento')}}
                 </div>
                 <div class="input-field col s6">
                   {{Form::select('evento_tipo', array('concierto' => 'Concierto'), 'S');}}
                   <label>Selecione el tipo de evento</label>
                    {{$errors->first('evento_tipo')}}
                 </div>
               </div>
               <div class="row">
                 <div class="input-field col s6">
                   {{form::text('evento_genero',null,['class'=>'validate','id'=>'evento_genero'])}}
                   {{Form::label('evento_genero','Genero Evento',['for'=>'evento_genero'])}}
                    {{$errors->first('evento_genero')}}
                 </div>
                 <div class="input-field col s6">
                   {{Form::input('date', 'evento_fecha', null, ['class' => 'datepicker'])}}
                   {{Form::label('evento_fecha','Estreno del Evento',['for'=>'evento_fecha'])}}
                    {{$errors->first('evento_fecha')}}
                 </div>
               </div>
                <div class="row">
                  <div class="input-field col s6">
                    {{form::text('evento_descripcion',null,['length'=>'300','class'=>'validate','id'=>'evento_descripcion'])}}
                    {{Form::label('evento_descripcion','Descripcion del evento',['for'=>'evento_descripcion'])}}
                     {{$errors->first('evento_descripcion')}}
                  </div>
                  <div class="input-field col s6">
                    {{form::text('evento_img',null,['class'=>'validate','id'=>'evento_img'])}}
                    {{Form::label('evento_img','URL de la imagen',['for'=>'evento_img'])}}
                     {{$errors->first('evento_img')}}
                  </div>
                  <div class="input-field col s6">
                    {{form::text('evento_youtube',null,['class'=>'validate','id'=>'evento_youtube'])}}
                    {{Form::label('evento_youtube','URL de la youtube',['for'=>'evento_youtube'])}}
                     {{$errors->first('evento_youtube')}}
                  </div>
                  <div class="input-field col s6">
                    {{form::text('CP_lugar',null,['class'=>'validate','id'=>'CP_lugar'])}}
                    {{Form::label('CP_lugar','Lugar del evento',['for'=>'CP_lugar'])}}
                     {{$errors->first('CP_lugar')}}
                  </div>
                  <div class="input-field col s6">
                    {{form::text('CP_hora',null,['class'=>'validate','id'=>'CP_hora'])}}
                    {{Form::label('CP_hora','Hora del evento',['for'=>'CP_hora'])}}
                     {{$errors->first('CP_hora')}}
                  </div>
                </div>


                <button class="btn waves-effect waves-light" type="submit" name="action">Crear Evento
                 <i class="material-icons right">send</i>
               </button>
              {{Form::close()}}
           </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layout')
@section('content')
<div id="tigofest" class="row content-semana list-movies-content">
    <div class="col m12">
        <div class="row">
            <div class="col m12">
                <div class="row content-list-cartelera">
                    <h1 class="list-movies-title">
                        {{$evento->evento_nombre}}
                    </h1>
                    <div class="col m4 movie-img">
                        <div class="evento-img">
                            <img class="materialboxed responsive-img z-depth-3" src="{{asset('styles/img/' . $evento->evento_img)}}">
                        </div>
                        <div class="evento-profile">
                            <div class="movies-descripcion">
                                <div class=" ">
                                    <ul>
                                        <li class="event_list_item icon-tags">
                                            <p><strong>Line up:</strong></p>
                                            <p>{{$evento->evento_genero}}</p>
                                        </li>
                                        <li class="event_list_item icon-calendar">
                                            <p><strong>Fecha:</strong></p>
                                            <p>{{$evento->evento_fecha}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <ul>
                                    <li class="event_list_item icon-user">
                                        <p><strong>Lugar: </strong></p>
                                        <p>{{$evento->CP_lugar}}</p>
                                    </li>
                                    <li class="event_list_item icon-users">
                                        <p><strong>Hora Inicio:</strong></p>
                                        <p>{{$evento->CP_hora}}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col m8">
                        <div id="reserva"class="contaienr col m12">
                            <div class="row">
                            <div class="col s12 m6 l6">
                                <h3> <strong>Ultimo paso!</strong></h3>
                                <h5>Revisa bien tu pedido y compra con</h5>
                            </div>
                            <div class="col s12 m6 l6">
                                <img class="responsive-img"src="{{asset('styles/img/logo_tigo_money.png')}}">
                            </div>
                                {{Form::open(['route' => 'buyByTigoMoney','method'=> 'POST','role' => 'form' , 'class'=> 'col s12 card-panel white admin-form'])}}
                                {{form::hidden('venta_id', $venta->id ,['class'=>'validate','id'=>'venta_id'])}}
                                {{form::hidden('precio_sector', $sector->precio_sector ,['class'=>'validate','id'=>'precio_sector'])}}
                                {{form::hidden('nombre_sector', $sector->nombre_sector ,['class'=>'validate','id'=>'nombre_sector'])}}
                                <div class="row">
                                    <div class="input-field col s12 m4 l4">
                                        <h5>Sector</h5>
                                        {{$sector->nombre_sector}}
                                    </div>
                                    <div class="input-field col s12 m4 l4">
                                        <h5>Precio</h5>
                                        {{$sector->precio_sector . 'Bs'}}
                                    </div>
                                    <div class="input-field col s12 m4 l4">
                                        <h5>Cantidad</h5>
                                        {{$venta->cantidad_venta}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m4 l4">
                                        <h5>Total</h5>
                                        {{$sector->precio_sector * $venta->cantidad_venta .'Bs'}}
                                    </div>
                                </div>
                                <div class="row">
                                    @if (Session::has('success'))
                                    <div id="button" class="input-field col s8">
                                        <a href="{{route('pelicula', ['tigo-fest', '1'])}}#tigofest" class="btn waves-effect waves-light blue darken-4">Nueva compra</a>
                                    </div>
                                    <div id="message" class="input-field col s12">
                                        <p>
                                            {{Session::get('success');}}
                                        </p>
                                    </div>
                                    @else
                                    <input id="acepta_compra" type="hidden" value="0" name="acepta_compra">
                                    <div id="checkbox" class="col s12 m12 l12">
                                        @if (Session::has('validation'))
                                        <p>
                                            {{Form::checkbox('validarcondicions', '1', false, ['class'=>'validate', 'id' => 'terminos'])}}
                                            <label for="terminos" >Acepta los Términos y Condiciones</label>
                                            
                                            <a class="btn-flat modal-trigger" href="#modal5">Ver los términos y condiciones</a>
                                        </p>
                                        <span class="note red-text">{{Session::get('validation');}}<span>
                                        @else
                                        <p>
                                            {{Form::checkbox('validarcondicions', '1', true, ['class'=>'validate', 'id' => 'terminos'])}}
                                            <label for="terminos" >Acepta los Términos y Condiciones</label>
                                            
                                            <a class="btn-flat modal-trigger" href="#modal5">Ver los términos y condiciones</a>
                                        </p>
                                        @endif
                                    </div>
                                    <div id="button" class="input-field col s4">
                                        <a class="btn modal-trigger waves-effect waves-light blue darken-4" href="#modal4">Comprar
                                            <i class="icon-ticket"> </i>
                                        </a>
                                    </div>
                                    <div id="preloader" class="input-field col s12" style="display:none">
                                        <div class="input-field col s12 m3 l3">
                                            <img src="{{asset('styles/images/preload.gif')}}" alt="" width="100%" />
                                        </div>
                                        <div class="input-field col s12 m9 l9">
                                            <p>Su transacción está siendo procesada y puede tardar algunos minutos, 
                                            recibirá una solicitud para ingresar su PIN de TIGOMONEY en su celular. 
                                            Esté atento.</p>
                                            <p>NO presione el botón de retroceso</p>
                                            <p>NO actualice la página</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!--modals-->
                                <!-- Modal Structure -->
                                <div id="modal4" class="modal modal-fixed-footer">
                                    <div class="modal-content">
                                        <h4>Confirmación de Compra</h4>
                                        <p>Confirma que desea realizar la compra de {{$venta->cantidad_venta}} entrada(s) {{$sector->nombre_sector}} por un total de {{$sector->precio_sector * $venta->cantidad_venta .'Bs'}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a id="rNo" href="#!" class="modal-action modal-close waves-effect btn-flat">No</a>
                                        <a id="rYes" href="#!" class="modal-action modal-close btn waves-effect waves-light blue darken-4">Si</a>
                                    </div>
                                </div>
                                <div id="modal5" class="modal">
                                    <div class="modal-content terms-conditions">
                                        <h4>Términos y Condiciones Tigo Money</h4>
                                        <p>
                                            <b>CÓDIGO DE CONDUCTA EN PRO DE UNA FIESTA SEGURA PARA TODOS.</b><br>
                                            Queremos que ésta sea la fiesta más increíble y segura  de Bolivia, por eso necesitamos que LEAS DETENIDAMENTE estas normas de conducta, que deberás seguir el 27 de noviembre de 2015 en el Tigo Music Fest:
                                        </p>
                                        <p>
                                            <b>EN LA ENTRADA E INGRESO AL EVENTO:</b><br>
                                            <ul>
                                              <li>Eres el único responsable de la entrada (ticket) al evento.</li>
                                              <li>La organización no se hace responsable del extravío, hurto o intercambio de información de las entradas (tickets).</li>
                                              <li>Asegúrate de llevar tu entrada y tenerla a la mano. No se permitirá el ingreso de personas que no cuenten con una entrada válida o una acreditación. El propietario de la entrada deberá de portarla y mostrarla en cada control de seguridad.</li>
                                              <li>Espera a ingresar para empezar la fiesta: personas en estado de ebriedad no podrán ingresar al evento, incluso si cuentan con una entrada válida. Tampoco se permitirá el ingreso a personas que se sospeche, atenten contra la seguridad de otros asistentes al evento. </li>
                                              <li>Por seguridad todas las personas deberán de ser requisadas al ingreso del evento.</li>
                                              <li>Si compraste una entrada en línea, ésta será escaneada por lectores digitales en el ingreso del evento.</li>
                                            </ul>
                                        </p>
                                        <p>
                                            <b>BEBIDAS ALCOHÓLICAS</b><br>
                                            <ul>
                                              <li>No se permite el expendio de bebidas alcohólicas a menores de 18 años.</li>
                                            </ul>
                                        </p>
                                        <p>
                                            <b>BOLSOS</b><br>
                                            <ul>
                                              <li>El tamaño máximo de bolso por persona es de 30 x 30 cms.</li>
                                              <li>Todos los bolsos deben de ser requisados.</li>
                                              <li>No se permite el ingreso de bebidas, comidas, armas, artículos corto punzantes, bengalas, pirotecnia de cualquier tipo, cadenas, drones, mástiles, encendedores, cerillos, velas y cualquier artículo que pueda ser lanzado, incendiado o pueda herir a otra persona.</li>
                                            </ul>
                                        </p>
                                        <p>
                                            <b>ZONAS y SALIDAS</b><br>
                                            <ul>
                                              <li>Cada persona deberá identificar previamente el ingreso correspondiente a su zona, así como también las salidas más cercanas a la misma.</li>
                                            </ul>
                                        </p>
                                        <p>
                                            <b>DOCUMENTOS</b><br>
                                            <ul>
                                              <li>Todos deberán de portar un documento de identidad vigente, tales como: Cédula de Identidad, Licencia de Conducir o Pasaporte.</li>
                                            </ul>
                                        </p>
                                        <p>
                                            <b>DESALOJOS y DETENCIONES</b><br>
                                            <ul>
                                              <li>La Policía y personal de Seguridad podrá detener y retirar del evento a cualquier persona que incumpla estas reglas ó atente contra el evento o contra la seguridad de otra persona dentro o en alrededores a este.</li>
                                            </ul>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-action modal-close btn waves-effect waves-light blue darken-4">Cerrar</a>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container col m12">
            <div>
                <h2>Descripcion</h2>
            </div>
            <div>
                <p>
                    {{$evento->evento_descripcion}}
                </p>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@extends('layoutCanje')

@section('content')

<div id="entrada_fisica" class="col m10">
  <div class="container">
    <div class="col s10 m10 l10 card-panel white">
      <div class="row">
        <div class="input-field col s12">
          {{Form::text('codigo_venta', null, ['class'=> 'validate', 'id'=>'codigo_venta'])}}
          <label class="active" for="codigo_venta">codigo de venta</label>
        </div>
        <div class="input-field col s12">
          <span id="mensaje" class="note red-text"></span>
        </div>
        <div class="input-field col s7">
          <table id="lista_sector">
            <thead>
              <tr>
                <th>Sector</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th class="right-align">Monto Bs.-</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th colspan="3" class="right-align">Total Bs.-</th>
                <th id="total" class="right-align">0.00</th>
            </tfoot>
          </table>
        </div>
        <div class="input-field col s5">
          <h5>¿Es cliente samsung plus?</h5>
          <p>
            <input type="checkbox" id="cliente-samsung" />  <label for="cliente-samsung">Samsung plus</label>
          </p>
          <input id="email-samsung" placeholder="Correo Electronico" type="text" name="email-samsung" disabled>
        </div>
        <div class="input-field col s12">
          <span id="validacion" class="note red-text"></span>
        </div>
        <div class="input-field col s12">
          <a id="boton-vender"class="btn modal-trigger waves-effect waves-light indigo" href="#modal4">Vender
            <i class="material-icons right">send</i>
          </a>
        </div>
      </div>
    </div>
    <!--modals-->
    <!-- Modal Structure -->
    <div id="modal4" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Confirmación de Venta</h4>
            <p id="modal4-mensaje"></p>
        </div>
        <div class="modal-footer">
            <a id="rNo" href="#!" class="modal-action modal-close waves-effect btn-flat">No</a>
            <a id="rSi" href="#!" class="modal-action modal-close btn waves-effect waves-light blue darken-4">Si</a>
        </div>
    </div>
  </div>
</div>
@stop
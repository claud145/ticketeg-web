@extends('layoutadmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="">
      <div class="admin-title col s12 m11 l11">
          <h1 class="grey-text text-lighten-5">Ventas Físicas</h1>
      </div>

      <div class="row">
        <div class="col s12 m11">
          <div class="row">
            <div class="col s12 m12 l12 card-panel white admin-form">
              <table class="responsive-table">
                <thead>
                  <tr>
                      <th data-field="id_venta">Número transacción</th>
                      <th data-field="fecha_intento">Fecha transacción</th>
                      <th data-field="vendedor_ubicacion">Ubicación</th>
                      <th data-field="nombre_sector">Sector</th>
                      <th data-field="cantidad_venta">Cantidad</th>
                      <th data-field="total">Total</th>
                      <th data-field="cliente_samsung_plus">Es Samsung Club</th>
                      <th data-field="email_samsung_plus">Email</th>
                      <th data-field="regalo_samsung_plus">Regalo Samsung</th>
                  </tr>
                </thead>
                  @foreach  ($queryVentas as $queryVenta)
                <tbody>
                  <tr>
                    <td>{{$queryVenta->id_venta}}</td>
                    <td>{{$queryVenta->created_at}}</td>
                    <td>{{$queryVenta->vendedor_ubicacion}}</td>
                    <td>{{$queryVenta->nombre_sector}}</td>
                    <td>{{$queryVenta->cantidad_venta}}</td>
                    <td>{{$queryVenta->total}} Bs.</td>
                    <td>{{$queryVenta->cliente_samsung_plus}}</td>
                    <td>{{$queryVenta->email_samsung_plus}}</td>
                    <td>{{$queryVenta->regalo_samsung_plus}}</td>
                  </tr>
                </tbody>
                 @endforeach
              </table>
            </div>
           </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layoutadmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="">
      <div class="admin-title col s12 m11 l11">
          <h1 class="grey-text text-lighten-5">Ventas Online</h1>
      </div>

      <div class="row">
        <div class="col s12 m11">
          <div class="row">
            <div class="col s12 m12 l12 card-panel white admin-form">
              <table class="responsive-table">
                <thead>
                  <tr>
                      <th data-field="id">Código venta</th>
                      <th data-field="user_name">Nombre usuario</th>
                      <th data-field="email">Email usuario</th>
                      <th data-field="user_telefono">Teléfono usuario</th>
                      <th data-field="nombre_sector">Sector</th>
                      <th data-field="cantidad_venta">Cantidad</th>
                      <th data-field="total">Total</th>
                  </tr>
                </thead>
                  @foreach  ($queryVentas as $queryVenta)
                <tbody>
                  <tr>
                    <td>{{$queryVenta->id}}</td>
                    <td>{{$queryVenta->user_nombre}}</td>
                    <td>{{$queryVenta->email}}</td>
                    <td>{{$queryVenta->user_telefono}}</td>
                    <td>{{$queryVenta->nombre_sector}}</td>
                    <td>{{$queryVenta->cantidad_venta}}</td>
                    <td>{{$queryVenta->monto_total}} Bs.</td>
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

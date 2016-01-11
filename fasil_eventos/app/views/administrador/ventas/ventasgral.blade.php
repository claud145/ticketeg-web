@extends('layoutadmin')

@section('content')

  <div class="col m10 admin-background">
    <div class="">
      <div class="admin-title col s12 m11 l11">
          <h1 class="grey-text text-lighten-5">Ventas Generales</h1>
      </div>

      <div class="row">
        <div class="col s12 m11">
          <div class="row">
            <div class="col s12 m12 l12 card-panel white admin-form">
              <table class="responsive-table">
                <thead>
                  <tr>
                      <th data-field="id">Codigo Venta</th>
                      <th data-field="user_name">Nombre Usuario</th>
                      <th data-field="email">Email Usuario</th>
                      <th data-field="user_telefono">Telefono Usuario</th>
                      <th data-field="precio_sector">Sector</th>
                      <th data-field="cantidad_venta">Cantidad  </th>
                      <th data-field="total">Total</th>
                  </tr>
                </thead>
                  @foreach  ($queryVentasgral as $queryVentasgrals)
                <tbody>
                  <tr>
                    <td>{{$queryVentasgrals->id}}</td>
                    <td>{{$queryVentasgrals->user_nombre}}</td>
                    <td>{{$queryVentasgrals->email}}</td>
                    <td>{{$queryVentasgrals->user_telefono}}</td>
                    <td>{{$queryVentasgrals->nombre_sector}}</td>
                    <td>{{$queryVentasgrals->cantidad_venta}}</td>
                    <td>{{$queryVentasgrals->monto_total}} Bs.</td>
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

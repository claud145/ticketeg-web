<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// REGISTRO Y LOGIN
route::get('registrate', ['as' => 'vRegistrarUsuario', 'uses' => 'UsersController@vRegistrarUsuario']);
route::post('registrate', ['as' => 'pRegistrarUsuario', 'uses' => 'UsersController@pRegistrarUsuario']);
Route::get('register/verify/{confirmationCode}', ['as' => 'confirmation_path', 'uses' => 'UsersController@confirm']);
Route::get('register/verify/{confirmationCode}', ['as' => 'confirmation_path', 'uses' => 'UsersController@confirm']);
route::get('espera-confirmacion-correo', ['as' => 'vEsperaConfirmacionCorreo', 'uses' => 'UsersController@vEsperaConfirmacionCorreo']);
route::get('confirmacion-correo', ['as' => 'vConfirmacionCorreo', 'uses' => 'UsersController@vConfirmacionCorreo']);
route::get('error-confirmacion-correo', ['as' => 'vErrorConfirmacionCorreo', 'uses' => 'UsersController@vErrorConfirmacionCorreo']);
route::get('iniciar-sesion', ['as' => 'vIniciarSesion', 'uses' => 'UsersController@vIniciarSesion']);
route::post('iniciar-sesion', ['as' => 'pIniciarSesion', 'uses' => 'UsersController@pIniciarSesion']);
route::get('cerrar-sesion', ['as' => 'vCerrarSesion', 'uses' => 'UsersController@vCerrarSesion']);
// USUARIOS
Route::group(['before' => 'is_user'], function (){
    Route::get('usuario/{nombre}/{id}', ['as' => 'vVerUsuario', 'uses' => 'UsersController@vVerUsuario']);
    route::get('usuario/{slug}/{id}/editar', ['as' => 'vEditarUsuario', 'uses' => 'UsersController@vEditarUsuario']);
    route::post('usuario/{slug}/{id}/editar', ['as' => 'pEditarUsuario', 'uses' => 'UsersController@pEditarUsuario']);    
});





//SUPER ADMINISTRADOR

route::get('iniciar-sesion-admin', ['as' => 'vIniciarSesionAdministrador', 'uses' => 'SuperAdminController@vIniciarSesion']);
route::post('iniciar-sesion-admin', ['as' => 'pIniciarSesionAdministrador', 'uses' => 'SuperAdminController@pIniciarSesion']);

Route::group(['before' => 'is_admin'], function (){
route::get('super-admin', ['as' => 'vhomeSuperAdmin', 'uses' => 'SuperAdminController@vhomeSuperAdmin']);
route::get('super-admin/registrar-concierto', ['as' => 'vCrearEventoConcierto', 'uses' => 'ConciertosController@vCrearEventoConcierto']);
route::get('super-admin/ver', ['as' => 'gVerEventoConcierto', 'uses' => 'ConciertosController@gVerEventoConcierto']);
route::get('super-admin/concierto/registrar-sector', ['as' => 'vCrearSectorConcierto', 'uses' => 'ConciertosController@vCrearSectorConcierto']);
//EVENTOS
route::get('super-admin/buscar-eventos', ['as' => 'vBuscarEventos', 'uses' => 'EventosController@vBuscarEventos']);
//PELICULA
route::get('super-admin/registrar-pelicula', ['as' => 'vCrearEventoPelicula', 'uses' => 'PeliculasController@vCrearEventoPelicula']);
route::post('super-admin/registrar-pelicula', ['as' => 'pRegistrarEventoPelicula', 'uses' => 'PeliculasController@pRegistrarEventoPelicula']);
route::get('super-admin/{slug}/{id}/ver-pelicula', ['as' => 'vVerEvemtoPelicula', 'uses' => 'PeliculasController@vVerEvemtoPelicula']);
route::get('super-admin/{slug}/{id}/registrar-horario', ['as' => 'vCrearHorarioPelicula', 'uses' => 'PeliculasController@vCrearHorarioPelicula']);
route::post('super-admin/{slug}/{id}/registrar-horario', ['as' => 'pRegistrarHorarioPelicula', 'uses' => 'PeliculasController@pRegistrarHorarioPelicula']);
route::get('super-admin/{slug}/{id}/editar', ['as' => 'vEditarEventoPelicula', 'uses' => 'PeliculasController@vEditarEventoPelicula']);
route::post('super-admin/{slug}/{id}/editar', ['as' => 'pEditarEventoPelicula', 'uses' => 'PeliculasController@pEditarEventoPelicula']);
route::get('super-admin/{slug}/{id}/eliminar', ['as' => 'vEliminarEventoPelicula', 'uses' => 'PeliculasController@vEliminarEventoPelicula']);
//PARTIDOS
route::get('super-admin/registrar-partido', ['as' => 'vCrearEventoPartido', 'uses' => 'PartidosController@vCrearEventoPartido']);
route::post('super-admin/registrar-partido', ['as' => 'pRegistrarEventoPartido', 'uses' => 'PartidosController@pRegistrarEventoPartido']);
route::get('super-admin/{slug}/{id}/ver-partido', ['as' => 'vVerEventoPartido', 'uses' => 'PartidosController@vVerEvemtoPartido']);
route::get('super-admin/{slug}/{id}/registrar-sector', ['as' => 'vCrearHorarioPartido', 'uses' => 'PartidosController@vCrearHorarioPartido']);
route::post('super-admin/{slug}/{id}/registrar-sector', ['as' => 'pRegistrarSectorPartido', 'uses' => 'PartidosController@pRegistrarHorarioPartido']);
route::get('super-admin/{slug}/{id}/editar', ['as' => 'vEditarEventoPartido', 'uses' => 'PartidosController@vEditarEventoPartido']);
route::post('super-admin/{slug}/{id}/editar', ['as' => 'pEditarEventoPartido', 'uses' => 'PartidosController@pEditarEventoPartido']);
route::get('super-admin/{slug}/{id}/eliminar', ['as' => 'vEliminarEventoPartido', 'uses' => 'PartidosController@vEliminarEventoPartido']);

});


//HOME
Route::get('evento/{slug}/{id}', ['as' => 'vVerEvento', 'uses' => 'EventosController@vVerEvento']);
Route::get('nosotros', ['as' => 'nosotros', 'uses' => 'HomeController@nosotros']);
Route::get('categorias', ['as' => 'categorias', 'uses' => 'EventosController@categorias']);

//prueba confirmacion login
Route::get('pruebalogin', ['as' => 'loginprueba', 'uses' => 'HomeController@loginprueba']);
Route::post('pruebalogin', ['as' => 'ploginprueba', 'uses' => 'AuthController@store']);





Route::get('administrador/login', ['as' => 'loginadmin', 'uses' => 'AdministradorController@indexLogin']);
Route::post('administrador/login', ['as' => 'loginadminpost', 'uses' => 'AdministradorController@loginadminpost']);

Route::group(['before' => 'is_administrativo'], function () {
  //TODOS LOS ADMINISTRATIVOS TIENEN ENTRADA AL LAYOUT DASHBOARD
  Route::get('administrador/dashboard', ['as' => 'homeadmin', 'uses' => 'AdministradorController@index']);
  //SOLO LOS DE TIPO ADMINISTRADOR
  Route::group(['before' => 'is_admin'], function () {
    //verEntregasPorUbicacion
    Route::get('administrador/crear-evento', ['as' => 'crearEvento', 'uses' => 'EventosController@createevento']);
    Route::post('administrador/crear-evento', ['as' => 'register', 'uses' => 'EventosController@register']);
    Route::get('administrador/ver-eventos', ['as' => 'verEvento', 'uses' => 'EventosController@verEventos']);
    Route::get('administrador/crear-sector',['as' => 'crearSector','uses'=> 'SectoresController@crearsector']);
    Route::post('administrador/crear-sector',['as' => 'registersector','uses'=> 'SectoresController@register']);
    Route::get('administrador/ver-ventasonline', ['as' => 'verVentasOnline', 'uses' => 'VentasController@verVentasOnline']);
    Route::post('administrador/ver-ventasonline',['as' => 'busquedaUsuario', 'uses' => 'VentasController@busquedaUsuario']);
    //Route::post('administrador/executeSearch', ['as' => 'search', 'uses' => 'EventosController@executeSearch']);
    Route::get('administrador/ver-ventassectores', ['as' => 'verVentasSectores', 'uses' => 'VentasController@verVentasSectores']);
    Route::get('administrador/ver-ventas/{id}',['as' => 'verVentasDetalle', 'uses' => 'VentasController@verVentasDetalle']);
    //REPORTES ENTREGAS
    Route::get('administrador/ver-entregassectores',['as' => 'verEntregasSectores', 'uses' => 'EntregasController@verEntregasSectores']);
    Route::get('administrador/ver-entregasubicaciones', ['as' => 'verEntregasPorUbicacion', 'uses' => 'EntregasController@verEntregasPorUbicacion']);
    //REPORTES ENTREGAS -> por fecha
    route::get('administrador/entregasFecha',['as'=> 'showEntregasFechaSector', 'uses' => 'AdministradorController@showEntregasFechaSector']);
    route::post('administrador/entregasFecha',['as'=> 'buscarEntregasFechaSector', 'uses' => 'AdministradorController@buscarEntregasFechaSector']);
    //REPORTES VENTAS FISICAS
    Route::get('administrador/ver-ventasfisicas', ['as' => 'verVentasFisicas', 'uses' => 'VentasController@verVentasFisicas']);
    Route::get('administrador/ver-ventasfisicassectores', ['as' => 'verVentasFisicasSectores', 'uses' => 'VentasController@verVentasFisicasSectores']);
    Route::get('administrador/ver-ventasfisicas/{id}',['as' => 'verVentasFisicasSectorDetalle', 'uses' => 'VentasController@verVentasFisicasSectorDetalle']);
    Route::get('administrador/ver-ventasfisicasubicaciones', ['as' => 'verVentasFisicasUbicaciones', 'uses' => 'VentasController@verVentasFisicasUbicaciones']);
    Route::get('administrador/ver-ventas/fisicas/{id}',['as' => 'verVentasFisicasUbicacionDetalle', 'uses' => 'VentasController@verVentasFisicasUbicacionDetalle']);
    });
  //SOLO LOS DE TIPO VENDEDOR
  Route::group(['before' => 'is_vendedor'], function () {
    //VIEW layout ENTREGA ENTRADA (VENTAS ONLINE)
    Route::get('administrador/preventascanje', ['as' => 'canjeEntradas', 'uses' => 'AdministradorController@canjeEntradas']);
    //VERIFICAR CODIGO->ENTREGA DE ENTRADAS (VENTAS ONLINE)
    Route::post('administrador/preventascanje', ['as' => 'canjeVerificar', 'uses' => 'AdministradorController@canjeVerificar']);
    //ENTREGAR ENTRADA FISICA (VENTAS ONLINE)
    Route::post('administrador/preventaentregar', ['as' => 'canjear', 'uses' => 'AdministradorController@canjear']);
    

    //VIEW LAYOUT VENTA ENTRADA FISICA
    Route::get('administrador/ventaEntradaFisica', ['as' => 'ventaEntradaFisica', 'uses' => 'AdministradorController@ventaEntradaFisica']);
    //VERIFICAR CODIGO->VENTA ENTRADAS FISICAS
    Route::post('administrador/ventaEntradaFisica', ['as' => 'entradaFisicaVerificar', 'uses' => 'AdministradorController@entradaFisicaVerificar']);
    //ENTREGAR ENTRADA FISICA / VENTA FISICA
    Route::post('administrador/ventaEntregar', ['as' => 'venderEntradaFisica', 'uses' => 'AdministradorController@venderEntradaFisica']);
   
   
  
    

    Route::post('administrador/preventabusquedaentrega', ['as' => 'canjearBusqueda', 'uses' => 'AdministradorController@canjearBusqueda']);
    Route::get('administrador/buscarusuario',['as' => 'showbuscar', 'uses' => 'AdministradorController@showbuscar']); 
    Route::POST('administrador/buscarusuario',['as' => 'usuariobuscar', 'uses' => 'AdministradorController@usuariobuscar']); 
  });
});








Route::get('eventos/peliculas', ['as' => 'eventopelicula', 'uses' => 'PeliculasController@tipoPelicula']);
Route::get('eventos/conciertos', ['as' => 'eventoconcierto', 'uses' => 'PeliculasController@tipoConcierto']);
Route::get('eventos/partidos', ['as' => 'eventopartido', 'uses' => 'PeliculasController@tipoPartido']);
Route::get('{slug}/{id}', ['as' => 'pelicula', 'uses' => 'PeliculasController@show']);
Route::post('{slug}/{id}', ['as' => 'continuetobuy', 'uses' => 'PeliculasController@continueToBuy']);
Route::get('evento/comprar/{sale_id}', ['as' => 'buy', 'uses' => 'PeliculasController@showToBuy']);
Route::post('evento/comprar/{sale_id}', ['as' => 'buyByTigoMoney', 'uses' => 'PeliculasController@buyByTigoMoney']);

Route::get('walkwaytigo/successful', ['as' => 'tigosuccessful', 'uses' => 'PeliculasController@getSuccessful']);
Route::get('walkwaytigo/failed', ['as' => 'tigofailed', 'uses' => 'PeliculasController@getFailed']);

Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('login', ['as' => 'loginToBuy', 'uses' => 'AuthController@loginToBuy']);
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

Route::get('sign-up', ['as' => 'sign_up', 'uses' => 'UsersController@signUp']);
Route::get('sign-up/comprar/{sale_id}', ['as' => 'signUpToBuy', 'uses' => 'UsersController@signUpToBuy']);
Route::post('sign-up/comprar/{sale_id}', ['as' => 'registerToBuy', 'uses' => 'UsersController@registerToBuy']);
Route::get('profile', ['as' => 'profile', 'uses' => 'UsersController@profile']);
//formularios
Route::get('account', ['as' => 'account', 'uses' => 'UsersController@account']);
Route::put('account', ['as' => 'update_account', 'uses' => 'UsersController@Updateaccount']);


/* ADMIN ->login */

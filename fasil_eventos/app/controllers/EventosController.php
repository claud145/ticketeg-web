<?php

use EntradasEventos\Entities\Eventos;

class EventosController extends BaseController {

	public function categorias(){
		$queryEventoConciertos = DB::select('select eventos.* from eventos where eventos.evento_tipo = "conciertos" and eventos.evento_estado = 1'); 
        $queryEventoPeliculas = DB::select('select eventos.* from eventos where eventos.evento_tipo = "pelicula" and eventos.evento_estado = 1');
        $queryEventoPartidos = DB::select('select eventos.* from eventos where eventos.evento_tipo = "partido" and eventos.evento_estado = 1');
        
        return View::make('eventos/categorias',compact('queryEventoPartidos','queryEventoPeliculas','queryEventoConciertos'));
	}

    public function vBuscarEventos() {
        $evento = Eventos::all();
        $queryEventosHabilitados = DB::select('select eventos.* from eventos where eventos.evento_estado = 1');
        return View::make('superAdmin/eventoAll', compact('queryEventosHabilitados'));
    }

    public function vVerEvento($slug,$id){
    	$evento = Eventos::find($id);
    	return View::make('eventos/show',compact('evento'));
    }


}

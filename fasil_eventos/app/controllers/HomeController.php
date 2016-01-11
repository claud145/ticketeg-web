<?php

use EntradasEventos\Entities\Eventos;
use EntradasEventos\Repositories\EventoRepo;

class HomeController extends BaseController {

    protected $eventoRepo;

    public function __construct(EventoRepo $eventoRepo) {
        $this->eventoRepo = $eventoRepo;
    }

    public function indexTigo() {
        return View::make('homeTigo');
    }
    public function loginprueba(){
        return View::make('users/registrarUsuario');
    }

    public function index() {
        $latest_eventos = $this->eventoRepo->findLatest();
        $queryEventoConciertos = DB::select('select eventos.* from eventos where eventos.evento_tipo = "conciertos" and eventos.evento_estado = 1'); 
        $queryEventoPeliculas = DB::select('select eventos.* from eventos where eventos.evento_tipo = "pelicula" and eventos.evento_estado = 1');
        $queryEventoPrincipal = DB::select('select eventos.* from eventos where eventos.evento_principal = 1 and eventos.evento_estado = 1');
        $queryEventosPasados = DB::select('select eventos.* from eventos where eventos.evento_tipo = "concierto" and eventos.evento_estado = 0');
        return View::make('home', compact('queryEventoPeliculas', 'queryEventoConciertos','queryEventoPrincipal','queryEventosPasados'));
        //dd($latest_eventos);
    }

    public function nosotros() {
        return View::make('nosotros');
    }

}

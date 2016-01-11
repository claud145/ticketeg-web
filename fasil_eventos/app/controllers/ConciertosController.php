<?php

use EntradasEventos\Entities\Eventos;
use EntradasEventos\Entities\Sectores;

class ConciertosController extends BaseController {

    public function vCrearEventoConcierto(){
        return View::make('superAdmin/eventoConciertos-crear');
    }

    public function gVerEventoConcierto(){
        return View::make('superAdmin/eventoConciertos-ver');
    }

    public function vCrearSectorConcierto(){
        return View::make('superAdmin/eventoConciertos-Sector-crear');
    }
/*
    public function pCrearEventoPartido(){
        Input::all();
        return dd('gg');
    }
    public function pEditarEventoPartido(){
        Input::all();
        return dd('gg');
    }
    public function pDeshabilitarEventoPartido(){

    }*/
}

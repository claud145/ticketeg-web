<?php
/**
 *
 */
namespace EntradasEventos\Repositories;
use EntradasEventos\Entities\Eventos;


class EventoRepo
{
    public function find($id){
      return Eventos::find($id);
    }
    public function all(){
      return Eventos::all();
    }
    public function findTipoPeliculas()
    {
      return Eventos::where('evento_tipo', '=', 'pelicula')->get();
    }
    public function findTipoConciertos()
    {
      return Eventos::where('evento_tipo', '=', 'concierto')->get();
    }
    public function findTipoPartidos()
    {
      return Eventos::where('evento_tipo', '=', 'partido')->get();
    }
    public function findLatest(){
        $auxOrdenados = Eventos::orderBy('created_at', 'DESC')->take(5)->get();
      return $auxOrdenados;
    }
    public function findLatestPeliculas(){
      return Eventos::where('evento_tipo','=','pelicula')->orderBy('created_at', 'DESC')->take(9)->get();
    }
}

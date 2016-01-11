<?php

use EntradasEventos\Entities\Eventos;
use EntradasEventos\Entities\Sectorhorario;
use EntradasEventos\Repositories\EventoRepo;

class SectoresController extends BaseController {

    protected $eventoRepo;
    protected $sectorRepo;

    public function __construct(EventoRepo $eventoRepo) {
        $this->eventoRepo = $eventoRepo;
    }

    public function crearsector() {
        $evento = $this->eventoRepo->all();
        return View::make('administrador/sectores/crearSector', compact('evento'));
    }

    public function register() {
        $name = Input::get('nombre_sector');
        $data = Input::only(['nombre_sector', 'precio_sector', 'evento']);

        $rules = [
            'nombre_sector' => 'required',
            'precio_sector' => 'required',
            'evento' => 'required',
        ];

        $validation = \Validator::make($data, $rules);

        if ($validation->passes()) {
            Sectorhorario::create($data);
            return Redirect::route('homeadmin');
        }

        return Redirect::back()->withInput()->withErrors($validation->messages());
        //return dd(Sectorhorario::all());
    }

}

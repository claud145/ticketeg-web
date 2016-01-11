<?php

use EntradasEventos\Entities\Eventos;
use EntradasEventos\Entities\Sectores;

class PartidosController extends BaseController {

    public function vCrearEventoPartido(){
        return View::make('superAdmin/eventoPartidos-crear');
    }

    public function pRegistrarEventoPartido(){
        $data = Input::only(['evento_nombre', 'evento_genero', 'evento_descripcion',  'evento_youtube', 'CP_lugar', 'evento_fechaInicio', 
                                'evento_fechaFin', 'evento_user', 'evento_principal', 'evento_password', 'slug']);

        $rules = [
            'evento_nombre' => 'required', 
            'evento_genero' => 'required', 
            'evento_descripcion' => 'required', 
            //'evento_img', 
            'evento_youtube', 
            'CP_lugar' => 'required', 
            'evento_fechaInicio' => 'required', 
            'evento_fechaFin' => 'required', 
            'evento_user' => 'required', 
            'evento_password' => 'required',
            'evento_principal' => 'required' ,
            
        ];

         $validation = \Validator::make($data, $rules);
         array_set($data, 'slug', \Str::slug($data['evento_nombre']));
         if ($validation->passes()) {
            if($data['evento_principal']== '1')
                {
                    $auxPrincipal = Eventos::where('evento_principal', '=', 1)->get();
                    foreach ($auxPrincipal as $auxPrincipals) {
                        $auxPrincipals->evento_principal = 0;
                        $auxPrincipals->save();
                    }
                        
                }
                    $destinationPath = '';
                    $filename        = '';
                    $destinationPathwall = '';
                    $filenamewall     = '';

                    if (Input::hasFile('image')) {
                        $file            = Input::file('image');
                        $destinationPath = public_path().'/img/';
                         $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                        $uploadSuccess   = $file->move($destinationPath, $filename);
                    }
                    if (Input::hasFile('imageBackground')) {
                        $file            = Input::file('imageBackground');
                        $destinationPathwall = public_path().'/img/';
                         $filenamewall        = str_random(6) . '_' . $file->getClientOriginalName();
                        $uploadSuccess   = $file->move($destinationPathwall, $filenamewall);
                    }

            $eventoPelicula = new Eventos($data);
                $eventoPelicula->evento_tipo = 'partido';
                $eventoPelicula->evento_img =  $filename;
                $eventoPelicula->evento_background =  $filenamewall;
                $eventoPelicula->evento_estado = 1;
                $eventoPelicula->evento_password = \Hash::make($data['evento_password']);
            $eventoPelicula->save();

            return Redirect::route('vCrearHorarioPartido',[$eventoPelicula->slug, $eventoPelicula->id]);
        }

        return Redirect::back()->withInput()->withErrors($validation->messages());
    }

    public function vCrearHorarioPartido($slug,$id){
        $evento = Eventos::find($id);
        return View::make('superAdmin/eventoPartidos-Sectores-crear',compact('evento'));
    }
    public function pRegistrarHorarioPartido(){
        $data = Input::only(['fk_evento', 'sector_nombre', 'sector_descripcion', 'sector_precio', 'sector_stock', 'sector_limiteStock']); 
        $dataAll = Input::all();  
        $rules = [
            'fk_evento' => 'required', 
            'sector_nombre' => 'required',
            'sector_descripcion' => 'required',
            'sector_precio' => 'required', 
            'sector_stock' => 'required', 
            'sector_limiteStock' => 'required'
        ];   
        $validation = \Validator::make($data, $rules); 
        if ($validation->passes()) {
            $sectorPartido = new Sectores($data);
                //estado 0=no 1=ok
                $sectorPartido->sector_estado = 1;
            $sectorPartido->save();
            return Redirect::route('vVerEventoPartido',[$dataAll['slug_evento'], $data['fk_evento'] ]);
        }
        return Redirect::back()->withInput()->withErrors($validation->messages());
    }
 
     public function vVerEvemtoPartido($slug,$id){
        $evento = Eventos::find($id);
        $queryPeliculaHorarios = DB::select('select sectores.* from sectores where sectores.sector_estado = 1 and sectores.fk_evento = '.$evento->id);
        return View::make('superAdmin/eventoPartidos-ver',compact('evento','queryPeliculaHorarios'));
     }

     public function vEditarEventoPartido($slug,$id){
        $evento = Eventos::find($id);
        return View::make('superAdmin/eventoPartidos-editar',compact('evento'));
     }
     public function pEditarEventoPartido(){
       $data = Input::only(['fk_evento','evento_nombre', 'evento_genero', 'evento_descripcion', 'evento_youtube', 'CP_lugar', 'evento_fechaInicio', 
                                'evento_fechaFin', 'evento_user', 'evento_password','evento_principal','slug']);

        $rules = [
            'evento_nombre' => 'required', 
            'evento_genero' => 'required', 
            'evento_descripcion' => 'required', 
            'evento_youtube', 
            'CP_lugar' => 'required', 
            'evento_fechaInicio' => 'required', 
            'evento_fechaFin' => 'required', 
            'evento_user' => 'required', 
            'evento_password' => 'required',
            'evento_principal' => 'required' 
        ];

         $validation = \Validator::make($data, $rules);
         array_set($data, 'slug', \Str::slug($data['evento_nombre']));
         if ($validation->passes()) {
            $destinationPath = '';
            $filename        = '';
            $destinationPathwall = '';
            $filenamewall     = '';
            if($data['evento_principal']== '1')
                {
                    $auxPrincipal = Eventos::where('evento_principal', '=', 1)->get();
                    foreach ($auxPrincipal as $auxPrincipals) {
                        $auxPrincipals->evento_principal = 0;
                        $auxPrincipals->save();
                    }
                        
                }

            $eventoPelicula = Eventos::find($data['fk_evento']);

                        $destinationPath = '';
                        $filename        = $eventoPelicula->evento_img;
                        $destinationPathwall = '';
                        $filenamewall     = $eventoPelicula->evento_background;

                    if (Input::hasFile('image')) {
                        $file            = Input::file('image');
                        $destinationPath = public_path().'/img/';
                         $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                        $uploadSuccess   = $file->move($destinationPath, $filename);
                    }
                    if (Input::hasFile('imageBackground')) {
                        $file            = Input::file('imageBackground');
                        $destinationPathwall = public_path().'/img/';
                         $filenamewall        = str_random(6) . '_' . $file->getClientOriginalName();
                        $uploadSuccess   = $file->move($destinationPathwall, $filenamewall);
                    }
                    
                $eventoPelicula->evento_nombre = $data['evento_nombre'];
                $eventoPelicula->evento_genero = $data['evento_genero'];
                $eventoPelicula->evento_descripcion = $data['evento_descripcion'];
                $eventoPelicula->evento_img = $filename;
                $eventoPelicula->evento_youtube = $data['evento_youtube'];
                $eventoPelicula->CP_lugar = $data['CP_lugar'];
                $eventoPelicula->evento_fechaInicio = $data['evento_fechaInicio'];
                $eventoPelicula->evento_fechaFin = $data['evento_fechaFin'];
                $eventoPelicula->evento_tipo = 'pelicula';
                $eventoPelicula->evento_user = $data['evento_user'];
                $eventoPelicula->evento_password = \Hash::make($data['evento_password']);
                $eventoPelicula->evento_principal = $data['evento_principal'];
                $eventoPelicula->evento_background = $filenamewall;
                $eventoPelicula->slug = $data['slug'];
            $eventoPelicula->save();

            return Redirect::route('vVerEvemtoPelicula',[$eventoPelicula->slug, $eventoPelicula->id]);
        }

        return Redirect::back()->withInput()->withErrors($validation->messages());
     }

     public function vEliminarEventoPartido($slug,$id){
 
        $eventoPelicula = Eventos::find($id);
            $eventoPelicula->evento_estado = 0;

            $queryPeliculaHorarios = DB::select('select sectores.* from sectores where sectores.fk_evento = '.$eventoPelicula->id);
            foreach ($queryPeliculaHorarios as $queryPeliculaHorarioss) {
                $horariodata = Sectores::find($queryPeliculaHorarioss->id);
                    $horariodata->sector_estado = 0;
                $horariodata->save();
            }

        $eventoPelicula->save();

        return Redirect::route('vBuscarEventos');
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

<?php

use EntradasEventos\Entities\Eventos;
use EntradasEventos\Entities\Horarios;

class PeliculasController extends BaseController {

    public function vCrearEventoPelicula(){
        return View::make('superAdmin/eventoPeliculas-crear');
    }

    public function pRegistrarEventoPelicula(){
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
                $eventoPelicula->evento_tipo = 'pelicula';
                $eventoPelicula->evento_img =  $filename;
                $eventoPelicula->evento_background =  $filenamewall;
                $eventoPelicula->evento_estado = 1;
                $eventoPelicula->evento_password = \Hash::make($data['evento_password']);
            $eventoPelicula->save();

            return Redirect::route('vCrearHorarioPelicula',[$eventoPelicula->slug, $eventoPelicula->id]);
        }

        return Redirect::back()->withInput()->withErrors($validation->messages());
    }

    public function vCrearHorarioPelicula($slug,$id){
        $evento = Eventos::find($id);
        return View::make('superAdmin/eventoPeliculas-Horarios-crear',compact('evento'));
    }
    public function pRegistrarHorarioPelicula(){
        $data = Input::only(['fk_evento', 'horario_descripcion', 'horario_precio', 'horario_stock', 'horario_limiteStock', 'horario_horaInicio', 'horario_horaFin']); 
        $dataAll = Input::all();  
        $rules = [
            'fk_evento' => 'required', 
            'horario_descripcion' => 'required',
            'horario_precio' => 'required', 
            'horario_stock' => 'required', 
            'horario_limiteStock' => 'required', 
            'horario_horaInicio' => 'required', 
            'horario_horaFin' => 'required' 
        ];   
        $validation = \Validator::make($data, $rules); 
        if ($validation->passes()) {
            $horarioPelicula = new Horarios($data);
                //estado 0=no 1=ok
                $horarioPelicula->horario_estado = 1;
            $horarioPelicula->save();
            return Redirect::route('vVerEvemtoPelicula',[$dataAll['slug_evento'], $data['fk_evento'] ]);
        }
        return Redirect::back()->withInput()->withErrors($validation->messages());
    }
 
     public function vVerEvemtoPelicula($slug,$id){
        $evento = Eventos::find($id);
        $queryPeliculaHorarios = DB::select('select horarios.* from horarios where horarios.horario_estado = 1 and horarios.fk_evento = '.$evento->id);
        return View::make('superAdmin/eventoPeliculas-ver',compact('evento','queryPeliculaHorarios'));
     }

     public function vEditarEventoPelicula($slug,$id){
        $evento = Eventos::find($id);
        return View::make('superAdmin/eventoPeliculas-editar',compact('evento'));
     }
     public function pEditarEventoPelicula(){
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

     public function vEliminarEventoPelicula($slug,$id){
 
        $eventoPelicula = Eventos::find($id);
            $eventoPelicula->evento_estado = 0;

            $queryPeliculaHorarios = DB::select('select horarios.* from horarios where horarios.fk_evento = '.$eventoPelicula->id);
            foreach ($queryPeliculaHorarios as $queryPeliculaHorarioss) {
                $horariodata = Horarios::find($queryPeliculaHorarioss->id);
                    $horariodata->horario_estado = 0;
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

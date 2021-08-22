<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medico_servicio_animal extends Model
{
    Protected $fillable = ["servicio_id","animal_id","user_id","fecha","estatus"];

    public function cita($request) {

        $cita = new medico_servicio_animal;
        
        $cita->servicio_id = $request->servicio_id;
        $cita->animal_id = $request->animal_id;
        $cita->user_id = $request->user_id;
        $cita->fecha = $request->fecha;
        $cita->estatus = $request->estatus;
        $cita->save();
        if (!$cita) {
            return response()->json(["success"=>false, "message" =>'Registro de cita fallida'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Registro de cita exitoso', 
                                 "cita" => $cita],201);

    }
}

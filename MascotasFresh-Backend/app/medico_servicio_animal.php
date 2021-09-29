<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


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

    public function citaPorAnimal(Request $request){
        try {
            $animal = Animal::findOrFail($request->id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Animal not found.',
                $e
            ], 404);
        }


        $citas = DB::Table('animals')->join('medico_servicio_animals','animals.id','=','medico_servicio_animals.user_id')
                                    ->join('users','medico_servicio_animals.user_id','=','users.id')
                                    ->join('servicios','medico_servicio_animals.servicio_id','=','servicios.id')
                                    ->where('animals.id','=',$animal->id)
                                    ->select('users.name','users.email','animals.especie','animals.raza','animals.nacimiento','animals.nombre as nombre_del_animal','animals.esterilizado','servicios.nombre as nombre_del_servicio','servicios.descripcion','medico_servicio_animals.fecha as fecha_de_la_cita')
                                    ->orderby('fecha','desc')->get();

        $citas;
        if (!$citas) {
            return response()->json(["success"=>false, "message" =>'Fallo en busqueda conctate con dev'],500);
        }
        return response()->json(["success"=>true,
                                 "message" =>'Busqueda exitosa ',
                                 "citas" => $citas],200);

    }
}

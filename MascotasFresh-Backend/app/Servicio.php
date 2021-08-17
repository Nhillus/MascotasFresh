<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Medico;
use App\Animal;

class Servicio extends Model
{
    //
    Protected $fillable = ["nombre","tipo","descripcion"];

    public function Servicio($request) {
        
        $servicio = new Servicio;
        
        $servicio->nombre = $request->nombre;
        $servicio->tipo = $request->tipo;
        $servicio->descripcion = $request->descripcion;
        $servicio->save();
        if (!$servicio) {
            return response()->json(["success"=>false, "message" =>'Registro de Servicio fallida'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Registro de Servicio exitoso', 
                                 "Servicio" => $servicio],201);

    }
    public function selecionarservicio($id) {
        $servicio = Servicio::findOrFail($id);
        if (!$servicio) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el servicio'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el servicio', 
                                 "Servicio" => $servicio],200);
    }
    
    public function eliminarservicio($id) {
        $servicio = Servicio::findOrFail($id);
        $servicioEliminada = $servicio->nombre; //luego esta linea se refactoriza
        $servicio->destroy($id);
        if (!$servicio) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el servicio o no se pudo eliminar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el servicio y Eliminado', 
                                 "Servicio_Eliminado" => $servicioEliminada,],200);

    }

    public function modificarservicio($id,$nombre) {
        $servicio = Servicio::findOrFail($id);
        $servicioModificado = $servicio->nombre; //luego esta linea se refactoriza
        $servicio->nombre = $nombre;
        $servicio->save();
        if (!$servicioModificado) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el servicio o no se pudo modificar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el servicio y modificado', 
                                 "Servicio_Previa_A_La_Modificacion" => $servicioModificado,
                                 "Servicio_Actual" => $servicio],200);

    }

    public function getAllservicios() {
        $servicios = Servicio::all();
        return $servicios; 
    }

    public function animales() {
        return $this->belongToMany(Animal::class, 'medico_servicio_animal');
    }

    public function medicos() {
        return $this->belongToMany(Medico::class, 'medico_servicio_animal');
    }

}

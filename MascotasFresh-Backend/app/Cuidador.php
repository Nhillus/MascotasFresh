<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Animal;

class Cuidador extends Model
{
    //
    Protected $fillable = ["DNI","nombre","email","numero"];

    public function Cuidador($request) {
        
        $cuidador = new Cuidador;
        
        $cuidador->DNI = $request->DNI;
        $cuidador->nombre = $request->nombre;
        $cuidador->email = $request->email;
        $cuidador->numero = $request->numero;
        $cuidador->save();
        if (!$cuidador) {
            return response()->json(["success"=>false, "message" =>'Registro de cuidador fallida'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Registro de cuidador exitoso', 
                                 "cuidador" => $cuidador],201);

    }
    public function selecionarCuidador($id) {
        $cuidador = Cuidador::findOrFail($id);
        if (!$cuidador) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el cuidador'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el cuidador', 
                                 "cuidador" => $cuidador],200);
    }
    
    public function eliminarCuidador($id) {
        $cuidador = Cuidador::findOrFail($id);
        $cuidadorEliminada = $cuidador->nombre; //luego esta linea se refactoriza
        $cuidador->destroy($id);
        if (!$cuidador) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el cuidador o no se pudo eliminar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el cuidador y Eliminado', 
                                 "cuidador_Eliminado" => $cuidadorEliminada,],200);

    }

    public function modificarCuidador($id,$nombre) {
        $cuidador = Cuidador::findOrFail($id);
        $cuidadorModificado = $cuidador->nombre; //luego esta linea se refactoriza
        $cuidador->nombre = $nombre;
        $cuidador->save();
        if (!$cuidadorModificado) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el cuidador o no se pudo modificar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el cuidador y modificado', 
                                 "Cuidador_Previa_A_La_Modificacion" => $cuidadorModificado,
                                 "Cuidador_Actual" => $cuidador],200);

    }

    public function getAllCuidadores() {
        $cuidadores = Cuidador::all();
        return $cuidadores; 
    }

    public function animales() {
        return $this->belongsToMany(Animal::class,'Animal_Cuidador');
    }
}

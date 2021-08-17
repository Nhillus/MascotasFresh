<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Animal;

class Medico extends Model
{
    //
    Protected $fillable = ["DNI","nombre","email","numero"];
    
    public function Medico($request) {
        
        $medico = new Medico;
        
        $medico->DNI = $request->DNI;
        $medico->nombre = $request->nombre;
        $medico->email = $request->email;
        $medico->numero = $request->numero;
        $medico->save();
        if (!$medico) {
            return response()->json(["success"=>false, "message" =>'Registro de medico fallida'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Registro de medico exitoso', 
                                 "medico" => $medico],201);

    }
    public function selecionarMedico($id) {
        $medico = Medico::findOrFail($id);
        if (!$medico) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el medico'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el medico', 
                                 "medico" => $medico],200);
    }
    
    public function eliminarMedico($id) {
        $medico = Medico::findOrFail($id);
        $medicoEliminada = $medico->nombre; //luego esta linea se refactoriza
        $medico->destroy($id);
        if (!$medico) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el medico o no se pudo eliminar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el medico y Eliminado', 
                                 "medico_Eliminado" => $medicoEliminada,],200);

    }

    public function modificarMedico($id,$nombre) {
        $medico = Medico::findOrFail($id);
        $medicoModificado = $medico->nombre; //luego esta linea se refactoriza
        $medico->nombre = $nombre;
        $medico->save();
        if (!$medicoModificado) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el medico o no se pudo modificar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el medico y modificado', 
                                 "Medico_Previa_A_La_Modificacion" => $medicoModificado,
                                 "Medico_Actual" => $medico],200);

    }

    public function getAllMedicos() {
        $Medicos = Medico::all();
        return $Medicos; 
    }

    public function animales() {
        return $this->hasMany(Animal::class);
    }
}

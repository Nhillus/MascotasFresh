<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cuidador;

class Animal extends Model
{
    //
    Protected $fillable = ["especie","raza","nombre","nacimiento","esterilizado"];
    Protected $cast = ['esterilizado' => 'boolean'];

    public function Animal($especie,$raza,$nombre,$nacimiento,$esterelizado) {
        
        $animal = new Animal;
        
        $animal->especie = $especie;
        $animal->raza = $raza;
        $animal->nombre = $nombre;
        $animal->nacimiento = $nacimiento;
        $animal->esterelizado = $esterelizado;
        $animal->save();
        if (!$animal) {
            return response()->json(["success"=>false, "message" =>'Registro de animal fallida'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Registro de animal exitoso', 
                                 "animal" => $animal],201);

    }
    public function selecionarAnimal($id) {
        $animal = Animal::findOrFail($id);
        if (!$animal) {
            return response()->json(["success"=>false, "message" =>'No se pudo enbcontrar el animal'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el animal', 
                                 "animal" => $animal],200);
    }
    /*public function verAnimal() {
        return animal();
    }*/ //esta es para ver una en especifico refactorizar
    public function eliminarAnimal($id) {
        $animal = Animal::findOrFail($id);
        $animalEliminada = $animal->nombre; //luego esta linea se refactoriza
        $animal->destroy($id);
        if (!$animal) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el animal o no se pudo eliminar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito la animal y Eliminado', 
                                 "animal_Eliminado" => $animalEliminada,],200);

    }

    public function modificarAnimal($id,$nombre) {
        $animal = Animal::findOrFail($id);
        $animalModificada = $animal->nombre; //luego esta linea se refactoriza
        $animal->nombre = $nombre;
        $animal->save();
        if (!$animalModificado) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el animal o no se pudo modificar consultar con dev'],500);
        }
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el animal y modificado', 
                                 "Animal_Previa_A_La_Modificacion" => $animalModificada,
                                 "Animal_Actual" => $animal],200);

    }
    public function modificarEstado($id,$estadoAModificar) {
        $animal = Animal::findOrFail($id);
        $animalEstadoPrevio = $animal->esterilizado;
        $animal->esterilizado = !$animalEstadoPrevio;
        $animal->save(); 
        if ($animalEstadoPrevio == $animalAModificar)
        {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el anima o no se pudo modificar la esterilizacion consultar con dev'],500);
        } 
        return response()->json(["success"=>true, 
                                 "message" =>'Encontrado con exito el animal y modificada su estado de esterilizacion', 
                                 "Animal_Previa_A_La_Modificacion" => $animalEstadoPrevio,
                                 "Animal_Actual" => $animal],200);
    }

    public function getAllAnimales() {
        $animal = Animal::all();
        return $animal; 
    }

    public function cuidadores() {
        return $this->hasMany(Cuidador::class);
    }

}

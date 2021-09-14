<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Cuidador;
use App\User;
use App\Servicio;
use App\medico_servicion_animal;

class Animal extends Model
{
    //
    Protected $fillable = ["especie","raza","nombre","nacimiento","esterilizado"];
    Protected $cast = ['esterilizado' => 'boolean'];

    public function Animal($request) {

        $animal = new Animal;

        $animal->especie = $request->especie;
        $animal->raza = $request->raza;
        $animal->nombre = $request->nombre;
        $animal->nacimiento = $request->nacimiento;
        $animal->esterilizado = $request->esterilizado;
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

    public function modificarAnimal($id,$request) {
        $animal = Animal::findOrFail($id);
        $animalModificado = $request->nombre; //luego esta linea se refactoriza
        $animal->especie = $request->especie;
        $animal->raza = $request->raza;
        $animal->nombre = $request->nombre;
        $animal->nacimiento = $request->nacimiento;
        $animal->save();
        if (!$animalModificado) {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el animal o no se pudo modificar consultar con dev'],500);
        }
        return response()->json(["success"=>true,
                                 "message" =>'Encontrado con exito el animal y modificado',
                                 "Animal_Previa_A_La_Modificacion" => $animalModificado,
                                 "Animal_Actual" => $animal],200);

    }
    public function modificarEstado($id,$estadoAModificar) {
        $animal = Animal::findOrFail($id);
        $animalEstadoPrevio = $animal->esterilizado;
        $animal->esterilizado = !$animalEstadoPrevio;
        $animal->save();
        if ($animalEstadoPrevio == $estadoAModificar)
        {
            return response()->json(["success"=>false, "message" =>'No se pudo encontrar el anima o no se pudo modificar la esterilizacion consultar con dev'],500);
        }
        return response()->json(["success"=>true,
                                 "message" =>'Encontrado con exito el animal y modificada su estado de esterilizacion',
                                 "Animal_Previa_A_La_Modificacion" => $animalEstadoPrevio,
                                 "Animal_Actual" => $animal],200);
    }

    public function getAllAnimales() {
        $animales = Animal::all();
        //Funcionalidad de ultimas citas
        foreach ($animales as $animal) {
            //
            $citas =  DB::table('users')->join('medico_servicio_animals','users.id','=','medico_servicio_animals.user_id')
                                        ->join('animals','medico_servicio_animals.animal_id','=','animals.id')
                                        ->join('servicios','medico_servicio_animals.servicio_id','=','servicios.id')
                                        ->where('animals.id','=',$animal->id)
                                        ->select('users.name','users.email','animals.nombre as nombre del animal','servicios.nombre as nombre_del_servicio', 'medico_servicio_animals.fecha as fecha_de_la_cita')
                                        ->orderby('fecha','desc')->take(3)->get();
            $animal['citas']= $citas;
        }
        return $animales;
    }

    public function cuidadores() {
        return $this->belongsToMany(Cuidador::class, 'animal_cuidador');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'medico_servicio_animal');
    }

    public function servicios() {
        return $this->belongsToMany(Servicio::class, 'medico_servicio_animal');
    }

}

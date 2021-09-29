<?php

namespace App\Http\Controllers;

use App\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $animal = new Animal;
        $allAnimales = $animal->getAllAnimales();
        return ['animales'=> $allAnimales];
    }
    public function indexByDoc(Request $request) {
        $animal = new Animal;
        $allAnimales = $animal->getAllAnimalesByDoctor($request);
        return ['animales'=> $allAnimales];
    }
    public function store(Request $request) {
            $animal = new Animal;
            $response=$animal->Animal($request);
            return $response;
    }
    public function update (Request $request) {
        $animal = new Animal;
        $response = $animal->modificarAnimal($request->id,$request);
        return $response;
    }
    public function destroy ($id) {
        $animal = new Animal;
        $response = $animal->eliminarAnimal($id);
        return $response;
    }
    public function UpdateStatus(Request $request) {
        $animal = new Animal;
        $response = $animal->modificarEstado($request->id,$request->estado);
        return $response;
    }
}

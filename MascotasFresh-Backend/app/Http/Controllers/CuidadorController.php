<?php

namespace App\Http\Controllers;

use App\Cuidador;
use Illuminate\Http\Request;

class CuidadorController extends Controller
{
    public function index() {
        $cuidador = new Cuidador;
        $allCuidadores = $cuidador->getAllCuidadores(); 
        return ['Cuidadores'=> $allCuidadores];
    }
    public function store(Request $request) {
            $cuidador = new Cuidador;
            $response=$cuidador->Cuidador($request);
            return $response;
    }
    public function update (Request $request) {
        $cuidador = new Cuidador;
        $response = $cuidador->modificarCuidador($request->id,$request->nombre);
        return $response;
    }
    public function destroy ($id) {
        $cuidador = new Cuidador;
        $response = $cuidador->eliminarCuidador($id);
        return $response;
    }
}

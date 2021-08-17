<?php

namespace App\Http\Controllers;

use App\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index() {
        $medico = new Medico;
        $allMedicos = $medico->getAllMedicos(); 
        return ['Medicos'=> $allMedicos];
    }
    public function store(Request $request) {
            $medico = new Medico;
            $response=$medico->Medico($request);
            return $response;
    }
    public function update (Request $request) {
        $medico = new Medico;
        $response = $medico->modificarMedico($request->id,$request->nombre);
        return $response;
    }
    public function destroy ($id) {
        $medico = new Medico;
        $response = $medico->eliminarCuidador($id);
        return $response;
    }
}

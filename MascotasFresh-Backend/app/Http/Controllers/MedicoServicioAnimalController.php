<?php

namespace App\Http\Controllers;

use App\medico_servicio_animal;
use Illuminate\Http\Request;

class MedicoServicioAnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function citasByAnimal(Request $request) {
        $citas = new medico_servicio_animal;
        $response = $citas->citaPorAnimal($request);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $cita = new medico_servicio_animal;
        $response=$cita->cita($request);
        return $response;
}

    /**
     * Display the specified resource.
     *
     * @param  \App\medico_servicio_animal  $medico_servicio_animal
     * @return \Illuminate\Http\Response
     */
    public function show(medico_servicio_animal $medico_servicio_animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medico_servicio_animal  $medico_servicio_animal
     * @return \Illuminate\Http\Response
     */
    public function edit(medico_servicio_animal $medico_servicio_animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medico_servicio_animal  $medico_servicio_animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, medico_servicio_animal $medico_servicio_animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medico_servicio_animal  $medico_servicio_animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(medico_servicio_animal $medico_servicio_animal)
    {
        //
    }
}

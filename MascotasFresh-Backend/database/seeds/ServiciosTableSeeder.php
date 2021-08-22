<?php

use Illuminate\Database\Seeder;
use App\Servicio;

class ServiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $servicios = 
        [   
            [
                'nombre'=> 'Desparasitacion',
                'tipo' => 'No-Quirurgico',
                'descripcion'=> 'Proceso realizado cada 3 o 6 meses, depende del peso y edad del animal, a partir de 3 meses de edad.', 
            ],[
                'nombre'=> 'Esterilizacion',
                'tipo' => 'Quirurgico',
                'descripcion'=> 'Se realiza a partir de los 6 meses de edad.'
            ],[
                'nombre'=> 'Vacunas',
                'tipo' => 'No-Quirurgico',
                'descripcion'=> 'La vacunacion es una vez al año, primera vez y refuerzos.'
            ],
            [   'nombre'=> 'Vitaminizaciòn',
                'tipo' => 'No-Quirurgico',
                'descripcion'=> 'Se realiza para subir las defensas del animal, cuando atraviesa un proceso de convalecencia.'
            ],[
                'nombre'=> 'Examenes de laboratorio',
                'tipo' => 'No-Quirurgico',
                'descripcion'=> 'Se realiza para diagnosticar algun tipo de variacion que pueda llevarnos a intuir una enfermedad.'
            ],
            [
                'nombre'=> 'Cirugia-General',
                'tipo' => 'Quirurgico',
                'descripcion'=> 'Se realiza para cualquier emergencia no prevista o tratamiento.'
            ]
        ];

        Servicio::insert($servicios);
        }
}

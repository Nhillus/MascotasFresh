<?php

use Illuminate\Database\Seeder;
use App\rol;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = 
        [   
            [
                'nombre_rol'=> 'Admin',
                'descripcion'=> 'Tiene acceso a todas las vistas y rutas del sistema.', 
            ],[
                'nombre_rol'=> 'Medico',
                'descripcion'=> 'Tiene acceso a su consultorio virtual y la info de sus pacientes.'
            ],[
                'nombre_rol'=> 'Asistente Producto',
                'descripcion'=> 'Tiene  acceso a todo lo relacionado con los productos.'
            ]
        ];
        rol::insert($roles);
    }
}

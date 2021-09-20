<?php

use Illuminate\Database\Seeder;
use App\Producto;


class ProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = factory(Producto::class, 10)->create();
    }
}

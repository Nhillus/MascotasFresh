<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producto;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Producto::class, function (Faker $faker) {
    return [
        //
        'nombre' => $faker->unique()->word,
        'cantidad' => $faker->numberBetween(50, 200),
        'precio' => $faker->randomFloat( 2, 1, 250),
        'lote' => $faker->ean13(), //
        'creado' => $faker->dateTimeBetween('-3 months', 'now', null),
        'vencimiento' => $faker->dateTimeInInterval( '-2 months', '+ 2 months',  null),
    ];
});

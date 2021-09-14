<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*----------------Rutas Middleware---------------------------*/
Route::middleware(['auth:api','role'])->group(function() {
    /*------------------------------------ Rutas Animales ----------------------------------------------*/
    Route::middleware(['scope:Admin,Medico'])->get('/animales','AnimalController@index');
    Route::middleware(['scope:Admin,Medico'])->post('/agregaranimal', 'AnimalController@store');
    Route::middleware(['scope:Admin,Medico'])->put('/modificaranimal', 'AnimalController@update');
    Route::middleware(['scope:Admin,Medico'])->delete('/eliminaranimal/{id}', 'AnimalController@destroy');

    /*----------------------Rutas Usuario ---------------------------------*/
    //Route::post('/registro', 'UserController@register'); no usaremos el registro hasta que existan algunos usuarios fuera de la veterinaria
    Route::middleware(['scope:Admin'])->get('/users','UserController@index');
    Route::get('/user', 'UserController@user')->middleware('auth:api');
    Route::middleware(['scope:Admin'])->post('/newuser','UserController@store');

    /*--------------------------------------------------citas-------------------------------------------*/
    Route::middleware(['scope:Admin,Medico'])->post('/agregarcita', 'MedicoServicioAnimalController@store');
    Route::middleware(['scope:Admin,Medico'])->get('/serviciosDisponibles','ServicioController@index');


});





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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('login', 'ApiLoginController@login');
Route::get('/user', 'UserController@user')->middleware('auth:api');
/*----------------Rutas Middleware---------------------------*/
Route::middleware(['auth:api','rol'])->group(function() {
    /*--------------- Rutas Animales ----------------------------*/
    Route::middleware(['scope:Admin,Medico'])->get('/animales','AnimalController@index');
    Route::middleware(['scope:Admin,Medico'])->post('/agregaranimal', 'AnimalController@store');
    Route::middleware(['scope:Admin,Medico'])->put('/modificaranimal', 'AnimalController@update');
    Route::middleware(['scope:Admin,Medico'])->delete('/eliminaranimal/{id}', 'AnimalController@destroy');

    /*----------------------------citas-------------------------------*/
    Route::middleware(['scope:Admin,Medico'])->post('/agregarcita', 'MedicoServicioAnimalController@store');
    Route::middleware(['scope:Admin,Medico'])->get('/serviciosDisponibles','ServicioController@index');

    /*----------------Rutas Usuario ---------------------------------*/
    //Route::post('/registro', 'UserController@register'); no usaremos el registro hasta que existan algunos usuarios fuera de la veterinaria
    Route::middleware(['scope:Admin'])->get('/users','UserController@index');
    Route::middleware(['scope:Admin'])->post('/newuser','UserController@store');

});
// lo que pasa es lo que explican en laracast que el token se crea al pedir la peticion y ese metodo de checkrole tengo que hacerlo en la aplicacion





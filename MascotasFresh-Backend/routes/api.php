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
/*--------------- Rutas Animales ----------------------------*/
Route::get('/animales','AnimalController@index');
Route::post('/agregaranimal', 'AnimalController@store');
Route::put('/modificaranimal', 'AnimalController@update');
Route::delete('/eliminaranimal/{id}', 'AnimalController@destroy');
/*----------------Rutas Usuario ---------------------------------*/
Route::get('/user', 'UserController@user')->middleware('auth:api');
//Route::post('/registro', 'UserController@register'); no usaremos el registro hasta que existan algunos usuarios fuera de la veterinaria
Route::get('/users','UserController@index');
Route::post('/newuser','UserController@store');

/*----------------------------citas-------------------------------*/
Route::post('/agregarcita', 'MedicoServicioAnimalController@store');
Route::get('/serviciosDisponibles','ServicioController@index');
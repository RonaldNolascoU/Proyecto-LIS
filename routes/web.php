<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//Rutas de mantenimiento de cliente
Route::resource('Cliente','ClienteController');

Route::post('Cliente/login','ClienteController@login');

Route::get('perfil','ClienteController@perfil')->middleware('login');

Route::get('cerrar','ClienteController@logout')->middleware('login');

Route::post('Cliente/clave','ClienteController@clave')->middleware('login');

Route::post('Cliente/imagen','ClienteController@imagen')->middleware('login');
//-----------------------------------------------------

//Rutas de mantenimiento de mascotas

Route::resource('Mascota','MascotaController');

Route::resource('Caracteristica','CaracteristicaController');

Route::post('Mascota/imagen','MascotaController@imagen')->middleware('login');

//-----------------------------------------------------

//Rutas de usuarios

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('Consulta','ConsultaController');

Route::post('/pasar','ConsultaController@pasar');

//-----------------------------------------------------

//Rutas AJAX

Route::post('/clienteMascota', 'ClienteController@ajax');

Route::post('/listaEntrantes','ConsultaController@llenarEntrantes');

Route::post('/conseguirMascota','ConsultaController@conseguirMascota');

Route::post('/conseguirVeterinario','ConsultaController@conseguirVeterinario');

Route::post('/veterinariosDesocupados', 'ConsultaController@veterinarios');

Route::post('/conseguirConsulta', 'ConsultaController@conseguirConsulta');

Route::post('/conseguirCliente', 'ConsultaController@conseguirCliente');

//-----------------------------------------------------
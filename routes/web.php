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

Route::get('/listaConsultas', 'MascotaController@listaConsultas');

Route::get('/detallesConsulta/{id}','MascotaController@pdf');

//-----------------------------------------------------

//Rutas de usuarios

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('Consulta','ConsultaController');

Route::post('/pasar','ConsultaController@pasar');

Route::resource('Sintoma','SintomaController');

Route::resource('Diagnostico','DiagnosticoController');

Route::resource('Medicamento','MedicamentoController');

Route::resource('Servicio','ServicioController');

Route::get('/pdf/{id}','ConsultaController@pdf');

//-----------------------------------------------------

//Rutas administrador

Route::resource('User','UserController');

Route::resource('TipoMascota','TipoMascotaController');

Route::resource('TipoMedicamento','TipoMedicamentoController');

//-----------------------------------------------------

//Rutas AJAX

Route::post('/clienteMascota', 'ClienteController@ajax');

Route::post('/listaEntrantes','ConsultaController@llenarEntrantes');

Route::post('/listaPago','ConsultaController@llenarPago');

Route::post('/conseguirMascota','ConsultaController@conseguirMascota');

Route::post('/conseguirVeterinario','ConsultaController@conseguirVeterinario');

Route::post('/veterinariosDesocupados', 'ConsultaController@veterinarios');

Route::post('/conseguirConsulta', 'ConsultaController@conseguirConsulta');

Route::post('/conseguirCliente', 'ConsultaController@conseguirCliente');

Route::post('/llenarSintomas','SintomaController@llenarSintomas');

Route::post('/llenarDiagnosticos','DiagnosticoController@llenarDiagnostico');

Route::post('/llenarServicios','ServicioController@llenarServicios');

Route::post('/finalizar', 'ConsultaController@finalizar');

Route::post('/costo', 'ConsultaController@costo');

Route::post('/pagar', 'ConsultaController@pagar');

//-----------------------------------------------------
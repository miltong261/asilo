<?php

use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/', function () {
//         return view('dashboard');
//     });
// });

// Auth::routes();

// Route::get('/register', function() {
//     return redirect('/login');
// });
// Route::get('/password/reset', function() {
//     return redirect('/login');
// });

Route::get('/', function () {
    return view('dashboard');
});

// Rutas de ejemplo
Route::get('/example', 'Dashboard\ExampleController@index');
Route::post('/example/store', 'Dashboard\ExampleController@store');
Route::put('/example/update', 'Dashboard\ExampleController@update');

/** Rutas de configuración */

// Tipo de producto
Route::get('/tipo_producto', 'Dashboard\TipoProductoController@index');
Route::get('/tipo_producto/combo', 'Dashboard\TipoProductoController@combobox');
Route::post('/tipo_producto/store', 'Dashboard\TipoProductoController@store');
Route::put('/tipo_producto/update', 'Dashboard\TipoProductoController@update');

// Unidad de medida
Route::get('/unidad_medida', 'Dashboard\UnidadMedidaController@index');
Route::get('/unidad_medida/combo', 'Dashboard\UnidadMedidaController@combobox');
Route::post('/unidad_medida/store', 'Dashboard\UnidadMedidaController@store');
Route::put('/unidad_medida/update', 'Dashboard\UnidadMedidaController@update');

/** Rutas de personal */

// Puestos
Route::get('/puestos', 'Dashboard\PuestoController@index');
Route::get('/puestos/combo', 'Dashboard\PuestoController@combobox');
Route::post('/puestos/store', 'Dashboard\PuestoController@store');
Route::put('/puestos/update', 'Dashboard\PuestoController@update');

/** Rutas de hogar */

// Residentes
Route::get('/residentes', 'Dashboard\ResidenteController@index');

/** Rutas de inventario */

// Medicamento
Route::get('/medicamentos', 'Dashboard\MedicamentoController@index');

// Producto
Route::get('/productos', 'Dashboard\ProductoController@index');

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
Route::group(['prefix' => 'example'], function () {
    Route::get('/', 'Dashboard\ExampleController@index');
    Route::post('/store', 'Dashboard\ExampleController@store');
    Route::put('/update', 'Dashboard\ExampleController@update');
});

/** Rutas de configuración */

// Tipo de producto
Route::group(['prefix' => 'tipo_producto'], function () {
    Route::get('/', 'Dashboard\TipoProductoController@index');
    Route::get('/combo_medicamento', 'Dashboard\TipoProductoController@comboboxMedicamento');
    Route::get('/combo_producto', 'Dashboard\TipoProductoController@comboboxProducto');
    Route::post('/store', 'Dashboard\TipoProductoController@store');
    Route::put('/update', 'Dashboard\TipoProductoController@update');
});

// Unidad de medida
Route::group(['prefix' => 'unidad_medida'], function () {
    Route::get('/', 'Dashboard\UnidadMedidaController@index');
    Route::get('/combo_medicamento', 'Dashboard\UnidadMedidaController@comboboxMedicamento');
    Route::get('/combo_producto', 'Dashboard\UnidadMedidaController@comboboxProducto');
    Route::post('/store', 'Dashboard\UnidadMedidaController@store');
    Route::put('/update', 'Dashboard\UnidadMedidaController@update');
});

/** Rutas de personal */

// Puestos
Route::group(['prefix' => 'puestos'], function () {
    Route::get('/', 'Dashboard\PuestoController@index');
    Route::get('/combo', 'Dashboard\PuestoController@combobox');
    Route::post('/store', 'Dashboard\PuestoController@store');
    Route::put('/update', 'Dashboard\PuestoController@update');
});

// Empleados
Route::group(['prefix' => 'empleados'], function () {
    Route::get('/', 'Dashboard\EmpleadoController@index');
    Route::post('/store', 'Dashboard\EmpleadoController@store');
    Route::put('/update', 'Dashboard\EmpleadoController@update');
});

/** Rutas de hogar */

// Residentes
Route::group(['prefix' => 'residentes'], function () {
    Route::get('/', 'Dashboard\ResidenteController@index');
});

/** Rutas de inventario */

// Medicamento
Route::group(['prefix' => 'medicamentos'], function () {
    Route::get('/', 'Dashboard\MedicamentoController@index');
    Route::post('/store', 'Dashboard\MedicamentoController@store');
    Route::put('/update', 'Dashboard\MedicamentoController@update');
});

// Producto
Route::group(['prefix' => 'productos'], function () {
    Route::get('/', 'Dashboard\ProductoController@index');
    Route::post('/store', 'Dashboard\ProductoController@store');
    Route::put('/update', 'Dashboard\ProductoController@update');
});

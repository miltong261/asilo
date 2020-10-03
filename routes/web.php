<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    Route::put('/activate', 'Dashboard\TipoProductoController@activate');
    Route::put('/desactivate', 'Dashboard\TipoProductoController@desactivate');
});

// Unidad de medida
Route::group(['prefix' => 'unidad_medida'], function () {
    Route::get('/', 'Dashboard\UnidadMedidaController@index');
    Route::get('/combo_medicamento', 'Dashboard\UnidadMedidaController@comboboxMedicamento');
    Route::get('/combo_producto', 'Dashboard\UnidadMedidaController@comboboxProducto');
    Route::post('/store', 'Dashboard\UnidadMedidaController@store');
    Route::put('/update', 'Dashboard\UnidadMedidaController@update');
    Route::put('/activate', 'Dashboard\UnidadMedidaController@activate');
    Route::put('/desactivate', 'Dashboard\UnidadMedidaController@desactivate');

});

/** Rutas de financiero */

// Tipo de movimiento
Route::group(['prefix' => 'tipo_movimiento'], function () {
    Route::get('/', 'Dashboard\TipoMovimientoController@index');
    Route::get('/combo', 'Dashboard\TipoMovimientoController@combobox');
    Route::post('/store', 'Dashboard\TipoMovimientoController@store');
    Route::put('/update', 'Dashboard\TipoMovimientoController@update');
    Route::put('/activate', 'Dashboard\TipoMovimientoController@activate');
    Route::put('/desactivate', 'Dashboard\TipoMovimientoController@desactivate');
});

// Movimiento
Route::group(['prefix' => 'movimientos'], function () {
    Route::get('/', 'Dashboard\MovimientoController@index');
    Route::get('/saldo', 'Dashboard\MovimientoController@showSaldo');
    Route::post('/store', 'Dashboard\MovimientoController@store');
    Route::put('/update', 'Dashboard\MovimientoController@update');
});

/** Rutas de personal */

// Áreas
Route::group(['prefix' => 'areas'], function () {
    Route::get('/', 'Dashboard\AreaController@index');
    Route::get('/combo', 'Dashboard\AreaController@combobox');
    Route::post('/store', 'Dashboard\AreaController@store');
    Route::put('/update', 'Dashboard\AreaController@update');
    Route::put('/activate', 'Dashboard\AreaController@activate');
    Route::put('/desactivate', 'Dashboard\AreaController@desactivate');

});

// Puestos
Route::group(['prefix' => 'puestos'], function () {
    Route::get('/', 'Dashboard\PuestoController@index');
    Route::get('/combo', 'Dashboard\PuestoController@combobox');
    Route::post('/store', 'Dashboard\PuestoController@store');
    Route::put('/update', 'Dashboard\PuestoController@update');
    Route::put('/activate', 'Dashboard\PuestoController@activate');
    Route::put('/desactivate', 'Dashboard\PuestoController@desactivate');

});

// Empleados
Route::group(['prefix' => 'empleados'], function () {
    Route::get('/', 'Dashboard\EmpleadoController@index');
    Route::post('/store', 'Dashboard\EmpleadoController@store');
    Route::put('/update', 'Dashboard\EmpleadoController@update');
    Route::put('/activate', 'Dashboard\EmpleadoController@activate');
    Route::put('/desactivate', 'Dashboard\EmpleadoController@desactivate');
    Route::put('/activate', 'Dashboard\EmpleadoController@activate');
    Route::put('/desactivate', 'Dashboard\EmpleadoController@desactivate');
});

/** Rutas de hogar */

// Residentes
Route::group(['prefix' => 'residentes'], function () {
    Route::get('/', 'Dashboard\ResidenteController@index');
    Route::post('/store', 'Dashboard\ResidenteController@store');
    Route::put('/update', 'Dashboard\ResidenteController@update');
});

/** Rutas de inventario */

// Ajuste de medicamento
Route::group(['prefix' => 'ajuste_producto'], function () {
    Route::get('/producto', 'Dashboard\AjusteProductoController@indexProducto');
    Route::get('/medicamento', 'Dashboard\AjusteProductoController@indexMedicamento');
    Route::post('/store', 'Dashboard\AjusteProductoController@store');
});

// Medicamento
Route::group(['prefix' => 'medicamentos'], function () {
    Route::get('/', 'Dashboard\MedicamentoController@index');
    Route::post('/store', 'Dashboard\MedicamentoController@store');
    Route::put('/update', 'Dashboard\MedicamentoController@update');
    Route::put('/activate', 'Dashboard\MedicamentoController@activate');
    Route::put('/desactivate', 'Dashboard\MedicamentoController@desactivate');
});

// Producto
Route::group(['prefix' => 'productos'], function () {
    Route::get('/', 'Dashboard\ProductoController@index');
    Route::post('/store', 'Dashboard\ProductoController@store');
    Route::put('/update', 'Dashboard\ProductoController@update');
    Route::put('/activate', 'Dashboard\ProductoController@activate');
    Route::put('/desactivate', 'Dashboard\ProductoController@desactivate');
});

// Inventario
Route::group(['prefix' => 'inventario'], function () {
    Route::get('/combo_producto', 'Dashboard\InventarioController@comboboxProducto');
    Route::get('/combo_medicamento', 'Dashboard\InventarioController@comboboxMedicamento');
});

/** Ruta de entradas */

Route::group(['prefix' => 'compras'], function () {
    Route::get('/' ,'Dashboard\CompraController@index');
});

/** Rutas de salidas */

Route::group(['prefix' => 'salidas'], function () {
    Route::get('/' ,'Dashboard\SalidaController@index');
});

/** Rutas de donaciones */

Route::group(['prefix' => 'donantes'], function () {
    Route::get('/', 'Dashboard\DonanteController@index');
    Route::get('/combo', 'Dashboard\DonanteController@combobox');
    Route::post('/store', 'Dashboard\DonanteController@store');
    Route::put('/update', 'Dashboard\DonanteController@update');
});

Route::group(['prefix' => 'donaciones'], function () {
    Route::get('/' ,'Dashboard\DonacionController@index');
});

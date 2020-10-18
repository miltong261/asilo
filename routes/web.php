<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/****************************** Rutas acceder al login ******************************/
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/change_password', 'Auth\PasswordChangeController@change')->name('change_password');
Route::post('/change_password', 'Auth\PasswordChangeController@newPassword');

/****************************** Rutas para usuarios autenticados ******************************/
Route::group(['middleware' => 'auth'], function () {
    /******************** Ruta principal ********************/
    Route::get('/asilo', function () {
        return view('layouts.app');
    })->name('asilo');

    /******************** Ruta para cerrar sesión ********************/
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    /******************** Rutas para el administrador ********************/
    Route::group(['middleware' => 'Administrador'], function () {
        /********** Rutas de autenticación **********/
        // Roles
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/combo', 'Dashboard\RolController@combobox');
        });

        // Usuarios
        Route::group(['prefix' => 'usuarios'], function () {
            Route::get('/', 'Dashboard\UserController@index');
            Route::get('/empleado', 'Dashboard\EmpleadoController@usuarios');
            Route::post('/store', 'Dashboard\UserController@store');
            Route::put('/update', 'Dashboard\UserController@update');
            Route::put('/activate', 'Dashboard\UserController@activate');
            Route::put('/desactivate', 'Dashboard\UserController@desactivate');
        });

        /********** Rutas de financiero **********/
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

        /********** Rutas de configuración **********/
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

        // Departamento
        Route::group(['prefix' => 'departamentos'], function () {
            Route::get('/', 'Dashboard\DepartamentoController@index');
            Route::get('/combo', 'Dashboard\DepartamentoController@combobox');
            Route::post('/store', 'Dashboard\DepartamentoController@store');
            Route::put('/update', 'Dashboard\DepartamentoController@update');
        });

        // Municipios
        Route::group(['prefix' => 'municipios'], function () {
            Route::get('/', 'Dashboard\MunicipioController@index');
            Route::get('/combo', 'Dashboard\MunicipioController@combobox');
            Route::post('/store', 'Dashboard\MunicipioController@store');
            Route::put('/update', 'Dashboard\MunicipioController@update');
        });

        /********** Rutas de personal **********/
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
            Route::get('/combo', 'Dashboard\EmpleadoController@combobox');
            Route::post('/store', 'Dashboard\EmpleadoController@store');
            Route::put('/update', 'Dashboard\EmpleadoController@update');
            Route::put('/activate', 'Dashboard\EmpleadoController@activate');
            Route::put('/desactivate', 'Dashboard\EmpleadoController@desactivate');
        });

        /********** Rutas de hogar **********/
        // Residentes
        Route::group(['prefix' => 'residentes'], function () {
            Route::get('/', 'Dashboard\ResidenteController@index');
            Route::post('/store', 'Dashboard\ResidenteController@store');
            Route::put('/update', 'Dashboard\ResidenteController@update');
            Route::put('/activate', 'Dashboard\ResidenteController@activate');
            Route::put('/desactivate', 'Dashboard\ResidenteController@desactivate');
            Route::put('/defuncion', 'Dashboard\ResidenteController@defuncion');
            Route::get('/pdf/{id}', 'Dashboard\ResidenteController@pdf');
        });

        /********** Rutas de inventario **********/
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
            Route::get('/vencimiento', 'Dashboard\MedicamentoController@vencimiento');
            Route::get('/vencidos', 'Dashboard\MedicamentoController@vencido');
        });

        // Producto
        Route::group(['prefix' => 'productos'], function () {
            Route::get('/', 'Dashboard\ProductoController@index');
            Route::post('/store', 'Dashboard\ProductoController@store');
            Route::put('/update', 'Dashboard\ProductoController@update');
            Route::put('/activate', 'Dashboard\ProductoController@activate');
            Route::put('/desactivate', 'Dashboard\ProductoController@desactivate');
            Route::get('/vencimiento', 'Dashboard\ProductoController@vencimiento');
            Route::get('/vencidos', 'Dashboard\ProductoController@vencido');
        });

        // Inventario
        Route::group(['prefix' => 'inventario'], function () {
            Route::get('/combo_producto', 'Dashboard\InventarioController@comboboxProducto');
            Route::get('/combo_medicamento', 'Dashboard\InventarioController@comboboxMedicamento');
            Route::get('/listar_producto_salida', 'Dashboard\InventarioController@listarProductosSalidas');
            Route::get('/listar_medicamento_salida', 'Dashboard\InventarioController@listarMedicamentosSalidas');
            Route::get('/listar_producto_entrada', 'Dashboard\InventarioController@listarProductosEntradas');
            Route::get('/listar_medicamento_entrada', 'Dashboard\InventarioController@listarMedicamentosEntradas');
        });

        /********** Ruta de entradas **********/

        Route::group(['prefix' => 'compras'], function () {
            Route::get('/' ,'Dashboard\CompraController@index');
            Route::get('/cabecera', 'Dashboard\CompraController@cabecera');
            Route::get('/detalle', 'Dashboard\CompraController@detalle');
            Route::post('/store', 'Dashboard\CompraController@store');
            Route::get('/pdf/{id}', 'Dashboard\CompraController@pdf');
        });

        /********** Rutas de salidas **********/

        Route::group(['prefix' => 'salidas'], function () {
            Route::get('/' ,'Dashboard\SalidaController@index');
            Route::get('/cabecera', 'Dashboard\SalidaController@cabecera');
            Route::get('/detalle', 'Dashboard\SalidaController@detalle');
            Route::post('/store', 'Dashboard\SalidaController@store');
            Route::get('/pdf/{id}', 'Dashboard\SalidaController@pdf');
        });

        /********** Rutas de donaciones **********/

        Route::group(['prefix' => 'donaciones'], function () {
            Route::get('/' ,'Dashboard\DonacionController@index');
            Route::get('/cabecera', 'Dashboard\DonacionController@cabecera');
            Route::get('/detalle', 'Dashboard\DonacionController@detalle');
            Route::post('/store', 'Dashboard\DonacionController@store');
            Route::get('/pdf/{id}', 'Dashboard\DonacionController@pdf');
        });

        /********** Rutas para dashboard **********/

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', 'Dashboard\DashboardController');
            Route::get('/dashboard_articulos', 'Dashboard\DashboardArticulosController');
            Route::get('/dashboard_medicamentos', 'Dashboard\DashboardMedicamentosController');
            Route::get('/dashboard_compras', 'Dashboard\DashboardComprasController');
        });
    });

    /******************** Rutas para la secretaria ********************/
    Route::group(['middleware' => 'Secretaria'], function () {
        /********** Rutas de configuración **********/
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

        /********** Rutas de hogar **********/
        // Residentes
        Route::group(['prefix' => 'residentes'], function () {
            Route::get('/', 'Dashboard\ResidenteController@index');
            Route::post('/store', 'Dashboard\ResidenteController@store');
            Route::put('/update', 'Dashboard\ResidenteController@update');
            Route::get('/pdf/{id}', 'Dashboard\ResidenteController@pdf');
        });

        /********** Rutas de inventario **********/
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
            Route::get('/vencimiento', 'Dashboard\MedicamentoController@vencimiento');
            Route::get('/vencidos', 'Dashboard\MedicamentoController@vencido');
        });

        // Producto
        Route::group(['prefix' => 'productos'], function () {
            Route::get('/', 'Dashboard\ProductoController@index');
            Route::post('/store', 'Dashboard\ProductoController@store');
            Route::put('/update', 'Dashboard\ProductoController@update');
            Route::put('/activate', 'Dashboard\ProductoController@activate');
            Route::put('/desactivate', 'Dashboard\ProductoController@desactivate');
            Route::get('/vencimiento', 'Dashboard\ProductoController@vencimiento');
            Route::get('/vencidos', 'Dashboard\ProductoController@vencido');
        });

        // Inventario
        Route::group(['prefix' => 'inventario'], function () {
            Route::get('/combo_producto', 'Dashboard\InventarioController@comboboxProducto');
            Route::get('/combo_medicamento', 'Dashboard\InventarioController@comboboxMedicamento');
            Route::get('/listar_producto_salida', 'Dashboard\InventarioController@listarProductosSalidas');
            Route::get('/listar_medicamento_salida', 'Dashboard\InventarioController@listarMedicamentosSalidas');
            Route::get('/listar_producto_entrada', 'Dashboard\InventarioController@listarProductosEntradas');
            Route::get('/listar_medicamento_entrada', 'Dashboard\InventarioController@listarMedicamentosEntradas');
        });

        /********** Rutas de salidas **********/

        Route::group(['prefix' => 'salidas'], function () {
            Route::get('/' ,'Dashboard\SalidaController@index');
            Route::get('/cabecera', 'Dashboard\SalidaController@cabecera');
            Route::get('/detalle', 'Dashboard\SalidaController@detalle');
            Route::post('/store', 'Dashboard\SalidaController@store');
            Route::get('/pdf/{id}', 'Dashboard\SalidaController@pdf');
        });

        /********** Rutas de donaciones **********/

        Route::group(['prefix' => 'donaciones'], function () {
            Route::get('/' ,'Dashboard\DonacionController@index');
            Route::get('/cabecera', 'Dashboard\DonacionController@cabecera');
            Route::get('/detalle', 'Dashboard\DonacionController@detalle');
            Route::post('/store', 'Dashboard\DonacionController@store');
            Route::get('/pdf/{id}', 'Dashboard\DonacionController@pdf');
        });

        /********** Rutas para dashboard **********/

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/dashboard_articulos', 'Dashboard\DashboardArticulosController');
            Route::get('/dashboard_medicamentos', 'Dashboard\DashboardMedicamentosController');
            Route::get('/dashboard_compras', 'Dashboard\DashboardComprasController');
        });
    });

    /******************** Rutas para la enfermera ********************/
    Route::group(['middleware' => 'Enfermera'], function () {

    });
});

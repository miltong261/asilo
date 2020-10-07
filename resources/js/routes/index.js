import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes: [
        // Rutas de configuración
        {
            path: '/categorias',
            component: require('../views/TipoProducto').default
        },
        {
            path: '/unidad_medida',
            component: require('../views/UnidadMedida').default
        },
        {
            path: '/departamentos',
            component: require('../views/Departamentos').default
        },
        {
            path: '/municipios',
            component: require('../views/Municipios').default
        },
        // Rutas de financiero
        {
            path: '/tipo_movimiento',
            component: require('../views/TipoMovimiento').default
        },
        {
            path: '/movimiento_caja',
            component: require('../views/MovimientoCaja').default
        },
        // Rutas de personal
        {
            path: '/areas',
            component: require('../views/Areas').default
        },
        {
            path: '/puestos',
            component: require('../views/Puestos').default
        },
        {
            path: '/empleados',
            component: require('../views/Empleados').default
        },
        // Rutas de hogar
        {
            path: '/residentes',
            component: require('../views/Residentes').default
        },
        // Rutas de inventario
        {
            path: '/ajuste_medicamento',
            component: require('../views/AjusteMedicamento').default
        },
        {
            path: '/ajuste_articulo',
            component: require('../views/AjusteProducto').default
        },
        {
            path: '/articulos',
            component: require('../views/Productos').default
        },
        {
            path: '/medicamentos',
            component: require('../views/Medicamentos').default
        },
        //Ruta de entradas
        {
            path: '/compras',
            component: require('../views/Compras').default
        },
        // Ruta de salidas
        {
            path: '/salidas',
            component: require('../views/Salidas').default
        },
        // Ruta de donaciones
        {
            path: '/donaciones',
            component: require('../views/Donaciones').default
        }
    ],
    mode: 'history'
})

import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes: [
        /********** Ruta principal **********/
        {
            path: '/asilo',
            component: require('../views/Bienvenida').default
        },

        /********** Ruta para usuarios **********/
        {
            path: '/usuarios',
            component: require('../views/Usuarios').default
        },
        {
            path: '/usuarios/perfil',
            component: require('../views/Perfil').default
        },

        /********** Rutas financiero **********/
        {
            path: '/tipo_movimiento',
            component: require('../views/TipoMovimiento').default
        },
        {
            path: '/movimientos',
            component: require('../views/MovimientoCaja').default
        },

        /********** Rutas configuración **********/
        {
            path: '/tipo_producto',
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

        /********** Rutas personal **********/
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

        /********** Ruta hogar **********/
        {
            path: '/residentes',
            component: require('../views/Residentes').default
        },

        /********** Rutas enfermería **********/
        {
            path: '/signos',
            component: require('../views/Signos').default
        },
        {
            path: '/notas',
            component: require('../views/Notas').default
        },
        {
            path: '/kardex',
            component: require('../views/Kardex').default
        },

        /********** Rutas inventario **********/
        {
            path: '/ajuste_producto/medicamento',
            component: require('../views/AjusteMedicamento').default
        },
        {
            path: '/ajuste_producto/producto',
            component: require('../views/AjusteProducto').default
        },
        {
            path: '/productos',
            component: require('../views/Productos').default
        },
        {
            path: '/medicamentos',
            component: require('../views/Medicamentos').default
        },

        /********** Ruta entrada **********/
        {
            path: '/compras',
            component: require('../views/Compras').default
        },

        /********** Ruta salida **********/
        {
            path: '/salidas',
            component: require('../views/Salidas').default
        },

        /********** Ruta donación **********/
        {
            path: '/donaciones',
            component: require('../views/Donaciones').default
        },

        /********** Rutas dashboard **********/
        {
            path: '/dashboard',
            component: require('../views/Dashboard').default
        },
        {
            path: '/dashboard/dashboard_articulos',
            component: require('../views/DashboardArticulos').default
        },
        {
            path: '/dashboard/dashboard_medicamentos',
            component: require('../views/DashboardMedicamentos').default
        },
        {
            path: '/dashboard/dashboard_compras',
            component: require('../views/DashboardCompras').default
        }
    ],
    mode: 'history'
})

import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/example',
            component: require('../views/Example').default
        },
        {
            path: '/tipo_producto',
            component: require('../views/TipoProducto').default
        },
        {
            path: '/unidad_medida',
            component: require('../views/UnidadMedida').default
        },
        {
            path: '/puestos',
            component: require('../views/Puestos').default
        }
    ],
    mode: 'history'
})

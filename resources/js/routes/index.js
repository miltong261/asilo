import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/example',
            component: require('../views/Example').default
        }
    ],
    mode: 'history'
})

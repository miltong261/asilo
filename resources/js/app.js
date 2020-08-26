require('./bootstrap');

window.Vue = require('vue');


import router from './routes/index.js'

const app = new Vue({
    el: '#container',
    router
});

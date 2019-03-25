import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import route from './Routes/routes';
let app = new Vue({
    el: '#app',
    router:new VueRouter(route)
})

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import VueAuthenticate from 'vue-authenticate'
import axios from 'axios';
Vue.use(VueAxios, axios)
Vue.use(VueAuthenticate, {
  baseUrl: '/api/v1/', 
  storageType: 'localStorage',
  tokenName: 'token',
  providers: {
    github: {
      clientId: 'c4afcd96226a1b80739c',
      redirectUri: '/auth/github/callback',
       
    }
  }
})
Vue.use(VueRouter);
import route from './Routes/routes';
let app = new Vue({
    el: '#app',
    router:new VueRouter(route),
   
})

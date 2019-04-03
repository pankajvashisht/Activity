import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import VueAuthenticate from 'vue-authenticate'
import axios from 'axios';
import navBar from './components/navBar';
Vue.use(VueAxios, axios)
Vue.use(VueAuthenticate, {
  baseUrl: '/api/v1/', 
  storageType: 'localStorage',
  tokenName: 'token',
  providers: {
    github: {
      clientId: 'c4afcd96226a1b80739c',
      redirectUri: '',
       
    }
  }
})
Vue.use(VueRouter);
if(document.querySelector("meta[name='user-id']").getAttribute('content') !=null){
    Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
    Vue.prototype.$auth_key = document.querySelector("meta[name='auth-key']").getAttribute('content');
}
if(localStorage.getItem("users")!= undefined){
  Vue.prototype.authuser=localStorage.getItem("users");
}
console.log(localStorage.getItem("users"));
import route from './Routes/routes';
let app = new Vue({
    el: '#app',
    router:new VueRouter(route),
    mounted:function(){
     if(localStorage.getItem("users")==undefined || localStorage.getItem("users")=='undefined' ){
      this.$router.push({ name: 'login' })
     }
    },
    components:{
      navbar:navBar
    },
    method:{
      logout:function(){
          localStorage.removeItem('users');
          this.$router.push({ name: 'login' })
      }
  }
   
})

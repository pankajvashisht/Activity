import login from '../components/login';
import  notfound  from '../components/notfound';
export default {
    mode:"history",
    routes:[
        {
            path:"*",
            component:notfound
        },
        {
            path:'/login',
            component:login,
            name:'login'
        },
     

    ]
}
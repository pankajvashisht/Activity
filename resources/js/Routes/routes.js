import login from '../components/login';
import  notfound  from '../components/notfound';
import  test  from '../components/test';
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
        {
            path:'/test',
            component:test,
            name:'test',
            
        }
     

    ]
}
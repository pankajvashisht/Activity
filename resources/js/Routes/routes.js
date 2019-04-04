import login from '../components/login';
import  notfound  from '../components/notfound';
import  test  from '../components/test';
import callback from '../components/callback';
import Booking from '../components/BookGame';
import MyBooking from '../components/myBooking';
export default {
    mode:"history",
    routes:[
        {
            path:"*",
            component:notfound
        },
        
        {
            path:'/test',
            component:test,
            name:'test',
            meta: {
                auth: true
            }
            
        },{
            path :'/callback',
            component:callback,
            name:'callback',
            meta:{
                auth :true
            }
        },{
            path :'/booking',
            component:Booking,
            name:'booking',
            meta:{
                auth :true
            }
        },{
            path :'/mybooking',
            component:MyBooking,
            name:'mybooking',
            meta:{
                auth :true
            }
            
        },{
            path:'/login',
            component:login,
            name:'login',
            meta: {
                auth: true
            }
        },
     

    ]
}
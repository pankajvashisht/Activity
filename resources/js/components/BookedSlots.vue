<template>
    
    <div>
       <h5 class="text-center">Booked Slots</h5>
        <hr>
        <div class="row">
            <div class="col-3 mb-5">
                <div class="card">
                    <div class="card-header text-center text-white bg-info">
                        Book Your Slot
                    </div>
                    <div class="card-body" style="height: 290px;">
                         <router-link class="nav-link text-center" active-class="active" to="booking">
                             <i class="fa fa-plus-circle" style="font-size:50px;padding-top: 94px;" aria-hidden="true"></i>
                         </router-link>  
                    </div>
                </div>
            </div>
             <div class="col-3 mb-5" v-for="booking in  allBooking" v-bind:key="booking.id">
                <div class="card">
                    <div class="card-header  text-white bg-info">
                        {{(booking.booking.game!=null)?booking.booking.game.name:'Game Name'}}
                        <span class="float-right text-white">
                          <b>Playing Date : </b>  {{timeToDate(booking.booking.booking_date)}}
                        </span>
                    </div>
                    <div class="card-body">  
                        <b>Booked By </b> : {{booking.booking.user.name}}
                        <hr>
                        <b> Slot </b> : {{(booking.booking.slot!=null)?booking.booking.slot.to:''}} - {{(booking.booking.slot!=null)?booking.booking.slot.from:''}}
                        <hr>
                        <Span class="text-center"><h4>Players</h4></Span>
                        <div class="user-detail-col" v-for="(user,index) in booking.players" v-bind:key="user.id">
                            <span class="user-count">{{index+1}}) </span> <span><img class="rounded" v-bind:src="user.social_image" height="30px" width="30px"/> <h6>{{user.name}}</h6></span> <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
export default {
    data:function() {
        return {
            allBooking:[]
        }    
    },
    mounted: function(){ 
        this.axios.get('api/v1/all_bookings/', {
            headers: {
                'Content-Type': 'application/json',
                'Authorization-key': this.$auth_key
            },
        }).then((response) => {
                this.allBooking= response.data.body;
        }).catch((error) => {
                console.error(error);
        })
    },
    methods:{
        timeToDate:function(timestamp){
            console.log(timestamp);
            let date = new Date(timestamp*1000);
            let month = date.getMonth(); 
            let day = date.getDay(); 
            let year = date.getFullYear(); 
            return day+"-"+month+"-"+year;
        },
    }
}
</script>

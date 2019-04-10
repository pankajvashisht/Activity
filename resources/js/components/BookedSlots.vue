<template>
    
    <div>
       <h5 class="text-center">Booked Slots</h5>
        <hr>
        <div class="text-center">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="sel1">Select Game:</label>
                        <select class="form-control" required="true" v-on:change="getbooking()" v-model="game_id">
                                <option value="0">--Please select Game--</option>
                                <option v-for="game in games" v-bind:key="game.id" v-bind:value="game.id">{{game.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="sel1">Select Slots:</label>
                        <select class="form-control" required="true"  v-on:change="getbooking()" v-model="slot_id">
                                <option value="0">--Please select slot--</option>
                                <option v-for="slot in slots" v-bind:key="slot.id" v-bind:value="slot.id">{{slot.to}}-{{slot.from}}</option>
                        </select> 
                    </div>  
                    
                </div>
                <div class="col-3"></div>
            </div>
        </div>
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
            allBooking:[],
            games:[],
            temp_array:[],
            slots:[],
            game_id:0,
            slot_id:0
        }    
    },
    filters: {
        //todo
    },
    created: function(){ 
        this.axios.get('api/v1/all_bookings/', {
            headers: {
                'Content-Type': 'application/json',
                'Authorization-key': this.$auth_key
            },
        }).then((response) => {
                response.data.body = response.data.body.sort((a,b) => a.booking.booking_date-b.booking.booking_date);    
                this.allBooking= response.data.body;
                this.temp_array = response.data.body;
        }).catch((error) => {
                console.error(error);
        })

        this.axios.get('api/v1/games', {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': this.$auth_key
                },
            })
            .then((response) => {
               this.games= response.data.body;
               
            })
            .catch((error) => {
                console.error(error);
         })

         this.axios.get('api/v1/slot/', {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': this.$auth_key
                },
            })
            .then((response) => {
               this.slots= response.data.body;
            })
            .catch((error) => {
                console.error(error);
         })
    },
    methods:{
        timeToDate:function(timestamp){
            let a = new Date(timestamp * 1000);
            let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            let year = a.getFullYear();
            let month = months[a.getMonth()];
            let date = a.getDate();
            var time = date + '-' + month + '-' + year;
            return time;
        },

        getbooking:function(){
            this.allBooking = this.temp_array;
            this.allBooking = this.allBooking.filter((value) => {
                if(this.game_id != 0 && this.slot_id == 0 ){
                    if(this.game_id==value.booking.game_id){
                        return value;
                    }
                }
                if(this.slot_id != 0 && this.game_id == 0){
                    if(this.slot_id==value.booking.slot_id){
                        return value;
                    }
                }
                if(this.slot_id != 0 && this.game_id != 0){
                    if(this.slot_id==value.booking.slot_id && this.game_id==value.booking.game_id ){
                        return value;
                    }
                }   
               
            });
        }
    }
}
</script>

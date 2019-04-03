<template>
    <div class="container">
        <h5 class="text-center">My Bookings</h5>
        <hr>
      <div class="card mb-4" v-for="booking in mybooking" v-bind:key="booking.id">
          <div class="card-header text-white bg-info">
              {{booking.booking.game.name}}
              <span class="float-right"><b>Playing Date </b> {{timeToDate(booking.booking.booking_date)}}</span>
          </div>
          <div class="card-body">
              <b>Booked By </b> : {{booking.booking.user.name}}
              <hr>
              <b>Slots </b> : {{booking.booking.slot.to}} - {{booking.booking.slot.from}}
              <hr>
              <Span class="text-center"><h4>Players</h4></Span>
              <div class="user-detail-col" v-for="(user,index) in booking.players" v-bind:key="user.id">
                  <span class="user-count">{{index+1}}) </span> <span><img class="rounded" v-bind:src="user.social_image" height="30px" width="30px"/> <h6>{{user.name}}</h6></span> <br>
                 
              </div>
          </div>
      </div>
     </div> 
</template>

<script>
    export default {
        name:"mybooking",
        data:function() {
            return {
                mybooking:[]
            }
            
        },
         mounted: function(){ 
             this.axios.get('api/v1/bookings/'+this.$userId, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': this.$auth_key
                },
            })
            .then((response) => {
               this.mybooking= response.data.body;
            })
            .catch((error) => {
                console.error(error);
             })
         },methods:{
             timeToDate:function(date){
                 return new Date(date*1000)
             }
         }
    }
</script>

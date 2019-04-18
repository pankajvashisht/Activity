<template>
  <div class="container">
       <h5 class="text-center">Book Your Slot</h5>
        <hr>
  <div class="card">
  <div class="card-header text-center text-white bg-info"> Book Slot </div>

  <div class="card-body">
    <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="sel1">Select Game:</label>
                      <Games  @change="updateGame"></Games>
                </div>
            </div>
            <div class="col-6">
                 <div class="form-group">
                    <label for="sel1">Select Date:</label> 
                    <datepicker @closed="getSlot(1)" v-model="booking_date" class="form-control" :disabledDates="state.disabledDates" ></datepicker>
                 </div>  
                
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="sel1">Select Slot:</label>
                    <select class="form-control" required="true"  v-on:change="filterFriend()" v-model="slot_id">
                             <option value="0">--Please select slot--</option>
                            <option v-for="slot in slots" v-bind:key="slot.id" v-bind:value="slot.id">{{slot.to}}-{{slot.from}}</option>
                    </select>
                </div>
            </div>
            <div class="col-6" >
                
                <div class="form-group" >
                   <div class="select-friend-box" v-for="(play, index) in  player"  v-bind:key="index"  >
                        <label for="sel1">Select Friend <span v-show="min_member>2">{{index+1}} </span> :</label> 
                        <div class="form-box">
                            <select class="form-control" required="true"  v-model="play.id">
                                    <option value="0">--Please select Player--</option>
                                    <option v-for="user in users" v-bind:key="user.id" data-class="avatar" v-bind:style="{ backgroundImage: 'url(' + user.social_image + ')' }" v-bind:value="user.id">{{user.name}}</option>
                            </select>
                            <div class="input-group-prepend" v-show="index>0">
                                <i class="fa fa-trash" v-on:click="remove(index)"  aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" v-show="min_member>2 && selected_game.total_player_play-2>=player.length">
                       <button style="margin-top: 10px;float: right;"  v-on:click="addMore()" class="btn btn-info btn-sm"> +Add More </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
 
  
    <div class="card-footer text-center">
        <button v-on:click="createBooking()" :disabled="disabled" class="btn btn-info btn-primary">Save <i class="fa fa-spinner fa-spin" v-show="disabled" ></i>  </button>

   </div>
   </div>
</div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import Games from './FormCompents/Games';
export default {
  name: 'booking',
  data:function() {
      return {
            games:[],
            users:[],
            slots:[],
            allFriend:[],
            game_id:0,
            slot_id:0,
            disabled:false,
            selected_game:[],
            min_member:1,
            booking_date: new Date(),
            first: new Date().getDate() - new Date().getDay(),
            last : this.first+6,
            state: {
                disabledDates: {
                    to: new Date((new Date().getTime()-3600000)), // Disable all dates up to specific date
                    from: new Date(new Date().setDate( new Date().getDate() - new Date().getDay()+5)),
                }
            } ,
            player:[
                {
                   id:0,
                   name:'Please Select' 
                }
            ],
            
            }
  },components: {
        Datepicker,
        Games
  },created() {
        this.getFriend();
  }, methods:{
      updateGame:function(game_id,games){
          this.games =  games;
          this.game_id = game_id;
          this.getSlot(0);
      },
      getSlot:function(type)  {
          if(!type){
              this.removeplayer();
          }
          let timestamp = parseInt(new Date(this.booking_date).getTime()/1000);
          this.minMember()
          this.axios.get('api/v1/slot/'+this.game_id+'/'+timestamp, {
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
      minMember:function(){
          for(let i=0;i < this.games.length;i++){
              if(this.games[i].id==this.game_id){
                    this.min_member = this.games[i].total_player_play;
                    this.selected_game=this.games[i];
              }
          }
      },

      getFriend:function(){
           this.axios.get('api/v1/get_users/'+this.$userId, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': this.$auth_key
                },
            })
            .then((response) => {
                this.allFriend = response.data.body;
                this.users = this.allFriend.filter(data => data.total_booked_slots<2);
            })
            .catch((error) => {
                console.error(error);
         })
      }, addMore:function() {
         if(this.selected_game.total_player_play==this.player.length){
             return false;
          }
         this.player.push( {
                   id:0,
                   name:'Please Select' 
        });
      }, removeplayer:function(){
          
          if(this.selected_game.total_player_play==4){
              if(this.player.length>1){
                    this.player.splice(1,2);
              }
          }
      }, remove:function(index){
          this.player.splice(index,1);
      }, createBooking:function(){
         var bodyFormData = new FormData();
         if(this.game_id==0){
             swal("Error", "Please Select Game", "error");
             return false;
         }
         if(this.slot_id==0){
             swal("Error", "Please Select Slot", "error");
             return false;
         }
         bodyFormData.append('slot_id',this.slot_id);
         bodyFormData.append('game_id',this.game_id);
         bodyFormData.append('user_id',this.$userId);
         bodyFormData.append('booking_date',this.setHour());
         let users =[];
         for(let i=0; i<this.player.length; i++){
             if(this.player[i].id == 0 || users.indexOf(this.player[i].id) !='-1' ){
                  swal("Error", "You select Duplicate friend", "error");
                 return false;
             }
             users.push(this.player[i].id);
         }
         bodyFormData.append('players',users.toString());
         this.disabled=true;
         this.axios.post('api/v1/create_booking', bodyFormData , {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': this.$auth_key
                },
            })
            .then((response) => {
                swal("Information", "Your Slot Booked Successfully", "success");
                this.disabled=false;
                 this.$router.push({ name: 'mybooking' })
            })
            .catch((error) => {
                 this.disabled=false;
                console.log(error.response);
                 swal("Error", error.response.data.error_message, "error");
         })
      }, setHour:function(){
            let date = new Date(this.booking_date);
            let selected_slot = this.slots.filter(data => this.slot_id==data.id);
            let times = selected_slot[0].to.split(':');
            let hour = times[0];
            let mins = times[1];
            date.setHours(hour);
            date.setMinutes(mins);
            return parseInt(date.getTime()/1000);
      }, filterFriend:function(){
            let selected_slot = this.slots.filter(data => this.slot_id==data.id);
            let times = selected_slot[0].to.split(':');
            let hour = times[0];
            if(hour>=19) {
                this.player = [
                    {
                    id:0,
                    name:'Please Select' 
                    }
                ]
                this.users = this.allFriend;
                return false;
            }
            this.users = this.allFriend.filter(data => data.total_booked_slots<2)  
      }
  }
}
</script>


<style>
  .user-detail-col {
    display: flex;
    width: 100%;
    flex-flow: row;
    margin: 0 0 20px;
  }
  .user-detail-col img {
      margin: 0 15px;
  }
  .user-detail-col span {
      display: flex;
  }
  .select-friend-box {
      margin: 15px 0 0;
  }
  .form-box {
      display: flex;
  }
  .form-box select {
      margin: 0 10px 0;
  }
  .vdp-datepicker *{
      border: 0;
  }
  option.avatar {
      background-repeat: no-repeat !important;
      padding-left: 20px;
 }
</style>

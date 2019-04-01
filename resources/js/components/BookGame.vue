<template >
  <div class="container">
  <div class="card">
  <div class="card-header"> Book Slot </div>

  <div class="card-body">
    <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="sel1">Select Game:</label>
                    <select class="form-control" required="true" v-on:change="getSlot()" v-model="game_id">
                            <option value="0">--Please select Game--</option>
                            <option v-for="game in games" v-bind:id="game.id" v-bind:value="game.id">{{game.name}}</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="sel1">Select Slot:</label>
                    <select class="form-control" required="true"  v-on:change="getFriend()" v-model="slot_id">
                             <option value="0">--Please select slot--</option>
                            <option v-for="slot in slots" v-bind:id="slot.id" v-bind:value="slot.id">{{slot.to}}-{{slot.from}}</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="sel1">Select Friends:</label> 
                    <select class="form-control" required="true"  v-model="player[0].id">
                              <option value="0">--Please select Player--</option>
                            <option v-for="user in users" v-bind:id="user.id" v-bind:value="user.id">{{user.name}}</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group" v-show="min_member>2">
                     <button style="margin-top: 30px;" v-on:click="addMore()" class="btn btn-info btn-sm"> +Add More </button>
                </div>
            </div>
        </div>
    </div>
 
  
    <div class="card-footer text-center">
        <button v-on:click="createBooking()" class="btn btn-info btn-primary">Save</button>

   </div>
   </div>
</div>
</template>

<script>
export default {
  name: 'booking',
  data:function() {
      return {
            games:[],
            users:[],
            slots:[],
            game_id:0,
            slot_id:0,
            min_member:1,
            player:[
                {
                   id:0,
                   name:'Please Select' 
                }
            ],
            
      }
    
  },
  mounted() {
      this.axios.get('api/v1/games', {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': '78a8a3178e8ed199b8a5323629a949e7bbdc833b'
                },
            })
            .then((response) => {
               this.games= response.data.body;
               
            })
            .catch((error) => {
                console.error(error);
         })
  },
  methods:{
      getSlot:function()  {
          this.minMember()
          this.axios.get('api/v1/slot/'+this.game_id, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': '78a8a3178e8ed199b8a5323629a949e7bbdc833b'
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
              }
          }
      },
      getFriend:function(){
           this.axios.get('api/v1/get_users/2', {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': '78a8a3178e8ed199b8a5323629a949e7bbdc833b'
                },
            })
            .then((response) => {
               this.users= response.data.body;
            })
            .catch((error) => {
                console.error(error);
         })
      },
      addMore:function() {
         this.player.push( {
                   id:0,
                   name:'Please Select' 
                });

        console.log(this.player);
      },
      createBooking:function(e){
          
      }
  }
}
</script>
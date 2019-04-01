<template>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="sel1">Select Friends:</label> 
                <select class="form-control" v-model="player">
                            <option value="0">--Please select Player--</option>
                        <option v-for="user in users" v-bind:id="user.id" v-bind:value="user.id">{{user.name}}</option>
                </select>
            </div>
        </div>
        <div class="col-6">
                    <div class="form-group">
                        <button style="margin-top: 30px;" class="btn btn-info btn-sm"> +Add More </button>
                    </div>
        </div>
     </div>   

</template>

<script>
    export default {
        name: 'SelectUser',
  data:function() {
      return {
            
            users:[],
            player:[],
            input_player:[1]
      }
    
  },
  methods:{
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
      }
    }
}
</script>
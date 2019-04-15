<template>
     <select class="form-control" required="true" v-model="game_id" v-on:change="$emit('change',value=$event.target.value)" >
        <option :selected="true" value="0">--Please select Game--</option>
        <option v-for="game in games" v-bind:key="game.id" v-bind:value="game.id">{{game.name}}</option>
    </select>
</template>
<script>
    export default {
        name:"Games",
        
        data:function (){
           return { 
                game_id:0,
                games:[],
           }
        },
        mounted:function(){
            this.axios.get('api/v1/games', {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization-key': this.$auth_key
                },
            })
            .then((response) => {
               this.games = response.data.body;
            })
            .catch((error) => {
                console.error(error);
         })
        }
     
    }
</script>

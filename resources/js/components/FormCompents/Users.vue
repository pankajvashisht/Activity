<template>
     <select class="form-control" required="true" >
        <option :selected="true" value="0">--Please select friend--</option>
        <option v-for="user in friends" v-bind:key="user.id" data-class="avatar" v-bind:value="user.id">
            {{user.name}}  <img :src="user.social_image" >
        </option>
   </select>
</template>

<script>
     export default {
        name:"Users",
        props:['options'],
        data:function (){
           return { 
                friend_id:0,
                friends:[],
           }
        },
        mounted:function(){
            console.log(this.options);
            this.friends =  this.users;
        }
        
    }
</script>
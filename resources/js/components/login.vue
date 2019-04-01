<template>
    <div>
      <button @click="login('github')" class="btn btn-info btn-github">Login with GitHUb</button>
    </div>
</template>

<script>
    
    export default {
        name: 'login',
        methods:{
            login:function(provider){
                this.$auth.authenticate(provider).then( (data) =>  {
                    console.log(data);
                    this.$route.push('/home');
             })
            }
        }, 
        beforeCreate: function(){ 
           
        },
        created: function(){ 
         
        },
        beforeMount: function(){ 
             
        },
        mounted: function(){ 
           
        },
        beforeUpdate: function(){ 
           
        },
        updated: function(){ 
          
        },
        beforeDestroy: function(){ 
            
        }

    }
</script>

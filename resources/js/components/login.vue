<template>
    <div class="card">
        <div class="card-header text-center bg-info text-white">Ucreate Game Slot Booking</div>
         <div style="padding: 12%;padding-left: 44%;">
            <div class="card-body">
                 <a href="/auth/github" class="btn btn-info btn-github"><i class="fa fa-github"></i> Login with Github </a>
            </div> 
        </div>
    </div>
</template>

<script>
    
    export default {
        name: 'login',
        methods:{
            login:function(provider){
                this.$auth.authenticate(provider).then( (data) =>  {
                
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
           if(this.$userId!='null'){
                 this.$router.push({ name: 'mybooking' })
            }
        },
        beforeUpdate: function(){ 
           
        },
        updated: function(){ 
          
        },
        beforeDestroy: function(){ 
            
        }

    }
</script>

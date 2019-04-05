<template>
    <div class="container">
        <div class="card">
            <div class="card-header text-center bg-info text-white">Ucreate Game Slot Booking</div>
            <div style="padding: 12%;padding-left: 44%;">
                <div class="card-body">
                    <div style="margin-right:104px">
                        <a href="/auth/github" style="margin-bottom: 20px;" class="btn btn-info "><i class="fa fa-github"></i> Login with Github </a>
                        <a href="/auth/google" class="btn btn-danger"><i class="fa fa-google"></i> Login with Google </a>
                    </div>
                </div> 
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

<template>
    <div>
         <p> hello world {{name}}</p>
    </div>
</template>

<script>
    
    export default {
        name: 'login',
        data(){
           return {
                 name: 'Welcome to Your Vue.js App'
            }
        },    
       beforeCreate: function(){ 
            alert('Before Create');
        },
        created: function(){ 
         alert('Created');
        },
        beforeMount: function(){ 
             alert('Before Mount');
        },
        mounted: function(){ 
            alert('Mounted');
        },
        beforeUpdate: function(){ 
            alert('Before Update');
        },
        updated: function(){ 
            alert('Updated');
        },
        beforeDestroy: function(){ 
            alert('Before Destroy');
        }

    }
</script>

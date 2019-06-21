<template>
  <div class="callback">Callback</div>
</template>

<script>
export default {
  name: 'callback',
  mounted() {
      console.log(this.getQueryStringValue("code"));
   this.$auth.authenticate('github').then( (data) =>  {
       
      console.log(data);  
      this.$router.push({ name: 'test' })
    })
  },
  method:{
     getQueryStringValue:  function(key) {  
        return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
         }
 
}  

// Would write the value of the QueryString-variable called name to the console  

}
</script>
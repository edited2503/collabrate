<template>
  <!--this navbar is shown whrn the user has been logged out
  and is returned to the login/register pages -->
  
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Collab/Rate</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- template rendered iff authed -->
          
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><router-link :to="{name:'login'}">Login</router-link></li>
          <li><router-link :to="{name:'register'}">Register</router-link></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  
  
  
</template>

<script>
    export default {
      data() {
        return {
          isAuth: this.$auth.isAuthenticated()
        }
      },
      methods:{
        logout(){
          //destroys the loggined in user tokens 
          this.$auth.destroyToken();
          //check wheter the logout was success full
          if (!this.$auth.isAuthenticated()) {
            this.isAuth = this.$auth.isAuthenticated()
          }
          //makes a call to the router object 
          this.$router.push({name:"login"});
        }
      }
    }
</script>

<style>
body { 
    padding-top: 65px; 
}
	
</style>

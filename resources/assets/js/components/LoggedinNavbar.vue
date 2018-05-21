<template>
	
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
          <li><router-link :to="{name:'profile'}">Profile</router-link></li>
          <li><router-link :to="{name:'search-projects'}">Search Projects</router-link></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><button class="btn" v-on:click="logout" > Logout</button></li>
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
          this.$auth.destroyToken();
          if (!this.$auth.isAuthenticated()) {
            this.isAuth = this.$auth.isAuthenticated()
          }

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

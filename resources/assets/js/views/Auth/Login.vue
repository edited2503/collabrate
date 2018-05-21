<template>
  <div>
    <loggedout-navbar></loggedout-navbar>
    <div class="container">
	  	 


  <div class="div-center">


    <div class="content">


      <h3>Login</h3>
      <hr />
      <form>
        <div class="form-group">
          <label for="email" class="label-control">Email</label>
        <input type="text" id="email" name="email" value="" class="form-control" v-model="email">
        </div>
        <div class="form-group">
          <label for="password" class="label-control">Password</label>
        <input type="text" name="password" id="password" value="" class="form-control" v-model="password">
        </div>
        <button type="button" name="button" class="submit" v-on:click="loginUser">Login</button>
        <hr/>
		  
      </form>

    </div>
	</div>
		
      
  </div>
  </div>
</template>
<script>
import {loginUrl,getHeader,userUrl,authenticateUrl} from "../../config";
import LoggedoutNavBar from '../../components/LoggedoutNavbar.vue';
export default{
  components:{
    'loggedout-navbar':LoggedoutNavBar
  },
  data(){
    return {
        email:"",
        password:""
    }
  },
  methods:{
    loginUser(){
      var data={
        client_id:2,
        client_secret:'vVxqtk9fMe3qfaJv8gCYp7z2LlnKfJH2d0xXQOga',
        grant_type:'password',
        username:this.email,
        password:this.password
      }
      //console.log(data);
      //testing how to access the api routes
      axios.post(authenticateUrl,data)
            //es6 syntax
            .then(response=>{
              if (response.status===200) {
                var user={
                  'email':this.email,
                  'password':this.password
                }
                //console.log('user',user);
                axios.post(loginUrl,user)
                     .then(res=>{
                       //console.log(res.data.user_id);
                       this.$auth.setToken(response.data.access_token,response.data.expires_in+Date.now(),res.data.user_id);
                       this.$router.push('/profile');
                     })
              }
            })
           // .then(function (response) {
           //   console.log(response);
           // });
    },

  }
}
</script>
<style>

body{
	
	/*background-image: linear-gradient(-225deg, #FF057C 0%, #8D0B93 50%, #321575 100%);
	background-repeat: no-repeat;
	background-size: cover;
	margin-bottom:40%;*/
}

.loginVue{
color:#fff;
}		  

.div-center {
  width: 400px;
  height: 400px;
  background-color: #fff;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  max-width: 100%;
  max-height: 100%;
  overflow: auto;
  padding: 1em 2em;
  border-bottom: 2px solid #ccc;
  display: table;
  -webkit-box-shadow: 7px 9px 15px 5px rgba(0,0,0,0.11); 
box-shadow: 7px 9px 15px 5px rgba(0,0,0,0.11);
}

div.content {
  display: table-cell;
  vertical-align: middle;
}

.submit{
margin-left:33%;
background-color: #000;
    border: none;
    color: white;
    padding: 15px 32px;
	margin-top:3%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
	
	 transition: all 0.4s ease-in-out;

}

.submit:hover{
margin-left:33%;
background-color: #222;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
	
	 transition: all 0.4s ease-in-out;

}
</style>

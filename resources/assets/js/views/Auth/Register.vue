<template>
  <div>
    <loggedout-navbar></loggedout-navbar>
	  
	  <div class="container">
	  	 


  <div class="div-center">


    <div class="content">


      <h3>Register</h3>
      <hr>
      <form>
		  
		 <div class="form-group">
          <label for="name" class="label-control">Name</label>
          <input type="text" id="name" name="name" value="" class="form-control" v-model="form.name">
        </div>
        <div class="form-group">
         <label for="email" class="label-control">Email</label>
          <input type="text" id="email" name="email" value="" class="form-control" v-model="form.email">
        </div>
        <div class="form-group">
          <label for="password" class="label-control">Password</label>
          <input type="password" name="password" id="password" value="" class="form-control" v-model="form.password">
        </div>
        <button type="button" name="button"  class="submit" v-on:click="registerUser">Register</button>
        <hr/>
		  
      </form>

    </div>
	</div>
		
      
  </div>
  </div>
	  
	  

 
</template>
<script>
import {registerUrl} from '../../config'
import LoggedoutNavBar from '../../components/LoggedoutNavbar.vue';
export default{
  components:{
    'loggedout-navbar':LoggedoutNavBar
  },
  data(){
    return{
      form:{
        name:"",
        email:"",
        password:"",

      },
      error:{},
      isProssessing:false
    }
  },
  methods:{
    registerUser(){
      console.log(registerUrl);
      axios.post(registerUrl,this.form)
          .then(response=>{
            if (response.status===200) {
              this.$router.push('/login');
            }
          })
    }
  },
}

</script>
<style>
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

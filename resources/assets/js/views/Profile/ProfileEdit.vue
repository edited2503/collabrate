<template>

  <section id="reg">
      <loggedin-navbar></loggedin-navbar>
	  
	  	   <div class="section-title">
          <h3 class="text-center">Edit Profile</h3>
        <hr>
        <h2 class="text-center editH2">Personalise Your Profile</h2>
			  
    </div>
	  
	  <div class="container-fluid">
	
		  
    <section class="container">
<div class="panel panel-default">
	<div class="panel-body"> 
		<div class="container-page">				
			<div class="col-md-6 borderForm">
				<h3 class="dark-grey">Personal Details</h3>
				<p>Please enter your personal Details </p>
				<hr>
				
				
				<div class="form-group col-lg-12">
					<label for="profile_img" class="label-control">Change Profile Picture</label>
        <input type="file" id="profile_img" name="profile_img" value="" class="form-control" v-on:change="onFileChanged">
				</div>
				
				<div class="col-sm-6">
					<label for="disable-img">
          Keep Current Profile Picture?
						<input type="checkbox" name="disable-img" id="disable-img" v-model="disableImg"></label>
				</div>
				<div class="form-group col-lg-12">
					<label for="name" class="label-control">Name</label>
        <input type="text" id="name" name="name" value="Name" class="form-control" v-model="user.name">
				</div>
				
				<div class="form-group col-lg-12">
					 <label for="skill" class="label-control">Interests</label>
        <input type="text" name="skill" id="skill" class="form-control" v-model="user.skill">
				</div>
				
				<div class="form-group col-lg-6">
					 <label for="country" class="label-control">Country</label>
        <input type="text" name="country" id="country" value="Country" class="form-control" v-model="user.country">
				</div>
								
				<div class="form-group col-lg-6">
					<label for="city" class="label-control">City</label>
        <input type="text" name="city" id="city" value="City" class="form-control" v-model="user.city">
				</div>
				
				<div class="form-group col-lg-12">
					<label for="profession" class="label-control">Profession</label>
        <input type="text" name="profession" id="profession" value="Profession" class="form-control" v-model="user.profession">
				</div>			
				
				<div class="col-lg-12">
					<label for="biography" class="label-control">Biography</label>
		    <textarea class="form-control" value="Biography" rows="5" placeholder="Biography" v-model="user.biography"></textarea>
				</div>

								
			
			</div>
		
			<div class="col-md-6 socialForm">
				<h3 class="dark-grey">Social Media</h3>
				<p>Please enter your social media links</p>
				<hr>
				<div class="form-group col-lg-12">
					<label>Facebook</label>
					<input type="" name="" class="form-control" id="" value="facebook.com/YourFacebook" v-model="user.fb">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Instagram</label>
					<input type="" name="" class="form-control" id="" value="Instagram.com/YourInstagram" v-model="user.insta">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Twitter</label>
					<input type="" name="" class="form-control" id="" value="twitter.com/YourTwitter" v-model="user.twitter">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Gmail</label>
					<input type="" name="" class="form-control" id="" value="gmail.com/YourGmail" v-model="user.gmail">
				</div>
				
				<div class="form-group col-lg-12">
					<label>LinkedIn</label>
					<input type="" name="" class="form-control" id="" value="linkedin.com/YourLinkedIn" v-model="user.lin">
				</div>
				
				<div class="form-group col-lg-12">
					<label>Behance</label>
					<input type="" name="" class="form-control" id="" value="behance.com/yourBehance" v-model="user.b">
				</div>
				
				<pre>{{user}}</pre>
				<pre>{{user_sent_data}}</pre>
				
				<button type="submit" class="btn btn-block btn-primary " name="button"  v-on:click="editProfile">Update Profile Information</button>	
				
				
				
			</div>
		</div>
			</div>
		</div>
	</section>
</div>

   </section>
</template>
<script>
import LoggedinNavBar from '../../components/LoggedinNavBar.vue';
import {apiDomain} from '../../config';
export default{
  components:{
    'loggedin-navbar':LoggedinNavBar,
  },
  data(){
    return{
      user:{
        user_id:parseInt(this.$auth.getUserId()),
        name:"",
        skill:"",
        country:"",
        city:"",
        profession:"",
        main_interest:"",
        biography:"",
        profile_img:"",
        role_id:"",
		fb:"",
		insta:"",
		twitter:"",
		gmail:"",
		lin:"",
		b:"",
      },
	  user_sent_data:{},
      disableImg:"",
      error:{},
      roles:{},
      isProssessing:false
    }
  },
  created(){
    //console.log(apiDomain+'api/getUserRoles');
    axios.get(apiDomain+'api/getUserRoles')
         .then(response=>{
           this.roles= response.data.roles;
          console.log(this.roles);
         }
       )
       console.log(apiDomain+'api/showProfile/'+this.$auth.getUserId());
       axios.get(apiDomain+'api/showProfile/'+this.$auth.getUserId())
            .then(response=>{
              //this.roles= response.data.roles;
              this.user = response.data[0];

             console.log('Currnent User Info :'+this.user);
            }
          )
  },
  methods:{
    editProfile(){
      var user_id= this.$auth.getUserId();

      if (this.disableImg) {
        //console.log('Image Wont be updated');
        this.user.profile_img = "";
          axios.post(apiDomain+"api/editProfile",this.user)
           .then(response=>{
             console.log(response.data);
             this.user_sent_data = response.data;
             this.$router.push({name:"profile"});
           }).catch(function (error) {
            if (error.response) {
              // The request was made and the server responded with a status code outside of 200
              console.log(error.response.data);
              console.log(error.response.status);
              console.log(error.response.headers);
            } else if (error.request) {
              // The request was made but no response was received
              console.log(error.request);
            } else {
              // Something happened in setting up the request that triggered an Error
              console.log('Error', error.message);
            }
            console.log(error.config);
          });
      }
      
    },
    onFileChanged(event){
      //const files = event.target.files;
      const fileReader = new FileReader();
      fileReader.readAsDataURL(event.target.files[0]);
      fileReader.onload = (event)=>{
        this.user.profile_img = event.target.result
      }
    },
  }
}
</script>
<style>
	h2{margin-bottom: 3%;}
	.socialForm{padding-left: 2%;}
	.borderForm{border-right: .5px solid #222;}

.profile-border{
			  border-right:.5px solid #fff;
		  }

	input{
		-webkit-box-shadow: 10px 10px 30px -10px rgba(0,0,0,0.42);
-moz-box-shadow: 10px 10px 30px -10px rgba(0,0,0,0.42);
box-shadow: 10px 10px 30px -10px rgba(0,0,0,0.42);
	}

#reg .form-control {
  border: 1px solid #f0f0f0;
  box-shadow: none;
  margin-bottom: 10px;
  transition: all 0.4s ease-in-out;
}

#reg .form-control:hover {
  border-color: #777;
}

#reg input,
#reg select {
  height: 50px;
}

#reg .submit {
  background: #222;
  border-radius: 100px;
  border: none;
  color: #ffffff;
  font-weight: 400;
  transition: all 0.4s ease-in-out;
}

#reg .submit:hover {
  background: #000;
}

</style>

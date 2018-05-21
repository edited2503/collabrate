<template>
  <div>
    <!-- <transition name="fade"> -->
    
    
		
					<div class="col-md-6">
				<h3 class="dark-grey">Project Thumbnail</h3>
				<p><small>Please select a project to upload</small></p>
				 <hr>
						<div class="form-group">
         
		
          <input type="file" id="cover_img" name="cover_img" value="" class="form-control fixed-imageUploadSize" v-on:change="onFileChanged">
        </div>
				
				
			</div>
			<div id="project" class="col-md-6 ">
				<h3 class="dark-grey">Project Description</h3>
				<p><small>Please insert project details</small></p>
				<hr>
				
				<div class="form-group col-lg-12">
					<label for="name" class="label-control">Project Title:</label>
          			<input type="text" id="name" name="name" value="" class="form-control" v-model="project.name">
				</div>
				
				<div class="form-group col-lg-12">
					<label for="description" class="label-control"> Project Description:</label>
					<textarea class="form-control" rows="5" placeholder="description" v-model="project.description"></textarea>
				</div>
				
				<div class="form-group col-lg-12">
					  <label> Project categories:</label>
					  <p>Please select a category</p>
					  <div class="radioBtn">

					  <label class="checkbox-inline" v-for="category in categories">	 
						<input type="radio" name="category" v-bind:value="category.id" v-model="project.category_id">
						<p class="radioName">{{category.name}}</p>
						<!-- <p>{{category}}</p> -->
					  </label>
					</div>
				</div>
							
				
			</div>
			
			
			
	
		<div class="form-group col-lg-12">
				<button type="button" name="button" class="submit btn-md" v-on:click="addProject">Add Project</button>
				</div>


  </div>
  
	
	
    <!-- </transition> -->
  </div>
</template>
<script>
import {apiDomain} from '../../config';
export default{

  data(){
    return{
      project:{
        user_id:parseInt(this.$auth.getUserId()),
        name:"",
        description:"",
        cover_img:"",
        category_id:"",
      },
      project_images:[],
      form: new FormData(),
      project_image:null,
      categories:{},
      error:{},
      isProssessing:false
    }
  },
  created(){
    console.log(apiDomain+"api/getProjectCategories");
    axios.get(apiDomain+"api/getProjectCategories")
         .then(response=>{
           this.categories=response.data.categories;
           //this.$router.push({name:"projects_view"});
         }).catch(function (error) {
          if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            console.log(error.response.data);
            console.log(error.response.status);
            console.log(error.response.headers);
          } else if (error.request) {
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            console.log(error.request);
          } else {
            // Something happened in setting up the request that triggered an Error
            console.log('Error', error.message);
          }
          console.log(error.config);
        });
  },
  methods:{
    addProject(){
      var user_id= this.$auth.getUserId();
      axios.post(apiDomain+"api/addProject",this.project)
           .then(response=>{
             console.log(response.data);
             this.$router.push({name:"projects_view"});
           }).catch(function (error) {
            if (error.response) {
              // The request was made and the server responded with a status code
              // that falls out of the range of 2xx
              console.log(error.response.data);
              console.log(error.response.status);
              console.log(error.response.headers);
            } else if (error.request) {
              // The request was made but no response was received
              // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
              // http.ClientRequest in node.js
              console.log(error.request);
            } else {
              // Something happened in setting up the request that triggered an Error
              console.log('Error', error.message);
            }
            console.log(error.config);
          });
      console.log(this.project);
    },
    onFileChanged(event){
      const files = event.target.files;
      const fileReader = new FileReader();

      fileReader.readAsDataURL(event.target.files[0]);
      fileReader.onload = (event)=>{
        this.project.cover_img = event.target.result
      }

      //console.log(this.user);
      // let filename = files[0].filename;
      // //checks where the extenstion is
      // if (filename.lastIndexOf('.')<=0) {
      //     return alert('Please ad valid file')
      // }
      // ///js filereader api
      //
      // console.log(fileReader.readAsDataURL(files[0]));
    },
    onMultiFileChanged(event){
      var selectedImgFiles = event.target.files;

      this.project_images = selectedImgFiles;
      console.log(this.project_images);
      //var multifileReader = new FileReader();


      // for (var i = 0; i < selectedImgFiles.length; i++) {
      //   // console.log(files[i]);
      //
      //
      //   this.project.project_images.push(selectedImgFiles[i]);
      //   //console.log(this.project_image);
      //
      // }
      // console.log(this.project.project_images);
      //console.log(files);
      //
      // fileReader.readAsDataURL(event.target.files[0]);
      // fileReader.onload = (event)=>{
      //   this.project.cover_img = event.target.result
      // }
      //console.log("Multiple Files Seleted",event);

      //console.log(this.user);
      // let filename = files[0].filename;
      // //checks where the extenstion is
      // if (filename.lastIndexOf('.')<=0) {
      //     return alert('Please ad valid file')
      // }
      // ///js filereader api
      //
      // console.log(fileReader.readAsDataURL(files[0]));
    },
    // uploadProject(){
    //   this.form.append('normal-data'.this.project)
    //   this.form.append('project_images',this.project_images);
    //   var config = {headers:{'Content-Type':'multipart/formdata'}}
    //   var user_id= this.$auth.getUserId();
    //   axios.post(apiDomain+"api/addProject",this.form,config)
    //        .then(response=>{
    //          console.log(response.data);
    //          // this.$router.push({name:"projects_view"});
    //        }).catch(function (error) {
    //         if (error.response) {
    //           // The request was made and the server responded with a status code
    //           // that falls out of the range of 2xx
    //           console.log(error.response.data);
    //           console.log(error.response.status);
    //           console.log(error.response.headers);
    //         } else if (error.request) {
    //           // The request was made but no response was received
    //           // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
    //           // http.ClientRequest in node.js
    //           console.log(error.request);
    //         } else {
    //           // Something happened in setting up the request that triggered an Error
    //           console.log('Error', error.message);
    //         }
    //         console.log(error.config);
    //       });
    //   console.log(this.project);
    //
    // }
  }
}
</script>
<style>
.submit{
margin-left:40%;
background-color: #000;
    border: none;
    color: white;
    padding: 15px 32px;
	margin-top:3%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
	 border-radius: 100px;
	 transition: all 0.4s ease-in-out;

}

.submit:hover{
margin-left:40%;
background-color: #222;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
	 border-radius: 100px;
	 transition: all 0.4s ease-in-out;

}


input[type="file"] {

  

}

#cover_image {
	 position:absolute;
    top:0px;
    left:0;
    background: transparent;
    border: none !important;
    width:170px;
    color:black;

}
  .createPro-submit{
			  margin-top:5%;
		  }
		  
		  .fixed-imageUploadSize{
			  min-width: 460px;
			  min-height: 380px;
		  }

#project .form-control {
  border: 1px solid #f0f0f0;
  box-shadow: none;
  margin-bottom: 10px;
  transition: all 0.4s ease-in-out;
}

#project .form-control:hover {
  border-color: #777;
}

#project input,
#project select {
  height: 50px;
}



.radio-inline, .checkbox-inline {
    position: relative;
    display: inline-block;
    padding-left: 10%;
    margin-bottom: 0;
    vertical-align: middle;
    font-weight: normal;
    cursor: pointer;
	}

input[type="radio"] {
  position: relative;
  display: inline-block;
  min-height: 90px;
  margin-left:10%;
  width: 30%;
  
  -webkit-appearance: none;
  -moz-appearance: none;
  -o-appearance: none;
  appearance: none;
}

input[type="radio"]:before {
  position: absolute;
  margin: auto auto;
  left: 5px;
  right: 0;
  bottom: 0;
  top: 0;
  content: "";
  display: block;
  height: 80px;
  width: 80px;
  border: 2px solid #fff;
  border-radius: 50%;
  -webkit-transition: all 0.1s ease-in;
  -moz-transition: all 0.1s ease-in;
  -ms-transition: all 0.1s ease-in;
  -o-transition: all 0.1s ease-in;
  transition: all 0.1s ease-in;
}

input[type="radio"]:after {
  content: "";
  font-size: 2em;
  text-align: center;
  line-height: 70px;
  color: #555555;
  position: absolute;
  margin: auto auto;
  left: 15px;
  right: 0;
  bottom: 0;
  top: 0;
  display: block;
  height: 60px;
  width: 60px;
  border-radius: 50%;
  -moz-box-shadow:    3px 3px 5px 6px #ccc;
  -webkit-box-shadow: 3px 3px 5px 6px #ccc;
  box-shadow:         3px 3px 5px 6px #ccc;
  background-position: center;
  background:#fff;
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -ms-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}

input[type="radio"]:hover:before {
  height: 60px;
  width: 60px;
}

input[type="radio"]:checked:before {

   background: -webkit-linear-gradient(left top, #753a88, #cc2b5e); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(bottom right, #753a88, #cc2b5e); 
  background: -moz-linear-gradient(bottom right, #753a88, #cc2b5e); /* For Firefox 3.6 to 15 */
  background: linear-gradient(to bottom right, #753a88, #cc2b5e); 
  border: none;
  border-radius: 0;
  border-radius:50%;
}

input[type="radio"]:focus {
  outline: none;
}

.radioName{

	margin-left:43%;
}
</style>

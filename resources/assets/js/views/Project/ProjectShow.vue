<template lang="html">
  <div>
<transition appear>
  <div id="project-view">

  
  
  
  <div class="col-md-8 col-lg-8">
  		
		<div class="panel panel-default">

  <div class="panel-body">  
      
  <img v-bind:src='path + "/storage/img/cover_img/" + project.cover_img' class=" showProjectImg" alt="">
  <hr>
  <h2><small>Project Rating :</small></h2>
	  <hr>
	  <project-rating v-bind:project="project" v-on:updateProjectRating="updateProjectRating" class="pull-center"></project-rating>

 
   
		   
  </div>
  
</div>

	 
	  
  
 
	  
	  <h2 class="text-center"><small class="titles">Comments</small></h2>
	  <hr>
	   <project-comment-composer v-bind:projectId="project.id" v-on:commentAdded="updateCommentLog"></project-comment-composer> 
	  <hr>
	  <project-comment-log v-bind:project_comments="project_comments"></project-comment-log>
	  
			
	</div>
	<div class="col-md-4 col-lg-4 scroll">
	<div class="panel panel-default">
	<div class="panel-body"> 
	
	<h2><small class="titles">Project Name: </small></h2>
	<h2>{{project.name}}</h2>
	
	<hr>
	<h2><small>Project description :</small></h2>
	
	<hr>
    <p class="description"> {{project.description}}</p>
	
	</div>
	
	</div>
	</div>
     
  </div>
</transition>
</div>
</template>

<script>
import {apiDomain} from '../../config';
import ProjectCommentLog from './Comments/ProjectCommentLog.vue';
import ProjectCommentComposer from './Comments/ProjectCommentComposer.vue';
import ProjectRating from './ProjectRating.vue';
export default {
  components:{
    'project-comment-log':ProjectCommentLog,
    'project-comment-composer':ProjectCommentComposer,
    'project-rating':ProjectRating
  },
  data(){
    return{
      project:{
        project_id:"",
        name:"",
        description:"",
        cover_img:"",
        user_id:"",
        noOfRating:"",
      },
      project_comments:[],
      path:apiDomain
    }
  },
  created(){
    //console.log(apiDomain+"api/getUserProject/"+this.project.project_id);
    axios.get(apiDomain+"api/getUserProject/"+this.$route.params.id)
        .then(response=>{
          this.project=response.data[0];
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
      axios.get(apiDomain+"api/getNoProjectRating/"+this.$route.params.id)
          .then(response=>{
              this.project.noOfRating = response.data.count;
              console.log('This is the Project Rating In the created function');
              
              console.log(this.project.noOfRating);
            }
          ).catch(function (error) {
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
      axios.get(apiDomain+"api/getProjectCommentsByPid/"+this.$route.params.id)
        .then(response=>{
          this.project_comments=response.data.project_comments;
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
      updateProjectRating(){
        axios.get(apiDomain+"api/getNoProjectRating/"+this.$route.params.id)
          .then(response=>{
              this.project.noOfRating = response.data.count;
              console.log('This is the Update Project Rating Function');
              
              console.log(this.project.noOfRating);
            }
          ).catch(function (error) {
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
      updateCommentLog(){
        axios.get(apiDomain+"api/getProjectCommentsByPid/"+this.$route.params.id)
             .then(response=>{
              //console.log(response.data[0]);
              this.project_comments=response.data.project_comments;
              //this.$router.push({name:"projects_view"});
              console.log(this.project_comments);
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

      }
    }
  }
</script>

<style lang="css">
	.scroll{
		
		
	}

hr {
	margin-top:15px;

}

.chatlog{
background:#fff;
}

h2 .titles{
margin-bottom:10%;

}

.description{
	line-height:30px;
	font-size:14px;

}

.rateBtn{
	margin-left:40%;
	border-radius: 50%;
	background:#663399;
	height: 100px;
	width: 100px;
	color:#fff;
}

.rBtnText{
    margin-top: 30px;
	

}

.rateBtn:hover{
	
	background:#BF55EC;
	
	color:#fff;
}

.showProjectImg 
{
	width:100%;
	min-height:300px;

}


.projectBackground
{
	background:white;
}

.col-md-10 img 
{
	
	width:100%;
	height:100%;
}
.showProjectImg{

min-height:600px;


}
</style>

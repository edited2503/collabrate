<template lang="html">
  <div class="comment-box">
	   	<div class="panel panel-default">
	<div class="panel-body"> 
		<p> {{project_comment.comment}} </p>
		
		<hr>
		<div class="comment-info">
            <span class="comment-author pull-left">
                    <small> Comment By : {{user.name}}</small>
                </span>
				 <span class="comment-date pull-right"><small>Date Posted : {{ project_comment.created_at }} </small></span>
				
           
        </div>
    </div>
	  
  </div>
	  
	  
    <!-- <pre>{{project_comment}}</pre> -->
  
  </div>
	
</template>

<script>
import {apiDomain} from '../../../config';
// import ProjectAction from './ProjectCommentActions.vue';

export default {
  props:['project_comment'],
  components:{
    //'project-action':ProjectAction
  },
  data(){
    return{
        user:[]
    }
  },
  mounted(){
    //console.log(apiDomain+"api/showProfile/"+this.project_comment.user_id);
    axios.get(apiDomain+"api/showProfile/"+this.project_comment.user_id)
    .then(response=>{
        this.user = response.data[0];
        //console.log(response.data);
        console.log(this.user);
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
  methods:{

  }
}
</script>

<style lang="css">


</style>

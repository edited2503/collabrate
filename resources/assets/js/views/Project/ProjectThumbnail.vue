<template lang>
  <transition name="fade">
 
 <div id="projects">
  <div class="col-lg-5 col-md-5 col-sm-3">
  		
		
    <div class="project-thumb">
	
	<router-link class="project-view" :to="{name:'project_show',params:{id:project.id}}">
    <img  v-bind:src='path + "/storage/img/cover_img/"+project.cover_img' class="img-responsive projectFixedScale" alt="">
   
	<div class="project-overlay">
		<img class="settingsIcon" v-bind:src="path + '/storage/img/icons/s1.png'">
      <div class="project-item">
        <h3>{{project.name}}</h3>
        <small>{{project.description}}</small>
      </div>
  </div>
				 
				 </router-link>
				<div class="task-editor">
					<img  class=" settingsIconHover" v-bind:src="path + '/storage/img/icons/s.png'">
					
					<p>settings</p>
					<hr>
				<ul>
				
					
				<!-- edit link-->
  				<li><router-link :to="{name:'project_edit',params:{id:project.id}}" ><img  v-bind:src="path + '/storage/img/icons/e1.png'">edit</router-link></li>
   				<!-- delete link-->
    			<li><button v-on:click="requestDelete(project)">
					<img  v-bind:src="path + '/storage/img/icons/d1.png'">Delete Project</button></li>
				</ul>
				</div>
				
				
				</div>
					
        </div>
  </div>
 
   
 
</transition>
</template>

<script>
import {apiDomain} from '../../config';
export default {
    props:['project'],
    data(){
      return{
        path:apiDomain
      }
    },
    created(){
      console.log(this.path+ "storage/img/icons/n1.png");
    },
    methods:{
      requestDelete:function(project){
        //console.log("Project witht the project id :"+project_id);
        //console.log(project.id);
        var deleteProjectUrl = apiDomain+"api/deleteProject/"+project.id;
        //console.log(deleteProjectUrl );
        axios.delete(deleteProjectUrl)
             .then(
               (response)=>{
                   //console.log(response.status);
                   if (response.status == 200) {
                    this.$emit('requestDelete',project);
                   }
                 }
             )
      }
    }
}
</script>

<style lang="css">
#projects>row{
    
margin-right: 5%;    
}

	.settingsIcon {
		position: relative;
		top:30px;
		left: 61%;
	}	
	
	.settingsIconHover{
		position: relative;
		top:30px;
		left: 48%;
	}
	
.task-editor
{
	position: absolute;
	top: 0;
	
  	right: 0;
  	bottom: 0;
	background:white;
	height:100%;
	
	opacity:0;
}

.task-editor:hover{
transition: all 0.4s ease-in-out;

opacity:1;
}



.task-editor ul 
{
	
	list-style-type: none;
	
}

.task-editor li:first-child{
margin-top:100px;

} 

.task-editor ul button{

	margin-top: 30%;
    width: 79px;
}

#projects small {
  color: #f0f0f0;
  font-size: 10px;
  letter-spacing: 1px;
  text-transform: uppercase;
}

#projects .project-thumb {
  position: relative;
  padding: 0;
  margin-top: 32px;
}


 .project-overlay {
  position: absolute;
  background: #222;
  background: -webkit-linear-gradient(left top, #753a88, #cc2b5e); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(bottom right, #753a88, #cc2b5e); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(bottom right, #753a88, #cc2b5e); /* For Firefox 3.6 to 15 */
  background: linear-gradient(to bottom right, #753a88, #cc2b5e); /* Standard syntax */    
  color: #ffffff;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 83%;
  height: 100%;
  text-align: center;
  vertical-align: top;
  opacity: 0;
  transition: all 0.4s ease-in-out;


}


.projectFixedScale
{
	min-width:380px;
	min-height:400px;

}

.project-view
{
	color:#663399;

}

.project-view:hover
{
	color:#fff;
	background: -webkit-linear-gradient(left top, #753a88, #cc2b5e); /* For Safari 5.1 to 6.0 */
	background: -o-linear-gradient(bottom right, #753a88, #cc2b5e); /* For Opera 11.1 to 12.0 */
	background: -moz-linear-gradient(bottom right, #753a88, #cc2b5e); /* For Firefox 3.6 to 15 */
	background: linear-gradient(to bottom right, #753a88, #cc2b5e); /* Standard syntax */ 
	 transition: all 0.4s ease-in-out;
	
}

#projects .project-item {
    position: absolute;
    top:50%;
    left: 50%;
    -webkit-transform:translate(-50%,-50%);
      -ms-transform:translate(-50%,-50%);
          transform:translate(-50%,-50%);
}

#projects .project-thumb:hover .project-overlay {
  opacity: 0.9;
}

#projects .text-center {
  padding-top: 62px;
}


</style>

<template>
  <div class="col-md-4 col-sm-3">
    
    <router-link :to="{name:'project_show',params:{id:project.id}}">
	<img v-bind:src='path + "storage/img/cover_img/"+project.cover_img' class="img-responsive" alt="">
    <small><h1 class="proName">Project Title : {{project.name}}</h1></small>
    </router-link>
  </div>
</template>

<script>
import {apiDomain} from '../../config';
export default {
    props:['project'],
    data(){
      return{
        path:apiDomain,
        //project:[]
      }
    },
    created(){
      // this.project = 
    },
    methods:{
      
    }
}
</script>

<style lang="css">
.proName{
font-family: 'Roboto', sans-serif;
			  color: #222;
			  font-weight: 600;
			  font-size: 1.5rem!important;
    			line-height: 1rem!important;
			   letter-spacing: .3rem;
			   }

</style>

<template lang="html">
  <div id="project-comment-actions">
    <ul class="list">
      <!-- <li>
        Number of Votes:{{noOfRating}}
      </li> -->
      <li v-if="canRate">
        <button class="btn btn-primary" v-on:click="addProjectRating" >Like</button>
      </li>
      <li v-else><button class="btn btn-danger" v-on:click="removeProjectRating">Unlike</button></li>
    </ul>
    <!-- {{project.id}} -->
    <!-- <pre>{{project}}</pre> -->
    
  </div>
</template>

<script>
import {apiDomain} from '../../config'

export default {
  props:['project'],
  data(){
    return {
      rating:{
        project_id:this.$route.params.id,
        user_id:this.$auth.getUserId()
      },
      ratingConditions:{
        project_id:this.$route.params.id,
        user_id:this.$auth.getUserId()
      },
      noOfRating:"",
      canRate:true
    }
  },
  mounted(){
    
    // console.log(apiDomain +"api/checkRatingEligibility/"+this.$auth.getUserId());
    // console.log(apiDomain +"api/checkRatingEligibility/"+this.rating.project_id+'/'+this.$auth.getUserId());
    
    

  },
  created(){
    console.log(apiDomain +"api/checkRatingEligibility/"+this.ratingConditions.project_id+'/'+this.ratingConditions.user_id);
    
    axios.get(apiDomain +"api/checkRatingEligibility/"+this.ratingConditions.project_id+'/'+this.ratingConditions.user_id)
         .then(response=>{
          //  console.log(response);
           console.log('Can Rate a Project ',response.data.canRate);
           if (response.data.canRate == false) {
             this.canRate = false;
           }else{
             this.canRate = true;
           }
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
          console.log(error.request);
        } else {
          // Something happened in setting up the request that triggered an Error
          console.log('Error', error.message);
        }
        console.log(error.config);
      });
  },
  methods:{
    addProjectRating(){
      axios.post(apiDomain+"api/addProjectRating",this.rating)
      .then(response=>{
        console.log(apiDomain+"api/getNoProjectRating/"+this.project.project_id);
          this.noOfRating= response.data.count;
          this.canRate = false;
          // console.log(response.data.count);
          this.$emit('updateProjectRating');
        }
      ).catch(function (error) {
       if (error.response) {
         // The request was made and the server responded with a status code outside 200
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

    },
    removeProjectRating(){
      axios.delete(apiDomain +"api/removeProjectRating/"+this.ratingConditions.project_id+'/'+this.ratingConditions.user_id)
         .then(response=>{
            console.log(response);
          // //  console.log(response);
          //  console.log('Can Rate a Project ',response.data.canRate);
            if (response.data.canRate == false) {
              this.canRate = false;
            }else{
              this.canRate = true;
              //getNoOfProjectRating();
            }
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
          console.log(error.request);
        } else {
          // Something happened in setting up the request that triggered an Error
          console.log('Error', error.message);
        }
        console.log(error.config);
      });
    },
    getNoOfProjectRating(){
    
      axios.get(apiDomain+"api/getNoProjectRating/"+this.project.project_id)
      .then(response=>{
        this.noOfRating = response.data.count;
      }
      ).catch(function (error) {
       if (error.response) {
         // The request was made and the server responded with a status code outside 200
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
  }
}
</script>

<style lang="css">
</style>

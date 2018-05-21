<template lang="html">
  <div id="project-comment-actions">
    <ul class="list">
          <li>Votes: {{comment.votes}}
              <a  class="like" v-if="!comment.votedByUser" v-on:click="voteComment(comment.commentid,'directcomment',index,0,'up')">Up Votes</a>
              <a class="dislike" v-if="!comment.votedByUser" v-on:click="voteComment(comment.commentid,'directcomment',index,0,'down')">Down Votes</a>
          </li>
          <li>
              <a v-on:click="spamComment(comment.commentId,'directcomment',index,0)">Spam</a>
          </li>
          <li>
              <a v-on:click="openComment(index)">Reply</a>
          </li>
      </ul>
  </div>
</template>

<script>
export default {
  data(){
    return {
      rating:{
        
      }
    }
  },
  methods:{
    downvote
  }
}
</script>

<style lang="css">
	ul{
		list-style-type: none;
		
	}
	
	li {
		list-style-type: none;
	}
</style>

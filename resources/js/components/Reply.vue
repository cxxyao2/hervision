<template>
    <div  :id="'reply-'+id"    class="panel panel-default my-1">
      <div class="panel-heading">
        <div class="level">
          <h5 class="flex">
            <a :href="'/profiles/'+ data.owner.name" v-text="data.owner.name">
            </a> said: {{ data.created_at }}...
          </h5>
          <div v-if="signedIn">
           <favorite :reply="data" ></favorite>
          </div>

        </div>
      </div>



      <div class="panel-body">
             <div v-if="editing">
               <div class="form-group">
                   <textarea class="form-control" v-model="body"></textarea>
                   <button class="btn btn-primary btn-xs " @click="update">update</button>
                   <button class="btn btn-secondary btn-xs" @click="editing = false">cancel</button>
               </div>
             </div>

            <div v-else v-text="data.body"> </div>

         </div>



      <div class="panel-footer " v-if="canEditReply">
          <div class="level">
            <div  v-if="canUpdate">
                <button class="btn btn-xs btn-primary " @click="editing = true">Edit</button>
                <button class="btn btn-xs btn-danger " @click="destroy">Delete</button>
            </div>

            <div v-else>
              <div class="form-group mx-0 my-0 p-0">
               <button class="btn btn-primary btn-xs " @click="refOldReply">回复</button>
               <a href="#newReplyBody" class="btn btn-primary btn-xs">新评</a>
              </div>
           </div>

          </div>
       </div>

  </div>


</template>


<script>
  import Favorite from './Favorite.vue';

  export default{

    props: ['data','canEditReply'],

    components: {Favorite} ,

    data(){
      return{
        editing: false,
        id:this.data.id,
        body: this.data.body,
        replyDisplay: false,
        commentToReply:''
      }
    },

    computed:{
      signedIn(){
        return window.App.signedIn;
      },

      canUpdate(){

        return this.authorize(user => this.data.user_id == user.id);

      }
    },

    methods:{


    update(){
           axios.patch('/replies/' + this.data.id,{
             body: this.body
           })
           .catch(error => {
             flash(error.response.data,'danger');
           });

           this.data.body = this.body;
           this.editing = false;
           flash('updated!','success');

         },



      destroy(){
        axios.delete('/replies/'+this.data.id);
        this.$emit('deleted',this.data.id);
        flash('deleted a  reply!','success');
      },

      refOldReply(){
        $('#newReplyBody').val('@'+(this.data.owner.name+' '));
        $('#newReplyBody').focus();

      },



    }


  }
</script>

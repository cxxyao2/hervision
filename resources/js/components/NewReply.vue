        <template>
  <div>
    <div v-if="signedIn">
              <div class="form-group">
                <textarea name="newReplyBody"
                id="newReplyBody"
                class="form-control"
                placeholder="Have something to say? "
                rows="5"
                required
                v-model="body"></textarea>
              </div>

              <button type="submit"
              class="btn  btn-primary btn-xs mb-4"
              @click="addReply">comment</button>
            </div>

   <p class="text-center" v-else>please <a href="/login"> 登录</a></p>

  </div>
</template>


<script>
  export default{


    data(){
      return {
        body: ''

      };
    },

    computed:{
      signedIn(){
        return window.App.signedIn;
      }
    },

    methods:{
      addReply(){
        axios.post(location.pathname+'/replies',{ body: this.body })
          .catch(error => {
            flash(error.response.data,'danger');
          })
          .then(({data}) => {
            this.body = '';
            flash('Your reply has been posted');
            this.$emit('created',data);
          });
      }
    }

  }

</script>

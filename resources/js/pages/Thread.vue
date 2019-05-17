<script>
  import Replies from '../components/Replies.vue';
  import SubscribeButton from '../components/SubscribeButton.vue';
  import Reply from '../components/Reply.vue';

  export default{

    props: ['thread'],

    components: {Replies,SubscribeButton},

    data(){
      return {
        repliesCount: this.thread.replies_count,
        editing: false,
        title:this.thread.title,
        body:this.thread.body,
        form: {
          channel:this.thread.channel,
          title: this.thread.title,
          body: this.thread.body
        }
      }
    },

    methods:{
      update(){

          axios.patch('/threads/' + this.thread.channel.slug + '/'+this.thread.id,{
            body: this.form.body,
            title: this.form.title
            }).catch(error => {
              flash(error.response.data,'danger');
            })
            .then(({data}) => {
           this.editing = false;
           this.title = this.form.title;
           this.body = this.form.body;
           flash('Your thread has been updated.');
        });

      }

    }

  }
</script>

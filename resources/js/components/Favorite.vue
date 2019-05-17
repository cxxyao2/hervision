<template>
  <button   type="submit" :class="classes" @click="toggle">
    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
    <span v-text="count"></span>
  </button>
</template>


<script>
  export default{
    props: ['reply'],

    data(){
      return {
        count: this.reply.favoritesCount,
        active: this.reply.isFavorited
      }
    },

    computed:{
      classes(){
        return ['btn-sm ',this.active?'btn-primary' : 'btn-default'];
      },

      endpoint(){
        return '/replies/'+ this.reply.id + '/favorites';
      }
    },

    methods:{
      toggle(){
        return this.active ? this.destroy() : this.create() ;
      },

      create(){
        axios.post(this.endpoint);
        this.active = true;
        this.count++;
      },

      destroy(){
        axios.delete(this.endpoint); //create the endpoint
        this.active = false;
        this.count--;
      }


    }
  }
</script>

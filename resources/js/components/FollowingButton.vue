<template>
    <button   class="btn btn-default"  style="width:90%;align:center;" @click="following" >
      <span :class="classes" v-text="followDesc"></span>
    </button>
</template>

<script>
  export default{

       props: ['active','followed'],

      computed:{
        classes(){
          return ['glyphicon',this.active?'glyphicon-ok':'glyphicon-plus'];
        },

        followDesc(){
          return this.active?'followed':'follow';
        }
      },

      methods: {
        following(){

          axios[
          (this.active ? 'delete':'post')
          ]('/follows/' + this.followed);
          this.active = ! this.active;

          }
        }
      }

</script>

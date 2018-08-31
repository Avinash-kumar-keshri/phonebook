<template>
    <div>
        <nav class="panel">
            <p class="panel-heading">
                Vuejs Phonebook
                <button class="button is-primary  is-pulled-right" @click="openAdd">
                    Add New
                </button>
            </p>

            <div class="panel-block">
                <p class="control has-icons-left">
                    <input class="input is-small" type="text" placeholder="search">
                    <span class="icon is-small is-left">
          <i class="fas fa-search" aria-hidden="true"></i>
                </span>
                </p>
            </div>

            <a class="panel-block" v-for="(item,key) in lists">
            <span class="column is-9">
              {{item.name}}
            </span>

                <span class="panel-icon column is-1">
              <i class="has-text-danger fa fa-trash" aria-hidden="true" @click="del(key,item.id)"></i>
            </span>

                <span class="panel-icon column is-1">
              <i class="has-text-info fa fa-edit" aria-hidden="true" @click="openUpdate(key)"></i>
            </span>

                <span class="panel-icon column is-1">
              <i class="has-text-primary fa fa-eye" aria-hidden="true" @click="openShow(key)"></i>
            </span>
            </a>

        </nav>

        <Add v-bind:openModel="addActive" @closeRequest="close"></Add>

        <Show v-bind:openModel="showActive" @closeRequest="close"></Show>

        <Update v-bind:openModel="updateActive" @closeRequest="close"></Update>
    </div>

</template>

<script>
  let Add =require('./Add.vue');
  let Show =require('./Show.vue');
  let Update =require('./Update.vue');

    export default {
      data(){
        return{
          addActive:'',
          showActive:'',
          updateActive:'',
          lists:{},
          errors:{}
        }
      },
      mounted(){
        axios.post('/getData').then((response) =>this.lists=response.data)
        .catch((error) =>this.errors=error.response.data.errors )
      },
      components:{Add,Show,Update},
      methods:{
       openAdd:function(){
          this.addActive ='is-active'
  },
        openShow:function(key){
         this.$children[1].list=this.lists[key];
          this.showActive ='is-active'
        },
        openUpdate:function(key){
          this.$children[2].list=this.lists[key];
          this.updateActive ='is-active'
        },
        close(){
         this.addActive='',
           this.showActive='',
           this.updateActive=''
        },
        del:function(key,id){
          /*console.log(`${key},${id}`)*/
          if(confirm('Are you sure ?')){
            axios.delete(`/phonebook/${id}`).then((response) =>console.log('deleted'))
            .catch((error) =>this.errors=error.response.data.errors )
          }
        },
      }
    }
</script>
<style>
label{font-size: 12px; display: inherit;}
  .modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(133, 226, 100, 0.427);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal {
    background: #eeeeee;
    width: 50%;
    height: 70%;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
    top: 85px;
    left: 275px;
  }
  
  .modal-header{
    padding: 15px;
    display: flex;
  }
  
  .modal-header {
    border-bottom: 1px solid #eeeeee;
    font-size: 30px;
    color: #4AAE9B;
    justify-content: center;
  }
  .modal-body {
    position: relative;
    font-size: 30px;
    align-self: center;
    padding: 20px 10px;
  }
  .close {
    border: none;
    font-size: 30px;
    margin-left: 100px;
    cursor: pointer;
    font-weight: bold;
    color: #4AAE9B;
    background: transparent;
  }
</style>
<template>
  <transition name="modal-fade">
    <div class="modal-backdrop">
      <div class="modal" role="dialog">
        <header class="modal-header">
          <slot name="header">
            <button type="button" class="close" @click="$emit('close')">X</button>
          </slot>
        </header>
        <section class="modal-body">
          <slot name="body">
            <div class="card-body">
                <h2>Edit</h2>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter Title" v-model="post_data.title" >
                </div>
                <div class="form-group">
                    <label for="number">Description</label>
                    <textarea id="body"  placeholder="Enter Description" v-model="post_data.body" ></textarea>
                </div>
                <button class="btn btn-primary btn-save" type="button" @click="updatepost(post_data)" >Update</button>
            </div>
          </slot>
        </section>
      </div>
    </div>
  </transition>
</template>

<!--Modal.vue-->
  
<script>
  export default {
    name: 'Edit Post',
    props:['post_data'],
    data(){
        return{
            Title: "Edit Post",
            list: [],
            item: {
                title: "",
                body: ""
            },
            isModalVisible : false
        }
    },
    mounted(){
      console.log('Edit post');
    },
    methods: {
      updatepost(post_data){
          axios.put('api/posts/'+post_data.id,this.post_data)
          .then( res => { 
            this.item = {
                            title: "",
                            body: ""
                        }
            this.$emit('close', false);
            this.$emit('data', '');
          } );
      }
    }
  };
</script>
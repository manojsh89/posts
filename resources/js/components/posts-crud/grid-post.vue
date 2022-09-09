
<template>
  <!-- <div id="appaa">
    <button type="button" class="btn btn-success" @click="showAddModal">
      Add Post
    </button>
  
    <modal_add 
            v-show="isAddModalVisible" 
            @data="fetchall1" 
            @close="closeAddModal" />
  </div> -->
  <table class="table table-hover" v-if="list.length > 0">
      <thead class="thead-dark">
          <tr>
              <th>#</th>
              <th>Name</th>
              <th width="280px">Body</th>
              <th width="280px">Action</th>
          </tr>
      </thead>
      <tbody>
              <tr v-for="post in list" :key="post.id">
                  <td>{{post.id}}</td>
                  <td>{{post.title}}</td>
                  <td>{{post.body}}</td>
                  <td>
                      <a v-if="can('post-edit')" class="btn btn-success" v-on:click="isHidden = !isHidden" @click="showEditModal(post)">Edit</a>
                      <a v-if="can('post-delete')" class="btn btn-primary" @click="deletePost(post.id)" @reload="item">Delete</a>
                  </td>
              </tr>
      </tbody>
  </table>
  <div v-else="list.length == 0">Sorry there are no posts. Please add from "Add New" button above.</div>

  <modal_edit 
      :post_data="item"
      v-show="isModalVisible"
      @data="fetchall1"
      @close="closeEditModal"
    />
</template>

  
<script>
  import modal_add from './ModalAdd.vue';
  import modal_edit from './ModalEdit.vue';

  export default {
    name: 'Posts Listing',
    // emits: ["datax"],
    //props:['list'],
    components: {modal_edit,modal_add},
    data() {
      return{
        Title: 'All Posts',
        list: [],
        item:{
          id: '',
          title: '',
          body: ''
        },
        isModalVisible : false,
        isAddModalVisible : false
      }
    },
    mounted(){
        this.fetchall1();
    },
    methods:{
      fetchall1(){
          try{
              axios.get('/api/posts')
              .then(res=> {this.list = res.data;
                  console.log('abc====');
              });
              // .then(res=> this.afteradd = res.data);
          }catch(e){
              console.log(e);
          }
          
      },
      showAddModal() {
          this.isAddModalVisible = true;
      },
      closeAddModal() {
          this.isAddModalVisible = false;
      },
      showEditModal(post_data) {
        this.item = {
            id: post_data.id,
            title: post_data.title,
            body: post_data.body
        }
        this.isModalVisible = true;
      },
      closeEditModal() {
        this.isModalVisible = false;
      },
      deletePost(id){
        try{
          axios.delete('api/posts/'+id)
            .then( res => this.fetchall1());
        }catch(e){
          console.log(e);
        }
        
      },
      can(permissionName) {
          return Permissions.indexOf(permissionName) !== -1;
      }
    }
  };
</script>
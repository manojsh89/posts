<template>
    <div id="appaa">
    <button
      type="button"
      class="btn btn-success"
      @click="showAddModal"
    >
      Add Post
    </button>
  
    <modal
      v-show="isModalVisible"
      @close="closeAddModal"
    />
  </div>
    <div class="card-body">
        <div class="card-header">Posts
            <span class="float-right">
                <a v-if="can('post-create')" class="btn btn-primary" v-on:click="isHidden = !isHidden">New post</a>
            </span>
        </div>
        <table class="table table-hover" v-if="postlist.length > 0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th width="280px">Body</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                    <tr v-for="post in postlist" :key="post.id">
                        <td>{{post.id}}</td>
                        <td>{{post.title}}</td>
                        <td>{{post.body}}</td>
                        <td>
                            <a v-if="can('post-edit')" class="btn btn-success" v-on:click="isHidden = !isHidden" @click="editPost(post)">Edit</a>
                            <a v-if="can('post-delete')" class="btn btn-primary" @click="deletePost(post.id)">Delete</a>
                        </td>
                    </tr>
            </tbody>
        </table>
        <grid-post posts = 'this.postlist' />
        <div v-if="isHidden">
            <h2>Edit</h2>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="title" placeholder="Enter Title" v-model="item.title">
            </div>
            <div class="form-group">
                <label for="number">Phone Number</label>
                <textarea id="body"  placeholder="Enter Description" v-model="item.body"></textarea>
            </div>
            <button class="btn btn-primary btn-save" type="button" @click="savePost" >
                {{ isEditMode ? 'Update' : 'Save' }}
            </button>
        </div>
    </div>

</template>

<script>
    import modal from '../components/Modal.vue';
    import gridPost from '../components/grid-post.vue';
    export default {
        name: "Post create edit template",
        components: {modal,gridPost },
        data() {
            return {
                Title: "Post",
                postlist: [],
                permissionList: [],
                item: {
                    title: '',
                    body: ''
                },
                isHidden: false,
                temp_id: null, 
                isEditMode: false,
                isModalVisible : false
            }
        },
        mounted(){
            this.fetchall();
        },
        methods: {
            showAddModal() {
                this.isModalVisible = true;
              },
            closeAddModal() {
            this.isModalVisible = false;
            },
            fetchall(){
                try{
                    axios.get('/api/posts')
                    .then(res=> this.postlist = res.data);
                }catch(e){
                    console.log(e);
                }
                
            },
            savePost(){
                try{
                    let method;
                    let url;
                    if(this.isEditMode){
                         method = axios.put;
                         url = 'api/posts/'+this.temp_id;    
                        
                    }else{
                         method = axios.post;
                         url = 'api/posts';
                    }
                    method(url, this.item).then(res=>{
                      this.fetchall();
                        this.item = {
                            title: "",
                            body: ""
                        }
                        this.temp_id = null;
                        this.isEditMode = false;
                    });
                }catch(e){
                    console.log(e);
                }
            },
            editPost(post){
                this.item = {
                    title: post.title,
                    body: post.body
                }
                this.temp_id = post.id;
                this.isEditMode = true;
            },
            deletePost(id){
                try{
                    axios.delete('api/posts/'+id)
                    .then( res => this.fetchall() )
                }catch(e){

                }
            },
            can(permissionName) {
                return Permissions.indexOf(permissionName) !== -1;
            }
        }
    }

    
</script>

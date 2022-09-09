<template>
    <div id="appaa">
        <button type="button" class="btn btn-success" @click="showAddModal">
          Add Post
        </button>
      
        <modal_add 
                v-show="isAddModalVisible" 
                @data="fetchall" 
                @close="closeAddModal" />
      </div>
    <div class="card-body">
        <div class="card-header">Posts
        </div>
        <!-- <table class="table table-hover" v-if="postlist.length > 0">
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
        <div v-else="postlist.length == 0">Sorry there are no posts. Please add from "Add New" button above.</div> -->
        <grid-post ref="gridPostPopUp" />
    </div>

</template>

<script>
    import modal_add from './ModalAdd.vue';
    import gridPost from './grid-post.vue';
    
    // import modal_edit from './ModalEdit.vue';
    export default {
        name: "Post",
        components: {gridPost,modal_add},
        data() {
            return {
                Title: "Post",
                list: [],
                permissionList: [],
                item: {
                    id: '',
                    title: '',
                    body: ''
                },
                isHidden: false,
                temp_id: null, 
                isEditMode: false,
                isAddModalVisible : false
            }
        },
        mounted(){
            // this.fetchall();
            // console.log(this.postdata);
        },
        methods: {
            showAddModal() {
                this.isAddModalVisible = true;
            },
            closeAddModal() {
                this.isAddModalVisible = false;
            },
            fetchall(){

                this.$refs.gridPostPopUp.fetchall1();
                
            },
            /*savePost(){
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
            },*/
            /*can(permissionName) {
                return Permissions.indexOf(permissionName) !== -1;
            }*/
        }
    }

    
</script>

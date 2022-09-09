import './bootstrap';

// import Permissions from './mixins/Permissions';
// Vue.mixin(Permissions);
import { createApp } from 'vue';

import PostCrud from './components/posts-crud/index.vue';

createApp(PostCrud).mount("#postCrudView");

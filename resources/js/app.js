import './bootstrap';

import {createApp, onMounted} from 'vue';
import router from './Routes/Index.js';
import {TailwindPagination} from 'laravel-vue-pagination';
import VueSweetalert2 from 'vue-sweetalert2';
import useAuth from './Composables/auth.js';

const app = createApp({
    setup() {
        const { getUser } = useAuth();
        onMounted(getUser);
    }
});
// app.component('PostsIndex', PostsIndex);
app.component('TailwindPagination', TailwindPagination);
app.use(router);
app.use(VueSweetalert2);
app.mount('#app');


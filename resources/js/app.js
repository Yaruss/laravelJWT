import './bootstrap';

import { createApp } from 'vue'

import store from './store'

const app = createApp({
    created() {
    },
    mounted() {
        console.log('app mount ')
    }
});

app.component('test', (await import('./component/test.vue')).default);

app.use(store);
app.mount('#app');

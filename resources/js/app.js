import './bootstrap';

import { createApp } from 'vue'

import store from './store'

window.store=store;

const app = createApp({
    created() {
    },
    mounted() {
        console.log('app mount ')
    }
});

import test from './component/test.vue'
app.component('test', test);

app.use(store);
app.mount('#app');

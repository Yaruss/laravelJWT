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

import menu_top from './component/menu.vue'
app.component('menu_top', menu_top);

import modal from './component/modal.vue'
app.component('modal', modal);

import login from './component/login.vue'
app.component('login', login);


app.use(store);
app.mount('#app');

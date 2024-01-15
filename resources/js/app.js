import './bootstrap';

import {createApp} from 'vue'

import store from './store'

window.store = store;

import vueRootMixin from "./rootMixin";

const app = createApp({
    mixins: [vueRootMixin],
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

import task from './component/task.vue'

app.component('task', task);

import tasknew from './component/taskNew.vue'

app.component('tasknew', tasknew);

import taskupdate from './component/taskUpdate.vue'

app.component('taskupdate', taskupdate);

import commentnew from './component/commentNew.vue'

app.component('commentnew', commentnew);

import confirmation from './component/actionConfirmation.vue'

app.component('confirmation', confirmation);

app.use(store);
app.mount('#app');

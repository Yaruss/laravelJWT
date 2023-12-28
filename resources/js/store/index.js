
import { createStore } from 'vuex'

export default createStore({
    state: {
        test:{name:'name'},
        count:0
    },
    actions: {
        inc2(context){
            context.state.count=0;
        }
    },
    getters: {

    },
    mutations: {
        inc(state){
            state.count++;
        }
    }
});

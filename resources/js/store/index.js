
import { createStore } from 'vuex'

export default createStore({
    state: {
        token:{},
        login:{},

        task:{},
    },
    actions: {
        login(context, payload){
            axios.post('/api/auth/login', payload)
                .then((response) => {
                    context.commit('SET_LOGIN_OK', response.data);
                }).catch((error) => {
                context.commit('SET_LOGIN_ERROR', error.response.data);
            });
        }
    },
    getters: {

    },
    mutations: {
        SET_LOGIN_OK(state, payload){
            state.login=Object.assign(state.login, {login:true, error:{}})
            console.log(payload);
            return state.token = payload;
        },
        SET_LOGIN_ERROR(state, payload){
            state.token={};
            return state.login=Object.assign(state.login, {error:payload, login:false})
        }
    }
});

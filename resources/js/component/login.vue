<template>
    <form v-if="!login">
        <div class="form-group my-2">
            <label>Email address or name</label>
            <input class="form-control" placeholder="email" v-model="email">
            <small class="form-text text-muted">Enter email or name</small>
            <div v-html="$root.isError(error,'email')"></div>
        </div>
        <div class="form-group my-4">
            <label>Password</label>
            <input type="password" class="form-control" placeholder="Password" v-model="password">
            <div v-html="$root.isError(error,'password')"></div>
        </div>
        <div class="alert alert-danger" role="alert" v-if="error.error">
            {{error.error}}
        </div>
        <a class="btn btn-primary my-4" @click="send({email, password})">Submit</a>
    </form>
    <div class="alert alert-success" role="alert" v-else>
        Login
    </div>
</template>
<script>
    const data = {
        email: 'test@test.ru',
        password: 'test',
        error: {},
        login: false,
    }
    export default {
        data() {
            return data;
        },
        computed: {},
        methods: {
            send(data) {
                this.$store.dispatch('login', data);
            }
        },
        mounted() {
            this.$store.state.login = data;
        }
    }
</script>


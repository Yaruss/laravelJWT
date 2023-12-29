<template>
    <div v-if="'access_token' in state.token">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" v-model="state.login.email">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">access_token</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{state.token.access_token}}</textarea>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                set:{}
            };
        },
        computed: {
            state(){
                return this.$root.$store.state
            }
        },
        methods: {
        },
        mounted() {
            console.log('mount test');
        }
    }
</script>

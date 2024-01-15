<template>
    <div class="row" v-if="'access_token' in state.token">
        <div class="col-md-6">
            <h3>Task list</h3>
            <task></task>
        </div>
        <div class="col-md-6">
            <h3>Info user</h3>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" v-model="state.token.user.email">
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="email" class="form-control" v-model="state.token.user.name">
            </div>
            <div class="mb-3">
                <label class="form-label">Created</label>
                <input type="email" class="form-control" v-model="state.token.user.created_at">
            </div>
            <div class="mb-3">
                <label class="form-label">Updated</label>
                <input type="email" class="form-control" v-model="state.token.user.updated_at">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">access_token</label>
                <textarea class="form-control" id="exampleFormControlTextarea1"
                          rows="3">{{state.token.access_token}}</textarea>
            </div>
            <div class="mb-3">
                <label for="resultjson" class="form-label">resultjson</label>
                <textarea class="form-control" id="resultjson" rows="3">{{state.resultjson}}</textarea>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        computed: {
            state() {
                return this.$root.$store.state
            }
        },
        methods: {},
        mounted() {
            console.log('mount test');
        }
    }
</script>

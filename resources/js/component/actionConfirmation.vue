<template>
    <div>
        {{message}}
    </div>
    <a class="btn btn-primary my-4" @click="ok()" data-bs-dismiss="modal" aria-label="Close">Ok</a>
    <a class="btn btn-primary my-4 float-end" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
</template>
<script>
    const data={
        message:{},
        myevent:{}
    }
    export default {
        data() {
            return data;
        },
        computed: {
        },
        methods: {
            ok(){
                this.myevent();
            }
        },
        mounted() {
            this.$store.state.confirmation=data;
            console.log('mount confirmation');
        }
    }
</script>


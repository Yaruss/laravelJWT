<template>
    <div v-if="$root.islogin">

    </div>
    <div v-else>
        not login
    </div>
</template>
<script>
    const set={
        item:{},
        error:{}
    }
    const data ={
        url:'/api/data/task',
    };

    export default {
        data() {
            return data;
        },
        computed: {
        },
        methods: {
            send(){
                this.stdData.get();
            }
        },
        mounted() {
            this.$store.state.task=set;
            this.stdData = this.$root.stdQuery(this, data);
            console.log('mount login');
        }
    }
</script>


<template>

</template>
<script>
    const set={
        item:{},
        error:{},
    }
    const data ={
        url:'/api/data/task',
    };

    export default {
        data() {
            return set;
        },
        computed: {
        },
        methods: {
            taskAll(){
                console.log('send')
                this.stdData.get();
            }
        },
        mounted() {
            this.$store.state.task=set;
            this.stdData = this.$root.stdQuery(this, data);
            console.log('mount task');
        }
    }
</script>


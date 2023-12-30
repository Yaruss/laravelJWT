<template>
    <form>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3"></textarea>
        </div>

        <a class="btn btn-primary my-4">Submit</a>
    </form>
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


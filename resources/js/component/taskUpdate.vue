<template>
    <form>
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" v-model="item.title">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" rows="3" v-model="item.description"></textarea>
        </div>
        <a class="btn btn-primary my-4" @click="taskUpdate()" data-bs-dismiss="modal" aria-label="Close">Submit</a>
    </form>
</template>
<script>
    const set = {
        item: {
            id: '',
            title: '',
            description: '',
        },
        error: {},
        myevent: {},
    }
    const data = {
        url: '/api/data/task',
        method: 'put'
    };

    export default {
        data() {
            return set;
        },
        computed: {},
        methods: {
            taskUpdate() {
                this.stdData.get({
                    data: this.item,
                    fnOk: (t, v) => Object.assign(t.item, v),
                });
            }
        },
        mounted() {
            this.$store.state.taskupdate = set;
            this.stdData = this.$root.stdQuery(this, data);
            console.log('mount task Update');
        }
    }
</script>


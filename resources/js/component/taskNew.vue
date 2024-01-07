<template>
    <form v-if="add">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" v-model="title">
            <div v-html="$root.isError(error,'title')"></div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3" v-model="description"></textarea>
            <div v-html="$root.isError(error,'description')"></div>
        </div>

        <a class="btn btn-primary my-4" @click="taskAdd({title, description})">Add task</a>
    </form>
    <div v-else>
        <a class="btn btn-primary my-4" @click="add=!add">Task added, add more?</a>
    </div>
</template>
<script>
    const data ={
        method:'post',
        url:'/api/data/task',
    };
    export default {
        data() {
            return {
                add:true,
                item:{},
                error:{},
                title:'title1',
                description: 'description1',
            };
        },
        computed: {
        },
        methods: {
            taskAdd(data){
                this.stdData.get({
                    data,
                    fnOk:($t,$v)=>{
                        $t.add=!$t.add;
                        $t.$store.state.task.item.push($v);
                    }});
            }
        },
        mounted() {
            this.stdData = this.$root.stdQuery(this, data);
            console.log('mount task new');
        }
    }
</script>


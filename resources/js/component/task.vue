<template>
    <div v-if="$root.islogin">
        <div class="btn-group mb-3">
            <button type="button" class="btn btn-outline-secondary" @click="taskAll()">
                <i class="bi bi-arrow-repeat"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#tasknew">
                <i class="bi bi-plus-circle"></i>
            </button>
        </div>

        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action" aria-current="true" v-for="i in item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{i.title}}</h5>
                    <small> {{i.created_at}} {{i.update_at}}</small>
                    <div class="btn-group mb-3">
                        <button type="button" class="btn btn-outline-secondary" @click="taskDel(i.id)">
                            <i class="bi bi-trash"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="bi bi-toggle-off"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="bi bi-chat-square-dots"></i>
                        </button>
                    </div>
                </div>
                <p class="mb-1">{{i.description}}</p>
                <small>{{i.completed}}</small>
            </a>
        </div>

    </div>
    <div v-else>
        not login
    </div>
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
            },
            taskDel(id){
                console.log('del')
                this.stdData.get({method:'delete', data:{id}})
            }
        },
        mounted() {
            this.$store.state.task=set;
            this.stdData = this.$root.stdQuery(this, data);
            console.log('mount task');
        }
    }
</script>


<template>
    <div class="btn-group mb-3">
        <button type="button" class="btn btn-outline-secondary" @click="taskAll()">
            <i class="bi bi-repeat"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#tasknew">
            <i class="bi bi-plus-circle"></i>
        </button>
    </div>
    <div class="list-group">
        <a class="list-group-item list-group-item-action" aria-current="true" v-for="i in item">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{i.title}}</h5>
                <small>
                    <span class="bi bi-patch-plus"> &nbsp; {{$root.localeDate(i.created_at)}}</span><br>
                    <span class="bi bi-check-all _bi-arrow-repeat" v-if="i.completed"> &nbsp; {{$root.localeDate(i.completed_date)}}</span>
                </small>
            </div>
            <p class="mb-1">{{i.description}}</p>
            <div class="my-2" v-if="i.show">
                <small class="d-inline-block p-2 bg-light-subtle" v-for="c in i.comments">{{c.comment}}</small>
            </div>
            <div class="btn-group mb-3">
                <button type="button" class="btn btn-outline-secondary" @click="taskDel(i)" data-bs-toggle="modal" data-bs-target="#confirmation">
                    <i class="bi bi-trash"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" @click="changeCompleted(i)">
                    <i class="bi" :class="{'bi-toggle-on text-success':i.completed, 'bi-toggle-off':!i.completed}"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" @click="showComments(i)">
                    <i class="bi bi-chat-square-dots"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" @click="taskUpdate(i)" data-bs-toggle="modal" data-bs-target="#taskupdate">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </a>
    </div>
</template>
<script>
    const set={
        item:{},
        error:{},
        itemSelect:{}
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
            taskDel(i){
                this.$root.$store.commit('SET_CONFIRMAION',{message:'Delete task?', myevent:()=>this.taskDelCoplite(i)});
            },
            taskDelCoplite(i){
                this.stdData.get({
                    method:'delete',
                    data:{id:i.id},
                    fnOk:$t=>$t['item'].filter((e)=>e.id!=i.id)
                })
            },
            changeCompleted(i){
                i.completed=!i.completed;
                this.itemSelect=i;
                this.stdData.get({
                    method:'put',
                    Ok:'itemSelect',
                    data:{id:i.id, completed: i.completed},
                    fnOk:(t,v)=>Object.assign(i, v),
                })
            },
            taskUpdate(i){
                this.$root.$store.commit('SET_TASKUPDATE',{item:i});
            },
            showComments(i){
                i.show=!i.show;
                this.itemSelect=i;
                this.stdData.get({
                    url:data.url+'/'+i.id,
                    Ok:'itemSelect',
                    fnOk:(t,v)=>Object.assign(i, v),
                })
            }
        },
        mounted() {
            this.$store.state.task=set;
            this.stdData = this.$root.stdQuery(this, data);
            console.log('mount task');
        }
    }
</script>


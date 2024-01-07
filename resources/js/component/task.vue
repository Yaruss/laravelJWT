<template>
    <div class="input-group mb-3">
        <button type="button" class="btn btn-outline-secondary" @click="this.ascdesc=this.ascdesc=='asc'?'desc':'asc';updatePage()">
            <i class="bi" :class="{'bi-arrow-down':ascdesc=='asc', 'bi-arrow-up':ascdesc=='desc'}"></i>
        </button>
        <select class="form-select" id="inputGroupSelect01" aria-label="Example select with button addon" v-model="order" @change="updatePage()">
            <option value="id">Id</option>
            <option value="title">Title</option>
            <option value="description">Description</option>
            <option value="completed_date">Completed date</option>
        </select>
        <button type="button" class="btn btn-outline-secondary" @click="updatePage()">
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
            <div class="btn-group mb-3">
                <button type="button" class="btn btn-outline-secondary" @click="taskDel(i)" data-bs-toggle="modal" data-bs-target="#confirmation">
                    <i class="bi bi-trash"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" @click="changeCompleted(i)">
                    <i class="bi" :class="{'bi-toggle-on text-success':i.completed, 'bi-toggle-off':!i.completed}"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" @click="showComments(i)" data-bs-toggle="modal" data-bs-target="#commentnew">
                    <i class="bi bi-chat-square-dots"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" @click="taskUpdate(i)" data-bs-toggle="modal" data-bs-target="#taskupdate">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </a>
    </div>
    <div class="btn-group mt-3">
        <button type="button" class="btn btn-outline-secondary" @click="page=page<=0?0:page-1;updatePage()">
            <i class="bi bi-arrow-left"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary">
            {{page*1+1*1}} of {{pages+1}}
        </button>
        <button type="button" class="btn btn-outline-secondary" @click="page=page>=pages?pages:page*1+1;updatePage()">
            <i class="bi bi-arrow-right"></i>
        </button>
    </div>
</template>
<script>
    const set={
        item:{},
        error:{},
        itemSelect:{},
        ascdesc:'asc',
        order:'id',
        page:0,
        limit:2,
        count:0,
    }
    const data ={
        url:'/api/data/task/',
    };

    export default {
        data() {
            return set;
        },
        computed: {
            pages(){
                let x = Math.floor(this.count/this.limit);
                x=this.count%this.limit>0?x:x-1;
                return x;
            }
        },
        methods: {
            taskAll($get=''){
                console.log('send')
                this.stdData.get({
                    url:data.url+'page?'+$get,
                    fnOk:(t,v)=>{
                        t.page=v.page;
                        t.count=v.count;
                        return t.item=v.tasks
                    }
                });
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
                this.$root.$store.state.comment.show(i);
            },
            updatePage(data={page:this.page,limit:this.limit,order:this.order,ascdesc:this.ascdesc}){
                var get=[];
                Object.entries(data).forEach(([key, value]) => get.push(key+"="+value));
                console.log(get.join('&'));
                this.taskAll(get.join('&'))
            }
        },
        mounted() {
            this.$store.state.task=set;
            this.stdData = this.$root.stdQuery(this, data);
            console.log('mount task');
            this.taskAll();
        }
    }
</script>


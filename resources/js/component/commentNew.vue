<template>
    <form>
        <div class="list-group">
            <a class="list-group-item list-group-item-action active">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{item.title}}</h5>
                    <small>
                        <span class="bi bi-patch-plus"> &nbsp; {{$root.localeDate(item.created_at)}}</span><br>
                        <span class="bi bi-check-all _bi-arrow-repeat" v-if="item.completed"> &nbsp; {{$root.localeDate(item.completed_date)}}</span>
                    </small>
                </div>
                <p class="mb-1">{{item.description}}</p>
            </a>
            <a class="list-group-item list-group-item-action" aria-current="true" v-for="i in item.comments">
                <p class="mb-1">{{i.comment}}</p>
            </a>
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <input type="text" class="form-control" id="comment" v-model="comment">
        </div>
        <a class="btn btn-primary my-4" @click="storeComment({comment, id:item.id})">Submit</a>
    </form>
</template>
<script>
    const set={
        item:{},
        error:{},
        comment:'',
    }
    const data ={
        url:'/api/data/comment',
    };

    export default {
        data() {
            return set;
        },
        computed: {
        },
        methods: {
            show(i){
                this.item=i;
                this.stdData.get({
                    url:'/api/data/task/idwithcomments?id='+i.id
                });
            },
            storeComment(data){
                this.stdData.get({
                    data,
                    method:'post',
                    fnOk:(t,v)=>{
                        console.log(v)
                        t.item.comments.push(v);
                        return t.item;
                    }
                })
            }
        },
        mounted() {
            this.$store.state.comment=set;
            set.show=this.show;
            this.stdData = this.$root.stdQuery(this, data);
            console.log('mount Comment new');
        }
    }
</script>


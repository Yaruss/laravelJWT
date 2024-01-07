<template>
    <div class="modal fade" :id="title" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-if="$root.islogin">
                        <slot></slot>
                    </div>
                    <div v-else>
                        <login></login>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props:['title'],
        data() {
            return {
                set:{}
            };
        },
        computed: {
        },
        methods: {
        },
        mounted() {
        }
    }
</script>

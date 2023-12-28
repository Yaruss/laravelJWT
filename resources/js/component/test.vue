<template>
    <div>
        {{state}}
    </div>
</template>

<script>
    export default {
        data() {
            return {
                set:{}
            };
        },
        computed: {
            state(){
                return this.$root.$store.state
            }
        },
        methods: {
        },
        mounted() {
            console.log('mount test');
        }
    }
</script>

<template>
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none ">
            <i class="bi bi-shop fs-2"></i>
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4" v-if="$root.islogin">
            <li><a href="#" class="nav-link px-2 link-dark" data-bs-toggle="modal" data-bs-target="#task">Tasks</a></li>
            <li><a href="#" class="nav-link px-2 link-dark" data-bs-toggle="modal" data-bs-target="#tasknew">Tasks new</a></li>
            <li><a class="nav-link px-2 link-dark" href="/">Logout</a></li>
        </ul>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4" v-else>
            <li><a class="nav-link px-2 link-dark" href="#" data-bs-toggle="modal" data-bs-target="#login">Login</a></li>
        </ul>
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
        },
        methods: {
        },
        mounted() {
            console.log('mount menu');
        }
    }
</script>

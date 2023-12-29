<template>
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none ">
            <i class="bi bi-shop fs-2"></i>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
            <li><a href="#" class="nav-link px-2 link-dark" data-bs-toggle="modal" data-bs-target="#task">Tasks</a></li>
            <li><a href="#" class="nav-link px-2 link-dark" data-bs-toggle="modal" data-bs-target="#tasknew">Tasks new</a></li>
        </ul>

        <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/test.png" alt="dom" class="rounded-circle" width="32"
                     height="32">
            </a>
            <ul class="dropdown-menu text-small">
                <div v-if="$root.islogin">
                    <li><a class="dropdown-item" href="#">Refresh token</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </div>
                <div v-else>
                    <li><a class="dropdown-item" href="#">Registration</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#login">Login</a></li>
                </div>
            </ul>
        </div>
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

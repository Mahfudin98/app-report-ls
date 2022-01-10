<template>
<div class="container d-flex flex-column">
    <page-loader />
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Welcome back, LS TEAM</h1>
                    <p class="lead">
                        Sign in to your account to continue
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <div class="text-center">
                                <img :src="'/images/logo.png'" alt="Logo" class="img-fluid rounded-circle" width="132" height="132" />
                            </div>
                            <form>
                                <div class="mb-3">
                                    <label class="username">Username</label>
                                    <input class="form-control form-control-lg" type="text" placeholder="Enter your username" v-model="data.username" required />

                                    <p class="text-danger" v-if="errors.username">
                                        {{ errors.username[0] }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control form-control-lg" type="password" placeholder="Enter your password" required v-model="data.password" />

                                    <p class="text-danger" v-if="errors.password">
                                        {{ errors.password[0] }}
                                    </p>
                                </div>
                                <div>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberMe" v-model="data.remember_me" />
                                        <span class="form-check-label" for="rememberMe">Remember me</span>
                                    </label>
                                </div>
                                <div class="text-center mt-3">
                                    <!-- <a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->
                                    <button type="submit" class="btn btn-lg btn-primary" @click.prevent="postLogin">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- <div class="rui-sign align-items-center justify-content-center">
        <div class="bg-image">
            <div class="bg-grey-1"></div>
        </div>
        <div class="form rui-sign-form rui-sign-form-cloud">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-12">
                    <h1 class="display-4 mb-10 text-center">Sign In</h1>
                </div>
                <div class="col-12">
                    <input class="form-control" type="text" placeholder="Enter your username" v-model="data.username" required />

                    <p class="text-danger" v-if="errors.username">
                        {{ errors.username[0] }}
                    </p>
                </div>
                <div class="col-12">
                    <input class="form-control" type="password" placeholder="Enter your password" required v-model="data.password" />

                    <p class="text-danger" v-if="errors.password">
                        {{ errors.password[0] }}
                    </p>
                </div>
                <p class="text-danger" v-if="errors.invalid">
                    {{ errors.invalid }}
                </p>
                <div class="col-sm-6">
                    <div class="custom-control custom-checkbox d-flex justify-content-start">
                        <input type="checkbox" class="custom-control-input" id="rememberMe" v-model="data.remember_me" />
                        <label class="custom-control-label fs-13" for="rememberMe">Remember me</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="fs-13">Forget password?</a>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-brand btn-block text-center" type="submit" @click.prevent="postLogin">
                        Sign in
                    </button>
                </div>
            </div>
        </div>
    </div> -->
</template>

<!-- JAVASCRIPT SECTION -->

<script>
import PageLoader from '../../components/PageLoader.vue'
import {
    mapActions,
    mapMutations,
    mapGetters,
    mapState
} from "vuex";
export default {
    data() {
        return {
            data: {
                username: "",
                password: "",
                remember_me: false
            }
        };
    },
    created() {
        if (this.isAuth) {
            this.$router.push({
                name: "home"
            });
        }
    },
    computed: {
        ...mapGetters(["isAuth"]),
        ...mapState(["errors"])
    },
    methods: {
        ...mapActions("user", ["getUserLogin"]),
        ...mapActions("auth", ["submit"]),
        ...mapMutations(["CLEAR_ERRORS"]),
        postLogin() {
            this.submit(this.data).then(() => {
                if (this.isAuth) {
                    this.CLEAR_ERRORS();
                    window.location.reload();
                    this.$router.push({
                        name: "home"
                    });
                }
            });
        }
    },
    destroyed() {
        this.getUserLogin();
    },
    components: {
        PageLoader
    }
};
</script>

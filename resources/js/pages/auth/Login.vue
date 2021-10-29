<template>
    <main>
        <page-loader />
        <div class="rui-sign align-items-center justify-content-center">
            <div class="bg-image">
                <div class="bg-grey-1"></div>
            </div>
            <div class="form rui-sign-form rui-sign-form-cloud">
                <div class="row vertical-gap sm-gap justify-content-center">
                    <div class="col-12">
                        <h1 class="display-4 mb-10 text-center">Sign In</h1>
                    </div>
                    <div class="col-12">
                        <input
                            class="form-control"
                            type="text"
                            placeholder="Enter your username"
                            v-model="data.username"
                            required
                        />

                        <p class="text-danger" v-if="errors.username">
                            {{ errors.username[0] }}
                        </p>
                    </div>
                    <div class="col-12">
                        <input
                            class="form-control"
                            type="password"
                            placeholder="Enter your password"
                            required
                            v-model="data.password"
                        />

                        <p class="text-danger" v-if="errors.password">
                            {{ errors.password[0] }}
                        </p>
                    </div>
                    <p class="text-danger" v-if="errors.invalid">
                        {{ errors.invalid }}
                    </p>
                    <div class="col-sm-6">
                        <div
                            class="custom-control custom-checkbox d-flex justify-content-start"
                        >
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="rememberMe"
                                v-model="data.remember_me"
                            />
                            <label
                                class="custom-control-label fs-13"
                                for="rememberMe"
                                >Remember me</label
                            >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-end">
                            <a href="#" class="fs-13">Forget password?</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <button
                            class="btn btn-brand btn-block text-center"
                            type="submit"
                            @click.prevent="postLogin"
                        >
                            Sign in
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<!-- JAVASCRIPT SECTION -->
<script>
import PageLoader from '../../components/PageLoader.vue'
import { mapActions, mapMutations, mapGetters, mapState } from "vuex";
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
            this.$router.push({ name: "home" });
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
                    this.$router.push({ name: "home" });
                }
            });
        }
    },
    destroyed() {
        this.getUserLogin();
    },
    components: {PageLoader}
};
</script>

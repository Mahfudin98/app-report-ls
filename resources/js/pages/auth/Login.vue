<template>
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
    <!-- <article class="sign-up">
        <h1 class="sign-up__title">Welcome back!</h1>
        <p class="sign-up__subtitle">Sign in to your account to continue</p>
        <form class="sign-up-form form" action="" method="">
            <label class="form-label-wrapper">
                <p class="form-label">Username</p>
                <input
                    class="form-input"
                    type="text"
                    placeholder="Enter your username"
                    v-model="data.username"
                    required
                />

                <p class="text-danger" v-if="errors.username">
                    {{ errors.username[0] }}
                </p>
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Password</p>
                <input
                    class="form-input"
                    type="password"
                    placeholder="Enter your password"
                    required
                    v-model="data.password"
                />

                <p class="text-danger" v-if="errors.password">
                    {{ errors.password[0] }}
                </p>
            </label>
            <a class="link-info forget-link" href="##">Forgot your password?</a>
            <label class="form-checkbox-wrapper">
                <input
                    class="form-checkbox"
                    type="checkbox"
                    v-model="data.remember_me"
                />
                <span class="form-checkbox-label">Remember me next time</span>
            </label>
            <button
                class="form-btn primary-default-btn transparent-btn"
                type="submit"
                @click.prevent="postLogin"
            >
                Sign in
            </button>
        </form>
    </article> -->
</template>

<!-- JAVASCRIPT SECTION -->
<script>
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
    }
};
</script>

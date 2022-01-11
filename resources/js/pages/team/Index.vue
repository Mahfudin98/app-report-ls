<template>
<main class="content">
    <page-loader />
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>{{ $route.meta.title }}</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <router-link class="btn btn-primary" v-if="authenticated.role == 0 || $can('create teams') || $route.name == 'teams.data'" :to="{ name: 'teams.add' }">
                    <span class="material-icons align-middle">
                        add_circle_outline
                    </span>
                    <span class="align-middle">New Team</span>
                </router-link>
            </div>
        </div>
        <router-view></router-view>
    </div>
</main>
</template>

<script>
import PageLoader from '../../components/PageLoader.vue'
import { mapActions, mapState } from "vuex";
export default {
    name: "IndexTeam",
    components: {
        PageLoader
    },
    computed: {
        ...mapState("user", {
            authenticated: state => state.authenticated //ME-LOAD STATE AUTHENTICATED
        }),
    }
};
</script>

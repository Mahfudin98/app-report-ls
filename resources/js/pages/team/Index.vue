<template>
<main class="content">
    <page-loader />
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ $route.meta.title }}</h1>
        <router-view></router-view>
    </div>
</main>
</template>

<script>
import PageLoader from '../../components/PageLoader.vue'
import {
    mapActions,
    mapState
} from "vuex";
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

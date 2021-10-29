<template>
    <main>
        <page-loader/>
        <div class="rui-page-title">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard.html">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Apps</a></li>
                    </ol>
                </nav>
                <div
                    class="d-flex justify-content-between align-items-center mb-20"
                >
                    <h1>{{ $route.meta.title }}</h1>
                    <router-link
                        v-if="this.$route.name == 'adv.report.data'"
                        class="btn btn-brand btn-long"
                        :to="{ name: 'adv.report.add' }"
                    >
                        <span class="icon"
                            ><span class="rui-icon fas fa-plus"></span></span
                        ><span class="text">ADD REPORT</span>
                    </router-link>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </main>
</template>
<script>
import PageLoader from '../../components/PageLoader.vue'
export default {
    name: "IndexReport",
    components: {PageLoader}
};
</script>

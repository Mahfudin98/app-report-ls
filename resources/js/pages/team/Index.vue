<template>
    <main>
        <page-loader/>
        <div class="rui-page-title">
            <div
                class="container-fluid"
            >
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard.html">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Apps</a></li>
                    </ol>
                </nav>
                <h1>{{ $route.meta.title }}</h1>
            </div>
        </div>
        <router-view></router-view>
    </main>
</template>
<script>
import PageLoader from '../../components/PageLoader.vue'
export default {
    name: "IndexTeam",
    components: {PageLoader}
};
</script>

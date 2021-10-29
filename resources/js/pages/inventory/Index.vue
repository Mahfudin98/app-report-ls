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
                <div
                    class="d-flex justify-content-between align-items-center mb-20"
                >
                    <h1>{{ $route.meta.title }}</h1>
                    <router-link v-if="this.$route.name == 'inventory.data'" :to="{ name: 'inventory.usage' }" class="btn btn-brand btn-long">
                        <span class="icon"><span class="fab fa-codepen"></span></span><span class="text">Detail</span>
                    </router-link>
                    <router-link v-if="this.$route.name != 'inventory.data'" :to="{ name: 'inventory.data' }" class="btn btn-secondary btn-long">
                        <span class="icon"><span class="fas fa-chevron-circle-left"></span></span><span class="text">Back</span>
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
    name: "IndexInventory",
    components: {PageLoader}
};
</script>

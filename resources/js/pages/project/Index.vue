<template>
    <main class="content">
        <page-loader />
        <div class="container-fluid p-0">
            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h1 class="h3 mb-3">{{ $route.meta.title }}</h1>
                </div>

                <div class="col-auto ms-auto text-end mt-n1">
                    <router-link
                        :to="{ name: 'project.add' }"
                        class="btn btn-primary"
                        v-if="$can('create projects')"
                    >
                        <span class="material-icons align-middle">
                            add_circle_outline
                        </span>
                        Report Add
                    </router-link>
                </div>
            </div>
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
import PageLoader from "../../components/PageLoader.vue";
export default {
    name: "IndexProject",
    components: {
        PageLoader
    }
};
</script>

<template>
<div class="rui-page-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <router-link :to="{ name: 'project.data' }" class="btn btn-secondary">
                <span class="icon">
                    <span class="fas fa-arrow-alt-circle-left"></span>
                </span>
                <span class="text">Back</span>
            </router-link>
            <button @click.prevent="submit" class="btn btn-brand">
                <span class="icon">
                    <i class="fas fa-save"></i>
                </span>
                <span class="text">Save</span>
            </button>
        </div>
        <form-project ref="projectForm"></form-project>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState,
    mapMutations
} from "vuex";
import ProjectForm from "./ProjectForm.vue";
export default {
    name: "AddTeam",
    methods: {
        submit() {
            this.$refs.projectForm.submit();
        }
    },
    components: {
        "form-project": ProjectForm
    }
};
</script>

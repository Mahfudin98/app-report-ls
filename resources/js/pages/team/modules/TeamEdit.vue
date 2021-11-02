<template>
    <div class="rui-page-content">
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <router-link
                    :to="{ name: 'teams.data' }"
                    class="btn btn-secondary"
                >
                    <span class="icon">
                        <span class="fas fa-arrow-alt-circle-left"></span>
                    </span>
                    <span class="text">Back</span>
                </router-link>
                <button

                    @click.prevent="submit"
                    class="btn btn-brand"
                >
                    <span class="icon">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Save Update</span>
                </button>
            </div>
            <form-team ref="teamForm"></form-team>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import TeamForm from "./TeamForm.vue";
export default {
    name: "EditTeam",
    methods: {
        submit() {
            this.$refs.teamForm.submit();
        }
    },
    components: {
        "form-team" : TeamForm
    }
};
</script>

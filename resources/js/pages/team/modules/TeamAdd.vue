<template>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <router-link :to="{ name: 'teams.data' }" class="btn btn-secondary">
                <span class="material-icons align-middle">
                    reply
                </span>
                <span class="align-middle">Back</span>
            </router-link>
            <button @click.prevent="submit" class="btn btn-primary">
                <span class="material-icons align-middle">
                    save
                </span>
                <span class="align-middle">Save</span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form-team ref="teamForm"></form-team>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState,
    mapMutations
} from "vuex";
import TeamForm from "./TeamForm.vue";
export default {
    name: "AddTeam",
    methods: {
        submit() {
            this.$refs.teamForm.submit();
        }
    },
    components: {
        "form-team": TeamForm
    }
};
</script>

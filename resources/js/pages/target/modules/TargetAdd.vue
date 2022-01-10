<template>
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{ name: 'target.data' }" class="btn btn-secondary">
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
            <form-target ref="targetForm"></form-target>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState,
    mapMutations
} from "vuex";
import TargetForm from "./TargetForm.vue";
export default {
    name: "AddTarget",
    methods: {
        submit() {
            this.$refs.targetForm.submit();
        }
    },
    components: {
        "form-target": TargetForm
    }
};
</script>

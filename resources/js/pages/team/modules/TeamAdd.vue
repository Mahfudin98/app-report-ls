<template>
    <div class="">
        <form-team ref="teamForm"></form-team>
        <div class="row new-page__row">
            <div class="col-xl-8 col-md-6">
                <div class="new-page-content white-block">
                    <button class="primary-default-btn" @click.prevent="submit">
                        <lord-icon
                            src="https://cdn.lordicon.com/xhwleznj.json"
                            trigger="loop"
                            colors="primary:#fffff,secondary:#ffffff"
                            style="width:50px;height:50px"
                        >
                        </lord-icon>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from "vuex";
import TeamForm from "./TeamForm.vue";
export default {
    name: "AddTeam",
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

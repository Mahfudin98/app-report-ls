<template>
    <div class="rui-page-content">
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <router-link
                    :to="{
                        name: 'report.data.date',
                        params: { date: reportcs.date }
                    }"
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
                    <span class="text">Save</span>
                </button>
            </div>
            <form-description ref="descriptionForm"></form-description>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from "vuex";
import FormDescription from "./ReportCSFormDescription.vue";
export default {
    name: "AddDescription",
    created() {
        this.viewCsReport(this.$route.params.date);
    },
    computed: {
        ...mapState("csReport", {
            reportcs: state => state.reportcs
        }),
    },
    methods: {
        submit() {
            this.$refs.descriptionForm.submit();
        },
        ...mapActions("csReport", ["viewCsReport"])
    },
    components: {
        "form-description" : FormDescription
    }
};
</script>

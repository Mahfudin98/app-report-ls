<template>
    <div class="rui-page-content">
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <router-link
                    :to="{ name: 'cs.report.data' }"
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
                    <span class="text">Save Report</span>
                </button>
            </div>
            <form-report-cs ref="reportCSForm"></form-report-cs>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from "vuex";
import Button from '../../../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button.vue';
import ReportCSForm from "./ReportCSForm.vue";
export default {
    name: "AddReportCS",
    methods: {
        submit() {
            this.$refs.reportCSForm.submit();
        }
    },
    components: {
        "form-report-cs" : ReportCSForm,
        Button
    }
};
</script>

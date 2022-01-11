<template>
<div class="rui-page-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <router-link :to="{ name: 'adv.report.data' }" class="btn btn-secondary">
                <span class="icon">
                    <span class="fas fa-arrow-alt-circle-left"></span>
                </span>
                <span class="text">Back</span>
            </router-link>
            <button @click.prevent="submit" class="btn btn-brand">
                <span class="icon">
                    <i class="fas fa-save"></i>
                </span>
                <span class="text">Save Report</span>
            </button>
        </div>
        <form-report-adv ref="reportADVForm"></form-report-adv>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState,
    mapMutations
} from "vuex";
import Button from '../../../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button.vue';
import ReportADVForm from "./ReportADVForm.vue";
export default {
    name: "AddReportCS",
    methods: {
        submit() {
            this.$refs.reportADVForm.submit();
        }
    },
    components: {
        "form-report-adv": ReportADVForm,
        Button
    }
};
</script>

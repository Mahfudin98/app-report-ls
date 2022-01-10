<template>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{
                        name: 'report.data.date',
                        params: { date: reportcs.date }
                    }" class="btn btn-secondary">
                    <span class="material-icons align-middle">
                        reply
                    </span>
                    <span class="align-middle">Back</span>
                </router-link>
                <button @click.prevent="submit" class="btn btn-primary">
                    <span class="material-icons align-middle">
                        update
                    </span>
                    <span class="align-middle">Update</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form-description ref="descriptionForm"></form-description>
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
        "form-description": FormDescription
    }
};
</script>

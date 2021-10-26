<template>
    <b-modal id="addReportCS" title="Add Report CS" @ok="submit">
        <ReportsCSForm ref="reportsCSForm"/>
    </b-modal>
</template>
<script>
import ReportsCSForm from './ReportCSForm.vue'
export default {
    components : {ReportsCSForm},
    methods: {
        submit() {
            this.$refs.reportsCSForm.submit();
        }
    }
}
</script>

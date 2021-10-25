<template>
    <div
        class="modal fade"
        id="addReportCS"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addReportCSLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addReportCSLabel">
                        Add Report CS
                    </h3>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span
                            data-feather="x"
                            class="rui-icon rui-icon-stroke-1_5"
                        ></span>
                    </button>
                </div>
                <div class="modal-body">
                    <ReportsCSForm ref="reportsCSForm"/>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Close
                    </button>

                    <button type="submit" class="btn btn-brand" @click.prevent="submit">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
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

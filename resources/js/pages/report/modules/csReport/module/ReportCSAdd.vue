<template>
<b-modal id="addReportCS" title="Add Report CS">
    <ReportsCSForm ref="reportsCSForm" />
    <template #modal-footer>
        <div class="w-100">
            <!-- <b-button variant="primary" size="sm" class="float-left" @click="submit" :disabled="checkVal">
                Simpan
            </b-button> -->
            <b-overlay :show="busy" rounded opacity="0.6" spinner-small spinner-variant="primary" class="d-inline-block float-right mb-2" @hidden="onHidden">
                <button ref="button" :disabled="busy" @click="onClick" class="btn btn-brand">
                    <span class="icon">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Save</span>
                </button>
                <!-- <b-button ref="button" :disabled="busy" variant="brand" @click="onClick">
                    Save <b-icon  icon="upload" aria-hidden="true"></b-icon>
                </b-button> -->
            </b-overlay>
        </div>
    </template>
</b-modal>
</template>

<script>
import ReportsCSForm from './ReportCSForm.vue'
export default {
    components: {
        ReportsCSForm
    },
    data() {
        return {
            busy: false,
            timeout: null
        }
    },
    beforeDestroy() {
        this.clearTimeout()
    },
    methods: {
        submit() {
            this.$refs.reportsCSForm.submit();
        },

        // button
        clearTimeout() {
            if (this.timeout) {
                clearTimeout(this.timeout)
                this.timeout = null
            }
        },
        setTimeout(callback) {
            this.clearTimeout()
            this.timeout = setTimeout(() => {
                this.clearTimeout()
                callback()
            }, 10000)
        },
        onHidden() {
            // Return focus to the button once hidden
            this.$refs.button.focus()
        },
        onClick() {
            this.busy = true;
            // Simulate an async request
            this.setTimeout(() => {
                this.busy = false
            });
            this.submit();
        }
    }
}
</script>

<template>
<b-modal id="addCustomer" title="Add Customers">
    <customer-form ref="customerForm" />
    <template #modal-footer>
        <div class="w-100">
            <b-button variant="primary" size="sm" class="float-left" @click="submit">
                Close
            </b-button>
            <b-button variant="primary" class="float-right" disabled>
                <b-spinner small type="grow"></b-spinner>
                Loading...
            </b-button>
        </div>
    </template>
</b-modal>
</template>

<script>
import CustomerForm from './CustomerForm.vue'
export default {
    components: {
        CustomerForm
    },
    methods: {
        submit() {
            this.$refs.customerForm.submit();
        }
    }
}
</script>

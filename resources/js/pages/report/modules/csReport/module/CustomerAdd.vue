<template>
    <b-modal id="addCustomer" title="Add Customers" @ok="submit">
        <customer-form ref="customerForm"/>
    </b-modal>
</template>
<script>
import CustomerForm from './CustomerForm.vue'
export default {
    components : {CustomerForm},
    methods: {
        submit() {
            this.$refs.customerForm.submit();
        }
    }
}
</script>

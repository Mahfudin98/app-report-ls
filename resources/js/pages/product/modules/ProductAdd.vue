<template>
    <b-modal id="addModal" title="Add Report CS" @ok="submit">
        <product-form ref="productForm"/>
    </b-modal>
</template>
<script>
import { mapState, mapMutations, mapActions } from "vuex";
import ProductForm from './ProductForm.vue'
export default {
    components: {
        ProductForm
    },
    name: "FormProduct",
    methods: {
        submit() {
            this.$refs.productForm.submit();
        }
    }
};
</script>

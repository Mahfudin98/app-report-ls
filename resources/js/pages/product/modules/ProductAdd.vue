<template>
    <div
        class="modal fade"
        id="addModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addModalLabel">
                        Add Product
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
                    <product-form ref="productForm"/>
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
    },
    destroyed() {
        this.CLEAR_FORM();
    }
};
</script>

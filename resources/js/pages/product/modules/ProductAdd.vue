<template>
    <b-modal id="addModal" title="Add Report CS" @ok="submit">
        <product-form></product-form>
    </b-modal>
</template>
<script>
import { mapActions, mapState } from "vuex";
import ProductForm from "./ProductForm.vue";
export default {
    components: {
        ProductForm
    },
    name: "FormProduct",
    methods: {
        ...mapActions("product", ["submitProduct"]),
        submit() {
            this.submitProduct().then(() => {
                this.$swal({
                    background: "#FFFFFF",
                    title: "Ditambah!",
                    text: "Data Berhasil ditambah!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }
    }
};
</script>

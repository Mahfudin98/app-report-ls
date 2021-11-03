<template>
    <div class="rui-page-content">
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <router-link
                    :to="{ name: 'product.data' }"
                    class="btn btn-secondary"
                >
                    <span class="icon">
                        <span class="fas fa-arrow-alt-circle-left"></span>
                    </span>
                    <span class="text">Back</span>
                </router-link>
                <button @click.prevent="submit" class="btn btn-brand">
                    <span class="icon">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Save Update</span>
                </button>
            </div>
            <form-product></form-product>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import ProductForm from "./ProductForm.vue";
export default {
    name: "EditProduct",
    created() {
        this.editProduct(this.$route.params.id);
    },
    methods: {
        ...mapActions("product", ["editProduct", "updateProduct"]),
        submit() {
            this.updateProduct(this.$route.params.id).then(() => {
                this.$swal({
                    background: "#FFFFFF",
                    title: "Diupdate!",
                    text: "Data Berhasil diupdate!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
                this.$router.push({ name: "product.data" });
            });
        }
    },
    components: {
        "form-product": ProductForm
    }
};
</script>

<template>
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{ name: 'product.data' }" class="btn btn-secondary">
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
            <form-product></form-product>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState
} from "vuex";
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
                this.$router.push({
                    name: "product.data"
                });
            });
        }
    },
    components: {
        "form-product": ProductForm
    }
};
</script>

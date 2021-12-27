<template>
    <main>
        <div class="rui-page-content">
            <div class="container-fluid">
                <Calender />
            </div>
        </div>
    </main>
</template>
<script>
import { mapActions, mapState } from "vuex";
import VueMomentsAgo from "vue-moments-ago";
import Calender from "./Calendar.vue";
import moment from "moment";
export default {
    components: { VueMomentsAgo, Calender },
    created() {
        this.getProducts();
    },

    data() {
        return {
            search: "",
            fields: [
                { key: "index", label: "#" },
                { key: "name", label: "Name" },
                { key: "type_pembelian", label: "Type Pembelian" },
                { key: "type_product", label: "Type Product" },
                { key: "price", label: "Harga" },
                { key: "stock", label: "Stock" },
                { key: "action", label: "Aksi" }
            ]
        };
    },

    computed: {
        ...mapState("product", {
            products: state => state.products
        })
    },

    watch: {
        search() {
            this.getProducts(this.search);
        }
    },

    methods: {
        ...mapActions("product", ["getProducts", "removeProduct"]),
        deleteProduct(id) {
            this.$swal({
                title: "Kamu Yakin?",
                text: "Tindakan ini akan menghapus secara permanent!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, Lanjutkan!"
            }).then(result => {
                if (result.value) {
                    this.removeProduct(id);
                }
            });
        }
    }
};
</script>

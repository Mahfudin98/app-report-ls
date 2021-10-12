<template>
    <main>
        <div class="form-group">
            <label for="name">Nama Product</label>
            <input
                class="form-control"
                type="text"
                name="name"
                id="name"
                placeholder="Product name"
                v-model="product.name"
                required
            />
        </div>
        <div class="form-group">
            <label for="price">Harga Product</label>
            <input
                class="form-control"
                type="number"
                name="price"
                id="price"
                placeholder="Product price"
                v-model="product.price"
                required
            />
        </div>
        <div class="form-group">
            <label for="tipe_pembelian">Tipe Pembelian</label>
            <select
                id="tipe_pembelian"
                class="form-control"
                required
                v-model="product.type_pembelian"
            >
                <option selected="" value="" disabled="">Silahkan Pilih</option>
                <option value="0">Ecer</option>
                <option value="1">Paket Komplit</option>
                <option value="2">Paket Hemat</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipe_product">Tipe Product</label>
            <select
                class="form-control"
                id="tipe_product"
                required
                v-model="product.type_product"
            >
                <option selected="" value="" disabled="">Silahkan Pilih</option>
                <option value="0">BPOM</option>
                <option value="1">Farma</option>
            </select>
        </div>
    </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    data() {
        return {
            url: null
        };
    },
    name: "FormProduct",
    computed: {
        ...mapState(["errors"]),
        ...mapState("product", {
            product: state => state.product
        })
    },
    methods: {
        ...mapMutations("product", ["CLEAR_FORM"]),
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
    },
    destroyed() {
        this.CLEAR_FORM();
    }
};
</script>

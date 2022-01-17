<template>
    <main>
        <div class="mb-3">
            <label for="name">Nama Product</label>
            <input
                class="form-control"
                type="text"
                name="name"
                id="name"
                placeholder="Product name"
                v-model="product.name"
                :disabled="authenticated.position_id == 8"
                required
            />
        </div>
        <div class="mb-3">
            <label for="price">Harga Product</label>
            <input
                class="form-control"
                type="number"
                name="price"
                id="price"
                placeholder="Product price"
                v-model="product.price"
                :disabled="authenticated.position_id == 8"
                required
            />
        </div>
        <div class="mb-3">
            <label for="weight">Berat Product (Gram)</label>
            <input
                class="form-control"
                type="number"
                name="weight"
                id="weight"
                placeholder="Product weight"
                v-model="product.weight"
                :disabled="authenticated.position_id == 8"
                required
            />
        </div>
        <div class="mb-3">
            <label for="stock">Stock</label>
            <input
                class="form-control"
                type="number"
                name="stock"
                id="stock"
                placeholder="Product stock"
                v-model="product.stock"
                required
            />
        </div>
        <div class="mb-3">
            <label for="tipe_pembelian">Tipe Pembelian</label>
            <select
                id="tipe_pembelian"
                class="form-control"
                required
                v-model="product.type_pembelian"
                :disabled="authenticated.position_id == 8"
            >
                <option selected="" value="" disabled="">Silahkan Pilih</option>
                <option value="0">Ecer</option>
                <option value="1">Paket Komplit</option>
                <option value="2">Paket Hemat</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipe_product">Tipe Product</label>
            <select
                class="form-control"
                id="tipe_product"
                required
                v-model="product.type_product"
                :disabled="authenticated.position_id == 8"
            >
                <option selected="" value="" disabled="">Silahkan Pilih</option>
                <option value="0">BPOM</option>
                <option value="1">Farma</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="origin_order">Origin Order</label>
            <select
                class="form-control"
                id="origin_order"
                required
                v-model="product.origin_order"
                :disabled="authenticated.position_id == 8"
            >
                <option selected="" value="" disabled="">Silahkan Pilih</option>
                <option value="Shopee">Shopee</option>
                <option value="Lazada">Lazada</option>
                <option value="Iklan">Iklan</option>
            </select>
        </div>
    </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    data() {
        return {
        };
    },

    name: "FormProduct",
    computed: {
        ...mapState(["errors"]),
        ...mapState("product", {
            product: state => state.product
        }),
        ...mapState("user", {
            authenticated: state => state.authenticated
        })
    },
    methods: {
        ...mapMutations("product", ["CLEAR_FORM"]),
         destroyed() {
            this.CLEAR_FORM()
        }
    }
};
</script>

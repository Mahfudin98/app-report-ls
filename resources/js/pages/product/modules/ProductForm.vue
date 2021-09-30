<template>
    <div class="col-lg-4">
        <h3 class="media-sidebar__title">Add Product</h3>
        <div class="media-sidebar">
            <div class="main-content new-page-content">
                <label>
                    <span class="new-page-label">Nama Produk</span>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Product name"
                        v-model="product.name"
                    />
                </label>
                <label>
                    <span class="new-page-label">Type Pembelian</span>
                    <select
                        class="select transparent-btn"
                        required=""
                        v-model="product.type_pembelian"
                    >
                        <option selected="" value="" disabled=""
                            >Silahkan Pilih</option
                        >
                        <option value="0">Ecer</option>
                        <option value="1">Paket Komplit</option>
                        <option value="2">Paket Hemat</option>
                    </select>
                </label>
                <br />
                <label>
                    <span class="new-page-label">Type Product</span>
                    <select
                        class="select transparent-btn"
                        required=""
                        v-model="product.type_product"
                    >
                        <option selected="" value="" disabled=""
                            >Silahkan Pilih</option
                        >
                        <option value="0">BPOM</option>
                        <option value="1">Farma</option>
                    </select>
                </label>
                <br />
                <button
                    class="primary-default-btn"
                    type="submit"
                    @click.prevent="submit"
                >
                    <lord-icon
                        src="https://cdn.lordicon.com/mecwbjnp.json"
                        trigger="loop-on-hover"
                        colors="primary:#ffffff,secondary:#fad1e6"
                        style="width:30px;height:30px"
                    >
                    </lord-icon>
                    Add new
                </button>
            </div>
        </div>
    </div>
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

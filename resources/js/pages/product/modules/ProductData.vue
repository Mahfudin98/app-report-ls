<template>
<div class="row">
    <product-add />
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <div class="row xs-gap">
                <div class="col-12">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" placeholder="Search…" aria-label="Search" v-model="search">
                        <button class="btn" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search align-middle">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-long" v-b-modal.addModal>
                <span class="material-icons align-middle">
                    add_circle_outline
                </span>
                <span class="align-middle">Add Product</span>
            </button>
        </div>
        <br />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <b-table :items="products.data" :fields="fields" show-empty>
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(type_pembelian)="row">
                            <span v-html="row.item.type_pembelian_label"></span>
                        </template>
                        <template #cell(type_product)="row">
                            <span v-html="row.item.type_product_label"></span>
                        </template>
                        <template #cell(price)="row">
                            Rp. {{ row.item.price | formatNumber }}
                        </template>
                        <template #cell(action)="row">
                            <b-dropdown id="dropdown-1" text="Action" variant="primary" class="m-md-2">
                                <b-dropdown-item>
                                    <router-link class="nav-link" :to="{name: 'product.edit', params: { id: row.item.id }}">
                                        <span class="material-icons align-middle">
                                            edit
                                        </span>
                                        <span class="align-middle">Edit</span>
                                    </router-link>
                                </b-dropdown-item>
                                <b-dropdown-item>
                                    <a class="nav-link" @click="deleteProduct(row.item.id)">
                                        <span class="material-icons align-middle">
                                            delete
                                        </span>
                                        <span class="align-middle">Hapus</span>
                                    </a>
                                </b-dropdown-item>
                            </b-dropdown>
                        </template>
                    </b-table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <p v-if="products.data">
                            <span class="material-icons align-middle">
                                menu
                            </span>
                            <span class="align-middle">
                                {{ products.data.length }} item dari
                                {{ products.meta.total }} total data
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <b-pagination v-model="page" :total-rows="products.meta.total" :per-page="products.meta.per_page" aria-controls="products" v-if="products.data && products.data.length > 0"></b-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState
} from "vuex";
import ProductAdd from "./ProductAdd.vue";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: {
        ProductAdd,
        VueMomentsAgo
    },
    created() {
        this.getProducts();
    },

    data() {
        return {
            search: "",
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "name",
                    label: "Name"
                },
                {
                    key: "type_pembelian",
                    label: "Type Pembelian"
                },
                {
                    key: "type_product",
                    label: "Type Product"
                },
                {
                    key: "price",
                    label: "Harga"
                },
                {
                    key: "weight",
                    label: "Berat (Gram)"
                },
                {
                    key: "stock",
                    label: "Stock"
                },
                {
                    key: "action",
                    label: "Aksi"
                }
            ]
        };
    },

    computed: {
        ...mapState("product", {
            products: state => state.products
        }),
        page: {
            get() {
                return this.$store.state.product.page;
            },
            set(val) {
                this.$store.commit("product/SET_PAGE", val);
            }
        }
    },

    watch: {
        page() {
            this.getProducts();
        },
        search() {
            this.getProducts(this.search);
        }
    },

    methods: {
        ...mapActions("product", ["getProducts", "removeProduct"]),
        deleteProduct(id) {
            this.$swal
                .fire({
                    title: "Kamu Yakin?",
                    text: "Tindakan ini akan menghapus secara permanent!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                })
                .then(result => {
                    if (result.isConfirmed) {
                        this.removeProduct(id);
                        this.$swal(
                            "Terhapus!",
                            "Produk sudah dihapus.",
                            "success"
                        );
                    }
                });
        }
    }
};
</script>

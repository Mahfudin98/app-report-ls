<template>
    <main>
        <product-add />
        <div class="rui-page-content">
            <div class="container-fluid">
                <div
                    class="d-flex justify-content-between align-items-center mb-20"
                >
                    <div class="row xs-gap">
                        <div class="col-12">
                            <div class="input-group">
                                <button
                                    type="button"
                                    class="btn btn-clean btn-uniform btn-grey-5"
                                    data-toggle="button"
                                    aria-pressed="false"
                                >
                                    <span
                                        style="font-size: 17px;"
                                        class="rui-icon fas fa-search"
                                    ></span>
                                </button>
                                <input
                                    type="search"
                                    class="form-control form-control-clean"
                                    placeholder="Type to search..."
                                    data-toggle="input"
                                    autocomplete="off"
                                    v-model="search"
                                />
                            </div>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="btn btn-brand btn-long"
                        v-b-modal.addModal
                    >
                        <span class="icon"
                            ><span class="rui-icon fas fa-plus"></span></span
                        ><span class="text">Add Product</span>
                    </button>
                </div>
                <div class="table-responsive">
                    <b-table
                        :items="products.data"
                        :fields="fields"
                        hover
                    >
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
                            <div class="btn-group dropdown dropdown-triangle">
                                <button
                                    class="btn btn-brand btn-long dropdown-toggle"
                                    type="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <span class="text">Action</span>
                                    <span class="icon">
                                        <span class="fas fa-angle-down"></span>
                                    </span>
                                </button>
                                <ul class="dropdown-menu nav">
                                    <li>
                                        <router-link
                                            class="nav-link"
                                            :to="{
                                                name: 'product.edit',
                                                params: { id: row.item.id }
                                            }"
                                        >
                                            <span
                                                data-feather="plus-circle"
                                                class="fas fa-edit"
                                            ></span
                                            ><span>Edit</span
                                            ><span
                                                class="rui-nav-circle"
                                            ></span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <a
                                            class="nav-link"
                                            @click="deleteProduct(row.item.id)"
                                        >
                                            <span
                                                data-feather="x-circle"
                                                class="fas fa-trash"
                                            ></span>
                                            <span>Delete</span>
                                            <span class="rui-nav-circle"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </template>
                    </b-table>

                    <div class="row">
                        <div class="col-md-6">
                            <p v-if="products.data">
                                <i class="fa fa-bars"></i>
                                {{ products.data.length }} item dari
                                {{ products.meta.total }} total data
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                                <b-pagination
                                    v-model="page"
                                    :total-rows="products.meta.total"
                                    :per-page="products.meta.per_page"
                                    aria-controls="products"
                                    v-if="
                                        products.data &&
                                            products.data.length > 0
                                    "
                                ></b-pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { mapActions, mapState } from "vuex";
import ProductAdd from "./ProductAdd.vue";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { ProductAdd, VueMomentsAgo },
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
            this.$swal.fire({
                title: "Kamu Yakin?",
                text: "Tindakan ini akan menghapus secara permanent!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
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

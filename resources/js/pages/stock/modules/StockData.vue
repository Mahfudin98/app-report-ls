<template>
    <main>
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
                </div>
                <div class="table-responsive">
                    <b-table
                        :items="products.data"
                        :fields="fields"
                        show-empty
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
                        <template #cell(stock)="row">
                            <p v-if="show"> {{ row.item.stock }} </p>
                            <div class="form-group" v-else>
                                <label for="stock">Edit Stock</label>
                                <input class="form-control" id="stock" type="text" name="stock" v-model="product.stock">
                            </div>
                        </template>
                        <template #cell(action)>
                            <div class="btn-group dropdown dropdown-triangle">
                                <button
                                    class="btn btn-brand btn-long dropdown-toggle"
                                    type="button"
                                    @click="show = !show"
                                >
                                    <span class="text">Edit</span>
                                    <span class="icon">
                                        <span class="fas fa-edit"></span>
                                    </span>
                                </button>
                            </div>
                        </template>
                    </b-table>
                </div>
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
                                v-if="products.data && products.data.length > 0"
                            ></b-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { mapActions, mapState } from "vuex";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { VueMomentsAgo },
    created() {
        this.getProducts();
    },

    data() {
        return {
            show : true,
            search: "",
            fields: [
                { key: "index", label: "#" },
                { key: "name", label: "Name" },
                { key: "type_pembelian", label: "Type Pembelian" },
                { key: "type_product", label: "Type Product" },
                { key: "price", label: "Harga" },
                { key: "stock", label: "Stock" },
                { key: "action", label: "Aksi" }
            ],
            product: {
                stock: ''
            }
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
    }
};
</script>

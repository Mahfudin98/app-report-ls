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
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-search rui-icon rui-icon-stroke-1_5"
                                    >
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line
                                            x1="21"
                                            y1="21"
                                            x2="16.65"
                                            y2="16.65"
                                        ></line>
                                    </svg>
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
                        class="btn btn-brand"
                        data-toggle="modal"
                        data-target="#addModal"
                    >
                        <span class="icon"
                            ><svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-plus rui-icon rui-icon-stroke-1_5"
                            >
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line
                                    x1="5"
                                    y1="12"
                                    x2="19"
                                    y2="12"
                                ></line></svg
                        ></span>
                        <span class="text">Add Product</span>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr class="users-table-info">
                                <th scope="col">Name</th>
                                <th scope="col">Type Pembelian</th>
                                <th scope="col">Type Product</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class=""
                                v-for="row in products.data"
                                :key="row.created_at"
                            >
                                <td>
                                    {{ row.name }}
                                </td>
                                <td>
                                    <p v-html="row.type_pembelian_label"></p>
                                </td>
                                <td>
                                    <p v-html="row.type_product_label"></p>
                                </td>
                                <td>
                                    {{ row.stock }}
                                </td>
                                <td>
                                    <vue-moments-ago
                                        prefix="posted"
                                        suffix="ago"
                                        :date="row.created_at"
                                        lang="en"
                                    />
                                </td>
                                <td>
                                    <div
                                        class="btn-group dropdown dropdown-triangle"
                                    >
                                        <button
                                            class="btn btn-brand btn-long dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <span class="text">Action</span>
                                            <span class="icon">
                                                <span
                                                    class="fas fa-angle-down"
                                                ></span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu nav">
                                            <li>
                                                <a class="nav-link" href="#"
                                                    ><span
                                                        data-feather="plus-circle"
                                                        class="fas fa-edit"
                                                    ></span
                                                    ><span>Edit</span
                                                    ><span
                                                        class="rui-nav-circle"
                                                    ></span
                                                ></a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#"
                                                    ><span
                                                        data-feather="x-circle"
                                                        class="fas fa-trash"
                                                    ></span
                                                    ><span>Delete</span
                                                    ><span
                                                        class="rui-nav-circle"
                                                    ></span
                                                ></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="products.data == 0">
                                <td class="text-center" colspan="6"><h5>Data tidak ditemukan</h5></td>
                            </tr>
                        </tbody>
                    </table>
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
            search: ""
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

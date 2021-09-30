<template>
    <div class="media-content">
        <div class="row">
            <product-form />
            <div class="col-lg-8">
                <div class="sort-bar media-bar">
                    <div class="sort-bar-start">
                        <div class="search-wrapper">
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
                                class="feather feather-search"
                                aria-hidden="true"
                            >
                                <circle cx="11" cy="11" r="8"></circle>
                                <line
                                    x1="21"
                                    y1="21"
                                    x2="16.65"
                                    y2="16.65"
                                ></line>
                            </svg>
                            <input type="text" placeholder="Search" />
                        </div>
                    </div>
                    <div class="sort-bar-end">
                        <button class="primary-default-btn" type="button">
                            Cari
                        </button>
                    </div>
                </div>
                <div class="users-table table-wrapper">
                    <table class="library-table">
                        <thead>
                            <tr class="users-table-info">
                                <th>Name</th>
                                <th>Type Pembelian</th>
                                <th>Type Product</th>
                                <th>Stock</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="" v-for="row in products.data" :key="row.created_at">
                                <td>
                                    <div class="library-table-name">
                                        {{row.name}}
                                    </div>
                                </td>
                                <td>
                                    <div class="library-table-name">
                                        <span class="badge-active">{{row.type_pembelian}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="library-table-name">
                                        <span class="badge-active">{{row.type_product}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="library-table-name">
                                        {{row.stock}}
                                    </div>
                                </td>
                                <td><vue-moments-ago prefix="posted" suffix="ago" :date="row.created_at" lang="en" /></td>
                                <td>
                                    <span class="p-relative">
                                        <button
                                            class="dropdown-btn transparent-btn"
                                            type="button"
                                            title="More info"
                                        >
                                            <div class="sr-only">More info</div>
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
                                                class="feather feather-more-horizontal"
                                                aria-hidden="true"
                                            >
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="1"
                                                ></circle>
                                                <circle
                                                    cx="19"
                                                    cy="12"
                                                    r="1"
                                                ></circle>
                                                <circle
                                                    cx="5"
                                                    cy="12"
                                                    r="1"
                                                ></circle>
                                            </svg>
                                        </button>
                                        <ul
                                            class="users-item-dropdown dropdown"
                                        >
                                            <li><a href="##">Edit</a></li>
                                            <li>
                                                <a href="##">Quick edit</a>
                                            </li>
                                            <li><a href="##">Trash</a></li>
                                        </ul>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from "vuex";
import ProductForm from "./ProductForm.vue";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { ProductForm, VueMomentsAgo },
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

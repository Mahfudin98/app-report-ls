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
                        striped
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
                        <template #cell(action)>
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
                                        <a class="nav-link" href="#"
                                            ><span
                                                data-feather="plus-circle"
                                                class="fas fa-edit"
                                            ></span
                                            ><span>Edit</span
                                            ><span class="rui-nav-circle"></span
                                        ></a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#"
                                            ><span
                                                data-feather="x-circle"
                                                class="fas fa-trash"
                                            ></span
                                            ><span>Delete</span
                                            ><span class="rui-nav-circle"></span
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                        </template>
                    </b-table>
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

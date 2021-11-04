<template>
    <div class="rui-page-content">
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <router-link
                    :to="{
                        name: 'report.data.date',
                        params: { date: orders.date }
                    }"
                    class="btn btn-secondary"
                >
                    <span class="icon">
                        <span class="fas fa-arrow-alt-circle-left"></span>
                    </span>
                    <span class="text">Back</span>
                </router-link>
                <button @click="submit" class="btn btn-brand">
                    <span class="icon">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Save</span>
                </button>
            </div>
            <!-- form -->
            <div class="rui-snippet-preview demo">
                <form action="">
                    <div class="row vertical-gap sm-gap justify-content-center">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body mnt-6 mnb-6">
                                    <h5 class="card-title h2">Order</h5>
                                    <section
                                        v-for="(row, index) in order"
                                        :key="index"
                                    >
                                        <div class="form-group">
                                            <label
                                                for="produk"
                                                class="text-white"
                                                >Produk</label
                                            >
                                            <select
                                                id="product"
                                                class="form-control"
                                                v-model="
                                                    orderProduk.product_id[
                                                        index
                                                    ]
                                                "
                                                required
                                            >
                                                <option
                                                    selected
                                                    disabled=""
                                                    value=""
                                                    >Pilih Produk</option
                                                >
                                                <option
                                                    v-for="row in products.data"
                                                    :key="row.id"
                                                    :value="row"
                                                    >{{ row.name }}
                                                    <p
                                                        v-html="
                                                            row.type_pembelian_label
                                                        "
                                                    ></p>
                                                    ({{ row.price }})
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="order"
                                                class="text-white"
                                                >Total Order</label
                                            >
                                            <input
                                                class="form-control"
                                                required
                                                type="number"
                                                placeholder="Jumlah Order Product"
                                                v-model="orderProduk.qty[index]"
                                            />
                                        </div>
                                        <br />
                                        <button
                                            class="btn btn-danger"
                                            type="button"
                                            @click="removeParent(index)"
                                        >
                                            <span class="icon">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text"
                                                >Remove Product</span
                                            >
                                        </button>
                                    </section>
                                </div>
                                <div class="card-footer">
                                    <button
                                        class="btn btn-brand"
                                        type="button"
                                        @click="addProduct"
                                    >
                                        <span class="icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Add Product</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from "vuex";
export default {
    name: "AddProductOrder",
    created() {
        this.getAllProducts();
        this.addProductOrder(this.$route.params.id);
    },
    data() {
        return {
            orderProduk: {
                product_id: [""],
                qty: [""]
            },
            order: []
        };
    },
    computed: {
        ...mapState("product", {
            products: state => state.products
        }),
        ...mapState("csReport", {
            orders: state => state.orderProduct
        }),
        pricesOrder() {
            var result = this.orderProduk.product_id;
            var res = Object.keys(result).map(function(key) {
                return parseInt(result[key].price);
            });
            return res;
        },
        idOrder() {
            var result = this.orderProduk.product_id;
            var res = Object.keys(result).map(function(key) {
                return parseInt(result[key].id);
            });
            return res;
        }
    },
    methods: {
        addProduct: function() {
            this.order.push({
                value: ""
            });
        },
        removeParent(index) {
            (this.orderProduk = {
                product_id: [""],
                qty: [""]
            }),
                this.order.splice(index, 1);
        },
        ...mapActions("product", ["getAllProducts"]),
        ...mapActions("csReport", ["addProductOrder", "submitProductOrder"]),
        submit() {
            let form = new FormData();

            form.append("cs_report_id", this.orders.cs_report_id);
            form.append("order_id", this.orders.id);
            form.append("date", this.orders.date);
            // array order
            for (var i = 0; i < this.orderProduk.qty.length; i++) {
                let qty = this.orderProduk.qty[i];
                let product_id = this.idOrder[i];
                let price = this.pricesOrder[i];
                form.append("qty[" + i + "]", qty);
                form.append("product_id[" + i + "]", product_id);
                form.append("price[" + i + "]", price);
            }

            this.submitProductOrder(form).then(() => {
                (this.orderProduk = {
                    product_id: [""],
                    qty: [""]
                }),
                    this.$swal({
                        background: "#FFFFFF",
                        title: "Ditambah!",
                        text: "Data Berhasil ditambah!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    });
                this.$router.push({ name: "report.data.date", params: {date: this.orders.date} });
            });
        }
    }
};
</script>

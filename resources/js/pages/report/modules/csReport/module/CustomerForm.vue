<template>
    <div class="rui-snippet-preview demo">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="form-group">
                                <label for="customer_name">Customer Name</label>
                                <input
                                    id="customer_name"
                                    class="form-control"
                                    type="text"
                                    name="customer_name"
                                    placeholder="Enter page title"
                                    v-model="customers.customer_name"
                                    required
                                />
                                <p
                                    class="text-danger"
                                    v-if="errors.customer_name"
                                >
                                    {{ errors.customer_name[0] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="customer_phone"
                                    >Customer Phone</label
                                >
                                <input
                                    id="customer_phone"
                                    class="form-control"
                                    type="tel"
                                    name="customer_phone"
                                    placeholder="Enter page title"
                                    v-model="customers.customer_phone"
                                    required
                                />
                                <p
                                    class="text-danger"
                                    v-if="errors.customer_phone"
                                >
                                    {{ errors.customer_phone[0] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="customer_address"
                                    >Customer Address</label
                                >
                                <input
                                    id="customer_address"
                                    class="form-control"
                                    type="text"
                                    name="customer_address"
                                    placeholder="Enter page title"
                                    v-model="customers.customer_address"
                                    required
                                />
                                <p
                                    class="text-danger"
                                    v-if="errors.customer_address"
                                >
                                    {{ errors.customer_address[0] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="waybill">Waybill</label>
                                <input
                                    id="waybill"
                                    class="form-control"
                                    type="text"
                                    name="waybill"
                                    placeholder="Enter page title"
                                    v-model="customers.waybill"
                                    required
                                />
                                <p class="text-danger" v-if="errors.waybill">
                                    {{ errors.waybill[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.image }">
                                <label for="file-input">Image</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    accept="image/*"
                                    @change="uploadImage($event)"
                                    id="file-input"
                                />
                                <p>*Kosongkan jika tidak ingin menambahkan</p>
                                <p class="text-danger" v-if="errors.image">
                                    {{ errors.image[0] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <h5 class="card-title h2">Order</h5>
                            <section v-for="(row, index) in order" :key="index">
                                <div class="form-group">
                                    <label for="produk" class="text-white"
                                        >Produk</label
                                    >
                                    <select
                                        id="product"
                                        class="form-control"
                                        v-model="customers.product_id[index]"
                                        required
                                    >
                                        <option selected disabled="" value=""
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
                                    <label for="order" class="text-white"
                                        >Total Order</label
                                    >
                                    <input
                                        class="form-control"
                                        required
                                        type="number"
                                        placeholder="Jumlah Order Product"
                                        v-model="customers.qty[index]"
                                    />
                                </div>
                                <br />
                                <button
                                    class="btn btn-brand"
                                    type="button"
                                    @click="removeParent(index)"
                                >
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Remove Product</span>
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
</template>
<script>
import { mapState, mapActions, mapMutations } from "vuex";
export default {
    name: "ReportCSForm",
    created() {
        this.getAllProducts();
        this.viewCsReport(this.$route.params.date);
    },
    data() {
        return {
            customers: {
                customer_name: "",
                customer_phone: "",
                customer_address: "",
                waybill: "",
                image: "",
                // for order
                product_id: [""],
                qty: [""]
            },
            order: []
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("csReport", {
            reportcs: state => state.reportcs
        }),
        ...mapState("product", {
            products: state => state.products
        }),
        pricesOrder() {
            var result = this.customers.product_id;
            var res = Object.keys(result).map(function(key) {
                return parseInt(result[key].price);
            });
            return res;
        },
        idOrder() {
            var result = this.customers.product_id;
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
            (this.customers = {
                product_id: [""],
                qty: [""]
            }),
                this.order.splice(index, 1);
        },
        ...mapActions("product", ["getAllProducts"]),
        ...mapActions("csReport", ["viewCsReport", "submitCustomer"]),
        uploadImage(event) {
            this.customers.image = event.target.files[0];
        },
        submit() {
            let form = new FormData();

            form.append("cs_report_id", this.reportcs.id);
            form.append("customer_name", this.customers.customer_name);
            form.append("customer_phone", this.customers.customer_phone);
            form.append("customer_address", this.customers.customer_address);
            form.append("waybill", this.customers.waybill);
            form.append("image", this.customers.image);
            form.append("date", this.$route.params.date);
            // array order
            for (var i = 0; i < this.customers.qty.length; i++) {
                let qty = this.customers.qty[i];
                let product_id = this.idOrder[i];
                let price = this.pricesOrder[i];
                form.append("qty[" + i + "]", qty);
                form.append("product_id[" + i + "]", product_id);
                form.append("price[" + i + "]", price);
            }

            this.submitCustomer(form).then(() => {
                this.customers = {
                    chat: "",
                    transaksi: "",
                    omset: "",
                    date: "",
                    image: "",
                    // for order
                    product_id: [""],
                    total_order: [""]
                };

                this.$swal({
                    background: "#FFFFFF",
                    title: "Ditambah!",
                    text: "Data Berhasil ditambah!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
                window.location.reload();
            });
        }
    }
};
</script>

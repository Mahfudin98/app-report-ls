<template>
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{name: 'report.data.date', params: { date: orders.order.date } }" class="btn btn-secondary">
                    <span class="material-icons align-middle">
                        reply
                    </span>
                    <span class="align-middle">Back</span>
                </router-link>
                <button @click="submit" class="btn btn-primary" :disabled="getOngkir == undefined">
                    <span class="material-icons align-middle">
                        save
                    </span>
                    <span class="align-middle">Save</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title h2">Order</h5>
            <section v-for="(row, index) in order" :key="index">
                <div class="mb-3">
                    <label for="order" class="text-white">Total Order</label>
                    <input class="form-control" required type="number" placeholder="Jumlah Order Product" v-model="orderProduk.qty[index]" />
                </div>
                <div class="mb-3">
                    <label for="produk" class="text-white">Produk</label>
                    <select id="product" class="form-control" v-model="orderProduk.product_id[index]" @click="submitOngkir" required>
                        <option selected disabled="" value="">Pilih Produk</option>
                        <option v-for="row in products.data" :key="row.id" :value="row">
                            {{ row.name }}
                            <p v-html="row.type_pembelian_label"></p>({{ row.price }})
                        </option>
                    </select>
                </div>
                <br />
                <button class="btn btn-danger" type="button" @click="removeParent(index)">
                    <span class="material-icons align-middle">
                        delete
                    </span>
                    <span class="align-middle">Remove Product</span>
                </button>
            </section>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="button" @click="addProduct">
                <span class="material-icons align-middle">
                    add_circle_outline
                </span>
                <span class="align-middle">Add Product</span>
            </button>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState,
    mapMutations
} from "vuex";
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
        ...mapState("ongkir", {
            costs: state => state.costs
        }),
        getOngkir() {
            return this.costs.data
        },
        pricesOrder() {
            var result = this.orderProduk.product_id;
            var res = Object.keys(result).map(function (key) {
                return parseInt(result[key].price);
            });
            return res;
        },
        idOrder() {
            var result = this.orderProduk.product_id;
            var res = Object.keys(result).map(function (key) {
                return parseInt(result[key].id);
            });
            return res;
        },
        weightOrder() {
            var result = this.orderProduk.product_id;
            var res = Object.keys(result).map(function (key) {
                return parseInt(result[key].weight);
            });
            var qtys = this.orderProduk.qty;
            var resQty = Object.keys(qtys).map(function (key) {
                return parseInt(qtys[key]);
            });
            var sum = res.map(function (num, idx) {
                return num * resQty[idx];
            })
            return sum.reduce((acc, item) => acc + item);
        },
        // fitur baru
        biayaCOD() {
            var qty = this.orderProduk.qty;
            var resQty = Object.keys(qty).map(function (key) {
                return parseInt(qty[key]);
            });
            if (this.getOngkir != undefined) {
                const harga = this.pricesOrder.reduce((acc, item) => acc + item) * resQty.reduce((acc, item) => acc + item);
                const biaya = (3 / 100) * (parseInt(harga) + parseInt(this.orders.detail));

                return biaya;
            } else {
                return 0;
            }
        },
        biayaJNT() {
            var qty = this.orderProduk.qty;
            var resQty = Object.keys(qty).map(function (key) {
                return parseInt(qty[key]);
            });
            if (this.getOngkir != undefined) {
                const harga = this.pricesOrder.reduce((acc, item) => acc + item) * resQty.reduce((acc, item) => acc + item);
                const biaya = ((parseInt(harga) + parseInt(this.orders.detail)) * 3) / 100;

                return biaya;
            } else {
                return 0;
            }
        },
        biayaJNE() {
            var qty = this.orderProduk.qty;
            var resQty = Object.keys(qty).map(function (key) {
                return parseInt(qty[key]);
            });
            if (this.getOngkir != undefined) {
                const harga = this.pricesOrder.reduce((acc, item) => acc + item) * resQty.reduce((acc, item) => acc + item);
                const biaya = ((parseInt(harga) + this.getOngkir + parseInt(this.orders.detail)) * 3) / 100;

                return biaya;
            } else {
                return 0;
            }
        },
        getTotal() {
            const harga = this.pricesOrder.reduce((acc, item) => acc + item);
            if (this.orders.order.metode == 1) {
                if (this.getOngkir != undefined) {
                    if (this.orders.order.courier === 'jne') {
                        const total = this.getOngkir + parseInt(harga) + this.biayaJNE + parseInt(this.orders.detail);
                        return total;
                    } else if (this.orders.order.courier === 'j&t') {
                        const total = this.getOngkir + parseInt(harga) + this.biayaJNT + parseInt(this.orders.detail);
                        return total;
                    } else {
                        const total = this.getOngkir + parseInt(harga) + this.biayaCOD + parseInt(this.orders.detail);
                        return total;
                    }
                } else {
                    return 0;
                }
            } else {
                if (this.getOngkir != undefined) {
                    const total = parseInt(harga) + this.getOngkir + parseInt(this.orders.detail);
                    return total;
                } else {
                    return 0;
                }
            }
        }
    },
    methods: {
        addProduct: function () {
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
        ...mapActions("ongkir", ["submitCost"]),
        submitOngkir() {
            let form = new FormData();
            form.append("destination", this.orders.order.district_id);
            form.append("weight", parseInt(this.orders.order.weight) + parseInt(this.weightOrder));
            form.append("courier", this.orders.order.courier);
            this.submitCost(form).then(() => {
                this.costs
            })
        },
        submit() {
            let form = new FormData();
            form.append("ongkir", this.getOngkir);
            form.append("total", this.getTotal);
            form.append("weight", parseInt(this.orders.order.weight) + parseInt(this.weightOrder));

            if (this.orders.order.metode == 1) {
                if (this.orders.order.courier === 'jne') {
                    form.append("biaya", this.biayaJNE);
                } else if (this.orders.order.courier === 'j&t') {
                    form.append("biaya", this.biayaJNT);
                } else {
                    form.append("biaya", this.biayaCOD);
                }
            }

            form.append("cs_report_id", this.orders.order.cs_report_id);
            form.append("order_id", this.orders.order.id);
            form.append("date", this.orders.order.date);
            form.append("status", this.orders.order.status);
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
                this.$router.push({
                    name: "report.data.date",
                    params: {
                        date: this.orders.order.date
                    }
                });
            });
        }
    }
};
</script>

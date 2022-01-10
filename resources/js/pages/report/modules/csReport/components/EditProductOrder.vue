<template>
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{name: 'report.data.date', params: { date: orders.date }}" class="btn btn-secondary">
                    <span class="material-icons align-middle">
                        reply
                    </span>
                    <span class="align-middle">Back</span>
                </router-link>
                <button @click="submit" class="btn btn-primary">
                    <span class="material-icons align-middle">
                        update
                    </span>
                    <span class="align-middle">Update</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <h5 class="card-title h2">Order</h5>
                            <div class="form-group">
                                <label for="produk" class="text-white">Produk</label>
                                <select id="product" class="form-control" v-model="
                                                orderProduk.product_id
                                            " required>
                                    <option selected disabled="" value="">Pilih Produk</option>
                                    <option v-for="row in products.data" :key="row.id" :value="row.id">{{ row.name }}
                                        <p v-html="
                                                        row.type_pembelian_label
                                                    "></p>
                                        ({{ row.price }})
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order" class="text-white">Total Order</label>
                                <input class="form-control" required type="number" placeholder="Jumlah Order Product" v-model="orderProduk.qty" />
                            </div>
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
    mapState,
    mapMutations
} from "vuex";
export default {
    name: "EditProductOrder",
    created() {
        this.getAllProducts();
        this.editProductOrder(this.$route.params.id).then(res => {
            this.orderProduk = {
                product_id: res.product_id,
                qty: res.qty
            };
        });
    },
    data() {
        return {
            orderProduk: {
                product_id: "",
                qty: ""
            }
        };
    },
    computed: {
        ...mapState("product", {
            products: state => state.products
        }),
        ...mapState("csReport", {
            orders: state => state.editOrderProduct
        }),
        pricesOrder() {
            const myArray = this.products.data;
            const id = this.orderProduk.product_id;

            const variableOne = myArray.filter(itemInArray => itemInArray.id === id);
            return variableOne[0].price;
        },
    },
    methods: {
        ...mapActions("product", ["getAllProducts"]),
        ...mapMutations("csReport", ["SET_ID_UPDATE"]),
        ...mapActions("csReport", ["editProductOrder", "updateProductOrder"]),
        submit() {
            let form = new FormData();
            form.append("qty", this.orderProduk.qty);
            form.append("product_id", this.orderProduk.product_id);
            form.append("price", this.pricesOrder);
            this.SET_ID_UPDATE(this.$route.params.id);
            this.updateProductOrder(form).then(() => {
                (this.orderProduk = {
                    product_id: "",
                    qty: ""
                }),
                this.$swal({
                    background: "#FFFFFF",
                    title: "Diupdate!",
                    text: "Data Berhasil diupdate!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
                this.$router.push({
                    name: "report.data.date",
                    params: {
                        date: this.orders.date
                    }
                });
            });
        }
    }
};
</script>

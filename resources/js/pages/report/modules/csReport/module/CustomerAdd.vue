<template>
<b-modal id="addCustomer" title="Add Customers">
    <!-- <customer-form ref="customerForm" /> -->
    <div class="rui-snippet-preview demo">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="form-group">
                                <label for="customer_name">Customer Name</label>
                                <input id="customer_name" class="form-control" type="text" name="customer_name" placeholder="Nama Customer" v-model="customers.customer_name" required />
                                <p>*Nama tidak boleh menggunakan karakter (*/-.\_+=)</p>
                                <p class="text-danger" v-if="errors.customer_name">
                                    {{ errors.customer_name[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="customers.customer_name != ''">
                                <label for="customer_phone">Customer Phone</label>
                                <input id="customer_phone" class="form-control" type="tel" name="customer_phone" placeholder="Nomor HP Customer" v-model="customers.customer_phone" required />
                                <p class="text-danger" v-if="errors.customer_phone">
                                    {{ errors.customer_phone[0] }}
                                </p>
                            </div>
                            <!-- form ongkir disini -->
                            <div class="form-group" v-if="customers.customer_phone != ''">
                                <label for="province">Province</label>
                                <select class="form-control" @change="provinceId($event)" v-model="ongkir.province">
                                    <option selected disabled="" value="">Pilih Provinsi</option>
                                    <option class="py-1" v-for="province in provinces.data" :key="province.id" :value="province.province_id">{{ province.province }}</option>
                                </select>
                                <p class="text-danger" v-if="errors.province">
                                    {{ errors.province[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="ongkir.province != ''">
                                <label for="city">City</label>
                                <select class="form-control" @change="cityId($event)" v-model="ongkir.city">
                                    <option selected disabled="" value="">Pilih City</option>
                                    <option class="py-1" v-for="city in cities.data" :key="city.id" :value="city.city_id">{{ city.city_name }}</option>
                                </select>
                                <p class="text-danger" v-if="errors.city">
                                    {{ errors.city[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="ongkir.city != ''">
                                <label for="district">District</label>
                                <select class="form-control" v-model="ongkir.district">
                                    <option selected disabled="" value="">Pilih District</option>
                                    <option class="py-1" v-for="district in districts.data" :key="district.id" :value="district.subdistrict_id">{{ district.subdistrict_name }}</option>
                                </select>
                                <p class="text-danger" v-if="errors.district">
                                    {{ errors.district[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="ongkir.district != ''">
                                <label for="courier">Courier</label>
                                <select class="form-control" v-model="ongkir.courier">
                                    <option selected disabled="" value="">Pilih Courier</option>
                                    <option value="jne">JNE</Option>
                                    <option value="jnt">J&T</Option>
                                    <option value="ninja">NINJA</Option>
                                    <option value="anteraja">ANTER AJA</Option>
                                </select>
                                <p class="text-danger" v-if="errors.courier">
                                    {{ errors.courier[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="ongkir.courier != ''">
                                <label for="metode">Metode</label>
                                <select class="form-control" v-model="ongkir.metode">
                                    <option selected disabled="" value="">Pilih Metode</option>
                                    <option value="1">COD</Option>
                                    <option value="0">TRANSFER</Option>
                                </select>
                                <p class="text-danger" v-if="errors.metode">
                                    {{ errors.metode[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="ongkir.metode != ''">
                                <label for="ongkir">Ongkir</label>
                                <input class="form-control" type="text" :value="getOngkir != undefined ? getOngkir : 'loading...'" disabled>
                            </div>
                            <div class="form-group" v-if="ongkir.metode == 1">
                                <label for="biaya">Biaya</label>
                                <input class="form-control" v-if="ongkir.courier === 'jne'" type="text" :value="biayaJNE" disabled>
                                <input class="form-control" v-if="ongkir.courier === 'j&t'" type="text" :value="biayaJNT" disabled>
                                <input class="form-control" v-if="ongkir.courier != 'jne' && ongkir.courier != 'j&t'" type="text" :value="biayaCOD" disabled>
                            </div>
                            <div class="form-group" v-if="ongkir.metode != ''">
                                <label for="total">Total</label>
                                <input class="form-control" type="text" :value="getTotal" disabled>
                            </div>
                            <div class="form-group" v-if="ongkir.metode != ''">
                                <label for="ongkir_discount">Potongan Ongkir</label>
                                <input id="ongkir_discount" class="form-control" type="number" name="ongkir_discount" placeholder="Masukan Potongan Ongkir misal : 5000" v-model="customers.ongkir_discount" :disabled="getOngkir == undefined"/>
                                <p>*Biarkan 0 jika tidak ada Potongan</p>
                            </div>
                            <!-- akhir form ongkir -->
                            <div class="form-group" v-if="ongkir.metode != ''">
                                <label for="customer_address">Customer Address</label>
                                <input id="customer_address" class="form-control" type="text" name="customer_address" placeholder="Alamat Customer" v-model="customers.customer_address" required />
                                <p class="text-danger" v-if="errors.customer_address">
                                    {{ errors.customer_address[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="customers.customer_address != ''">
                                <label for="waybill">Waybill</label>
                                <input id="waybill" class="form-control" type="text" name="waybill" placeholder="Waybill" v-model="customers.waybill" required />
                                <p class="text-danger" v-if="errors.waybill">
                                    {{ errors.waybill[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="customers.waybill != ''" :class="{ 'has-error': errors.image }">
                                <label for="file-input">Image</label>
                                <input type="file" class="form-control" accept="image/*" @change="uploadImage($event)" id="file-input" />
                                <p>*Kosongkan jika tidak ingin menambahkan</p>
                                <p class="text-danger" v-if="errors.image">
                                    {{ errors.image[0] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" v-if="customers.waybill != ''">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <h5 class="card-title h2">Order</h5>
                            <section v-for="(row, index) in order" :key="index">
                                <div class="form-group">
                                    <label for="order" class="text-white">Total Order</label>
                                    <input class="form-control" required type="number" placeholder="Jumlah Order Product" v-model="customers.qty[index]" />
                                </div>
                                <div class="form-group">
                                    <label for="produk" class="text-white">Produk</label>
                                    <select id="product" class="form-control" v-model="customers.product_id[index]" @click="submitOngkir" required>
                                        <option selected disabled="" value="">Pilih Produk</option>
                                        <option v-for="row in products.data" :key="row.id" :value="row">{{ row.name }}
                                            <p v-html="
                                                    row.type_pembelian_label
                                                "></p>
                                            ({{ row.price }})
                                        </option>
                                    </select>
                                </div>
                                <br />
                                <button class="btn btn-brand" type="button" @click="removeParent(index)">
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Remove Product</span>
                                </button>
                            </section>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-brand" type="button" @click="addProduct">
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
    <template #modal-footer>
        <div class="w-100">
            <!-- <b-button variant="primary" size="sm" class="float-left" @click="submit" :disabled="checkVal">
                Simpan
            </b-button> -->
            <b-overlay :show="busy" rounded opacity="0.6" spinner-small spinner-variant="primary" class="d-inline-block float-right" @hidden="onHidden">
                <button ref="button" :disabled="busy || checkVal" @click="onClick" class="btn btn-brand">
                    <span class="icon">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Save</span>
                </button>
            </b-overlay>
        </div>
    </template>
</b-modal>
</template>

<script>
import {
    mapState,
    mapActions,
    mapMutations
} from "vuex";
import axios from 'axios';
export default {
    name: "ReportCSForm",
    created() {
        this.getAllProducts();
        this.viewCsReport(this.$route.params.date);
        this.getProvinces();
        this.getCities();
        this.getDistricts();
    },
    data() {
        return {
            customers: {
                customer_name: "",
                customer_phone: "",
                customer_address: "",
                waybill: "",
                image: "",
                ongkir_discount: 0,
                // for order
                product_id: [""],
                qty: [""]
            },
            order: [],
            // ongkir
            ongkir: {
                province: '',
                city: '',
                district: '',
                courier: '',
                metode: '',
            },
            busy: false,
            timeout: null
        };
    },
    beforeDestroy() {
        this.clearTimeout()
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("csReport", {
            reportcs: state => state.reportcs
        }),
        ...mapState("product", {
            products: state => state.products
        }),
        ...mapState("ongkir", {
            provinces: state => state.provinces,
            cities: state => state.cities,
            districts: state => state.districts,
            costs: state => state.costs
        }),
        pricesOrder() {
            var result = this.customers.product_id;
            var res = Object.keys(result).map(function (key) {
                return parseInt(result[key].price);
            });
            return res;
        },
        idOrder() {
            var result = this.customers.product_id;
            var res = Object.keys(result).map(function (key) {
                return parseInt(result[key].id);
            });
            return res;
        },
        weightOrder() {
            var result = this.customers.product_id;
            var res = Object.keys(result).map(function (key) {
                return parseInt(result[key].weight);
            });
            var qtys = this.customers.qty;
            var resQty = Object.keys(qtys).map(function (key) {
                return parseInt(qtys[key]);
            });
            var sum = res.map(function (num, idx) {
                return num * resQty[idx];
            })
            return sum.reduce((acc, item) => acc + item);
        },
        getOngkir() {
            if (this.customers.ongkir_discount != "" && this.customers.ongkir_discount != 0) {
                var total = this.costs.data - parseInt(this.customers.ongkir_discount)
                return total
            } else {
                return this.costs.data
            }
        },
        biayaCOD() {
            var qty = this.customers.qty;
            var resQty = Object.keys(qty).map(function (key) {
                return parseInt(qty[key]);
            });
            if (this.getOngkir != undefined) {
                const harga = this.pricesOrder.reduce((acc, item) => acc + item) * resQty.reduce((acc, item) => acc + item);
                const biaya = (3 / 100) * parseInt(harga);

                return biaya;
            } else {
                return 0;
            }
        },
        biayaJNT() {
            var qty = this.customers.qty;
            var resQty = Object.keys(qty).map(function (key) {
                return parseInt(qty[key]);
            });
            if (this.getOngkir != undefined) {
                const harga = this.pricesOrder.reduce((acc, item) => acc + item) * resQty.reduce((acc, item) => acc + item);
                const biaya = (parseInt(harga) * 3) / 100;

                return biaya;
            } else {
                return 0;
            }
        },
        biayaJNE() {
            var qty = this.customers.qty;
            var resQty = Object.keys(qty).map(function (key) {
                return parseInt(qty[key]);
            });
            if (this.getOngkir != undefined) {
                const harga = this.pricesOrder.reduce((acc, item) => acc + item) * resQty.reduce((acc, item) => acc + item);
                const biaya = ((parseInt(harga) + this.getOngkir) * 3) / 100;

                return biaya;
            } else {
                return 0;
            }
        },
        getTotal() {
            const harga = this.pricesOrder.reduce((acc, item) => acc + item);
            if (this.ongkir.metode == 1) {
                if (this.getOngkir != undefined) {
                    if (this.ongkir.courier === 'jne') {
                        const total = this.getOngkir + parseInt(harga) + this.biayaJNE;
                        return total;
                    } else if (this.ongkir.courier === 'j&t') {
                        const total = this.getOngkir + parseInt(harga) + this.biayaJNT;
                        return total;
                    } else {
                        const total = this.getOngkir + parseInt(harga) + this.biayaCOD;
                        return total;
                    }
                } else {
                    return 0;
                }
            } else {
                if (this.getOngkir != undefined) {
                    const total = parseInt(harga) + this.getOngkir;
                    return total;
                } else {
                    return 0;
                }
            }
        },

        checkVal: function () {
            return this.getOngkir != undefined ? false : true;
        }
    },
    methods: {
        addProduct: function () {
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
        // onchange
        provinceId(event) {
            this.getCities(event.target.value);
        },
        cityId(event) {
            this.getDistricts(event.target.value);
        },
        // end
        ...mapActions("product", ["getAllProducts"]),
        ...mapActions("csReport", ["viewCsReport", "submitCustomer"]),
        ...mapActions("ongkir", ["getProvinces", "getCities", "getDistricts", "submitCost"]),
        uploadImage(event) {
            this.customers.image = event.target.files[0];
        },
        submitOngkir() {
            let form = new FormData();
            form.append("destination", this.ongkir.district);
            form.append("weight", this.weightOrder);
            form.append("courier", this.ongkir.courier);
            this.submitCost(form).then(() => {
                this.costs
            })
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
            form.append("ongkir_discount", this.customers.ongkir_discount);
            // ongkir
            form.append("ongkir", this.getOngkir);
            form.append("metode", this.ongkir.metode);
            form.append("total", this.getTotal);
            form.append("courier", this.ongkir.courier);
            form.append("province", this.ongkir.province);
            form.append("city", this.ongkir.city);
            form.append("district_id", this.ongkir.district);
            form.append("weight", this.weightOrder);

            if (this.ongkir.metode == 1) {
                if (this.ongkir.courier === 'jne') {
                    form.append("biaya", this.biayaJNE);
                } else if (this.ongkir.courier === 'j&t') {
                    form.append("biaya", this.biayaJNT);
                } else {
                    form.append("biaya", this.biayaCOD);
                }
            }

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
                    ongkir_discount: 0,
                    // for order
                    product_id: [""],
                    total_order: [""]
                };

                this.ongkir = {
                    province: '',
                    city: '',
                    district: '',
                    courier: '',
                    metode: '',
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
        },
        // button
        clearTimeout() {
            if (this.timeout) {
                clearTimeout(this.timeout)
                this.timeout = null
            }
        },
        setTimeout(callback) {
            this.clearTimeout()
            this.timeout = setTimeout(() => {
                this.clearTimeout()
                callback()
            }, 10000)
        },
        onHidden() {
            // Return focus to the button once hidden
            this.$refs.button.focus()
        },
        onClick() {
            this.busy = true;
            // Simulate an async request
            this.setTimeout(() => {
                this.busy = false
            });
            this.submit();
        }
    }
};
</script>

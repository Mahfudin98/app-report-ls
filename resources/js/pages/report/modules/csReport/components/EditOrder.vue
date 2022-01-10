<template>
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{ name: 'report.data.date', params: { date: editOrder.order.date } }" class="btn btn-secondary">
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
            <div class="mb-3">
                <label for="customer_name">Customer Name</label>
                <input id="customer_name" class="form-control" type="text" name="customer_name" placeholder="Enter page title" v-model="customers.customer_name" required />
                <p class="text-danger" v-if="errors.customer_name">
                    {{ errors.customer_name[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label for="customer_phone">Customer Phone</label>
                <input id="customer_phone" class="form-control" type="tel" name="customer_phone" placeholder="Enter page title" v-model="customers.customer_phone" required />
                <p class="text-danger" v-if="errors.customer_phone">
                    {{ errors.customer_phone[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label for="customer_address">Customer Address</label>
                <input id="customer_address" class="form-control" type="text" name="customer_address" placeholder="Enter page title" v-model="customers.customer_address" required />
                <p class="text-danger" v-if="errors.customer_address">
                    {{ errors.customer_address[0] }}
                </p>
            </div>
            <!-- form ongkir disini -->
            <div class="mb-3">
                <label for="province">Province</label>
                <select class="form-control" @change="provinceId($event)" v-model="ongkir.province" required>
                    <option selected disabled="" value="">Pilih Provinsi</option>
                    <option class="py-1" v-for="province in provinces.data" :key="province.id" :value="province.province_id">{{ province.province }}</option>
                </select>
                <p class="text-danger" v-if="errors.province">
                    {{ errors.province[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label for="city">City</label>
                <select class="form-control" @change="cityId($event)" v-model="ongkir.city" required>
                    <option selected disabled="" value="">Pilih City</option>
                    <option class="py-1" v-for="city in cities.data" :key="city.id" :value="city.city_id">{{ city.city_name }}</option>
                </select>
                <p class="text-danger" v-if="errors.city">
                    {{ errors.city[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label for="district">District</label>
                <select class="form-control" v-model="ongkir.district" required>
                    <option selected disabled="" value="">Pilih District</option>
                    <option class="py-1" v-for="district in districts.data" :key="district.id" :value="district.subdistrict_id">{{ district.subdistrict_name }}</option>
                </select>
                <p class="text-danger" v-if="errors.district">
                    {{ errors.district[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label for="courier">Courier</label>
                <select class="form-control" v-model="ongkir.courier" @click="submitOngkir" required>
                    <option selected disabled="" value="">Pilih Courier</option>
                    <option value="jne">JNE</Option>
                    <option value="j&t">J&T</Option>
                    <option value="ninja">NINJA</Option>
                    <option value="anteraja">ANTER AJA</Option>
                </select>
                <p class="text-danger" v-if="errors.courier">
                    {{ errors.courier[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label for="metode">Metode</label>
                <select class="form-control" v-model="ongkir.metode" required>
                    <option selected disabled="" value="">Pilih Metode</option>
                    <option value="1">COD</Option>
                    <option value="0">TRANSFER</Option>
                </select>
                <p class="text-danger" v-if="errors.metode">
                    {{ errors.metode[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label for="ongkir">Ongkir</label>
                <input class="form-control" type="text" :value="getOngkir != undefined ? getOngkir : 'loading...'" disabled required>
            </div>
            <div class="mb-3" v-if="ongkir.metode == 1">
                <label for="biaya">Biaya</label>
                <input class="form-control" v-if="ongkir.courier === 'jne'" type="text" :value="biayaJNE" disabled>
                <input class="form-control" v-if="ongkir.courier === 'j&t'" type="text" :value="biayaJNT" disabled>
                <input class="form-control" v-if="ongkir.courier != 'jne' && ongkir.courier != 'j&t'" type="text" :value="biayaCOD" disabled>
            </div>
            <div class="mb-3">
                <label for="total">Total</label>
                <input class="form-control" type="text" :value="getTotal" disabled>
            </div>
            <!-- akhir form ongkir -->
            <div class="mb-3">
                <label for="waybill">Waybill</label>
                <input id="waybill" class="form-control" type="text" name="waybill" placeholder="Enter page title" v-model="customers.waybill" required />
                <p class="text-danger" v-if="errors.waybill">
                    {{ errors.waybill[0] }}
                </p>
            </div>
            <div class="mb-3" :class="{ 'has-error': errors.image }">
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
</template>

<script>
import {
    mapState,
    mapActions,
    mapMutations
} from "vuex";
export default {
    name: "ReportCSEditOrderForm",
    created() {
        this.editOrderCsReport(this.$route.params.id).then(res => {
            this.customers = {
                customer_name: res.order.customer_name,
                customer_phone: res.order.customer_phone,
                customer_address: res.order.customer_address,
                waybill: res.order.waybill,
                image: "",
            };
            this.ongkir = {
                // courier: res.order.courier,
                // province: res.order.prov_id,
                // city: res.order.city_id,
                // district: res.order.district_id,
                metode: res.order.metode
            }
        });

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
            },

            // ongkir
            ongkir: {
                province: '',
                city: '',
                district: '',
                courier: '',
                metode: '',
            }
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("csReport", {
            editOrder: state => state.editOrder
        }),
        ...mapState("ongkir", {
            provinces: state => state.provinces,
            cities: state => state.cities,
            districts: state => state.districts,
            costs: state => state.costs
        }),

        weightOrder() {
            return this.editOrder.order.weight
        },
        getOngkir() {
            return this.costs.data
        },
        biayaCOD() {
            if (this.getOngkir != undefined) {
                const harga = this.editOrder.detail
                const biaya = (3 / 100) * parseInt(harga);

                return biaya;
            } else {
                return 0;
            }
        },
        biayaJNT() {
            if (this.getOngkir != undefined) {
                const harga = this.editOrder.detail
                const biaya = (parseInt(harga) * 3) / 100;

                return biaya;
            } else {
                return 0;
            }
        },
        biayaJNE() {
            if (this.getOngkir != undefined) {
                const harga = this.editOrder.detail
                const biaya = ((parseInt(harga) + this.getOngkir) * 3) / 100;

                return biaya;
            } else {
                return 0;
            }
        },
        getTotal() {
            const harga = this.editOrder.detail
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
        }
    },
    methods: {
        ...mapMutations("csReport", ["SET_ID_UPDATE"]),
        ...mapActions("csReport", ["editOrderCsReport", "updateOrderCsReport"]),
        ...mapActions("ongkir", ["getProvinces", "getCities", "getDistricts", "submitCost"]),
        // onchange
        provinceId(event) {
            this.getCities(event.target.value);
        },
        cityId(event) {
            this.getDistricts(event.target.value);
        },
        // end
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
            form.append("customer_name", this.customers.customer_name);
            form.append("customer_phone", this.customers.customer_phone);
            form.append("customer_address", this.customers.customer_address);
            form.append("waybill", this.customers.waybill);
            form.append("image", this.customers.image);
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
            this.SET_ID_UPDATE(this.$route.params.id);
            this.updateOrderCsReport(form).then(() => {
                this.customers = {
                    customer_name: "",
                    customer_phone: "",
                    customer_address: "",
                    waybill: "",
                    image: "",
                };

                this.$swal({
                    background: "#FFFFFF",
                    title: "Diupdate!",
                    text: "Data Berhasil diupdate!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
                this.$router.push({
                    name: 'report.data.date',
                    params: {
                        date: this.editOrder.order.date
                    }
                });
            });
        }
    }
};
</script>

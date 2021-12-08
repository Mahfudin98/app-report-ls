<template>
<div class="rui-page-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <router-link :to="{ name: 'report.data.date', params: { date: editOrder.date } }" class="btn btn-secondary">
                <span class="icon">
                    <span class="fas fa-arrow-alt-circle-left"></span>
                </span>
                <span class="text">Back</span>
            </router-link>
            <button @click="submit" class="btn btn-brand">
                <span class="icon">
                    <i class="fas fa-sync-alt"></i>
                </span>
                <span class="text">Update</span>
            </button>
        </div>
        <!-- form -->
        <div class="rui-snippet-preview demo">
            <form action="">
                <div class="row vertical-gap sm-gap justify-content-center">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body mnt-6 mnb-6">
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input id="customer_name" class="form-control" type="text" name="customer_name" placeholder="Enter page title" v-model="customers.customer_name" required />
                                    <p class="text-danger" v-if="errors.customer_name">
                                        {{ errors.customer_name[0] }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="customer_phone">Customer Phone</label>
                                    <input id="customer_phone" class="form-control" type="tel" name="customer_phone" placeholder="Enter page title" v-model="customers.customer_phone" required />
                                    <p class="text-danger" v-if="errors.customer_phone">
                                        {{ errors.customer_phone[0] }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="customer_address">Customer Address</label>
                                    <input id="customer_address" class="form-control" type="text" name="customer_address" placeholder="Enter page title" v-model="customers.customer_address" required />
                                    <p class="text-danger" v-if="errors.customer_address">
                                        {{ errors.customer_address[0] }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="waybill">Waybill</label>
                                    <input id="waybill" class="form-control" type="text" name="waybill" placeholder="Enter page title" v-model="customers.waybill" required />
                                    <p class="text-danger" v-if="errors.waybill">
                                        {{ errors.waybill[0] }}
                                    </p>
                                </div>
                                <div class="form-group" :class="{ 'has-error': errors.image }">
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
                </div>
            </form>
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
                customer_name: res.customer_name,
                customer_phone: res.customer_phone,
                customer_address: res.customer_address,
                waybill: res.waybill,
                image: "",
            };
        });
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
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("csReport", {
            editOrder: state => state.editOrder
        }),
    },
    methods: {
        ...mapMutations("csReport", ["SET_ID_UPDATE"]),
        ...mapActions("csReport", ["editOrderCsReport", "updateOrderCsReport"]),
        uploadImage(event) {
            this.customers.image = event.target.files[0];
        },
        submit() {
            let form = new FormData();
            form.append("customer_name", this.customers.customer_name);
            form.append("customer_phone", this.customers.customer_phone);
            form.append("customer_address", this.customers.customer_address);
            form.append("waybill", this.customers.waybill);
            form.append("image", this.customers.image);
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
                this.$router.push({ name: 'report.data.date', params: { date: this.editOrder.date } });
            });
        }
    }
};
</script>

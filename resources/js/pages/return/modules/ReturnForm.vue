<template>
<div class="row vertical-gap sm-gap justify-content-center">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body mnt-6 mnb-6">
                <div class="mb-3">
                    <label for="waybill">Cs Name</label>
                    <input id="cs_name" class="form-control" type="text" name="cs_name" placeholder="Enter page title" :value="orderDetail.user.name" readonly />
                </div>
                <div class="mb-3">
                    <label for="customer_name">Customer Name</label>
                    <input id="customer_name" class="form-control" type="text" name="customer_name" placeholder="Enter page title" :value="orderDetail.order.customer_name" readonly />
                </div>
                <div class="mb-3">
                    <label for="customer_phone">Customer Address</label>
                    <input id="customer_phone" class="form-control" type="text" name="customer_phone" placeholder="Enter page title" :value="orderDetail.order.customer_address" readonly />
                </div>
                <div class="mb-3">
                    <label for="waybill">Waybill</label>
                    <input id="waybill" class="form-control" type="text" name="waybill" placeholder="Enter page title" :value="orderDetail.order.waybill" readonly />
                </div>
                <div class="mb-3">
                    <label for="date-order">Date Order</label>
                    <input id="date-order" class="form-control" type="date" name="date-order" placeholder="Enter page title" :value="orderDetail.order.date" readonly />
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body mnt-6 mnb-6">
                <h5 class="card-title h2">Order</h5>
                <section v-for="(row, index) in orderDetail.order.order_detail" :key="index">
                    <h4>{{ row.product.name }}
                        <b-badge pill variant="primary">{{ row.qty }}</b-badge>
                    </h4>
                </section>
                <div class="mb-3">
                    <label for="date-retur">Date Retur</label>
                    <input type="date" class="form-control" name="date-retur" id="date-retur" required v-model="returns.date">
                    <p class="text-danger" v-if="errors.date">
                        {{ errors.date[0] }}
                    </p>
                </div>
                <div class="mb-3">
                    <label for="alasan">Alasan</label>
                    <textarea name="alasan" class="form-control" id="alasan" cols="30" rows="10" v-model="returns.alasan"></textarea>
                </div>
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
    name: "ReportCSForm",
    created() {
        this.showOrder(this.$route.params.waybill);
    },
    data() {
        return {
            returns: {
                date: "",
                alasan: ""
            }
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("returnOrder", {
            orderDetail: state => state.orderDetail
        }),
    },
    methods: {
        ...mapActions("returnOrder", ["showOrder", "submitReturn"]),
        submit() {
            let form = new FormData();
            form.append("date", this.returns.date);
            form.append("waybill", this.orderDetail.order.waybill)
            form.append("alasan", this.returns.alasan);
            this.submitReturn(form).then(() => {
                this.returns = {
                    date: "",
                    alasan: ""
                };
                this.$swal({
                    background: "#FFFFFF",
                    title: "Ditambah!",
                    text: "Data Berhasil ditambah!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
                this.$router.push({
                    name: "return.data"
                });
            });
        }
    }
};
</script>

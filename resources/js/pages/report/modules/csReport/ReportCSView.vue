<template>
    <main>
        <ReportsCSAdd />
        <customer-add />
        <div class="rui-page-content">
            <div class="container-fluid">
                <div class="row xs-gap" v-if="reportcs == ''">
                    <div class="col-sm-12 text-center">
                        <button data-toggle="modal" data-target="#addReportCS" type="button" class="btn btn-brand btn-long">
                            <span class="icon"
                                ><span
                                    class="fas fa-plus"
                                ></span></span
                            ><span class="text">Add Report CS</span>
                        </button>
                    </div>
                </div>
                <div class="rui-profile row vertical-gap" v-if="reportcs != ''">
                    <div class="col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h3 class="text-center">Order</h3>
                                </div>
                                <div class="rui-profile-numbers">
                                    <div class="row justify-content-center">
                                        <div class="col"></div>
                                        <div class="col-auto">
                                            <div
                                                class="rui-profile-number text-center"
                                            >
                                                <h4
                                                    class="rui-profile-number-title h2"
                                                >
                                                    {{ reportcs.chat }}
                                                </h4>
                                                <small class="text-grey-6"
                                                    >Chat/Lead</small
                                                >
                                            </div>
                                        </div>
                                        <div class="col p-0"></div>
                                        <div class="col-auto">
                                            <div
                                                class="rui-profile-number text-center"
                                            >
                                                <h4
                                                    class="rui-profile-number-title h2"
                                                >
                                                    {{ reportcs.transaksi }}
                                                </h4>
                                                <small class="text-grey-6"
                                                    >Transaksi</small
                                                >
                                            </div>
                                        </div>
                                        <div class="col p-0"></div>
                                        <div class="col-auto">
                                            <div
                                                class="rui-profile-number text-center"
                                            >
                                                <h4
                                                    class="rui-profile-number-title h2"
                                                >
                                                    419
                                                </h4>
                                                <small class="text-grey-6"
                                                    >Omset</small
                                                >
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h2 class="card-title mnb-6 mr-auto">
                                        Current tasks
                                    </h2>
                                    <button
                                        data-toggle="modal"
                                        data-target="#addCustomer"
                                        class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8"
                                        type="button"
                                    >
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
                                            class="feather feather-plus rui-icon rui-icon-stroke-1_5"
                                        >
                                            <line
                                                x1="12"
                                                y1="5"
                                                x2="12"
                                                y2="19"
                                            ></line>
                                            <line
                                                x1="5"
                                                y1="12"
                                                x2="19"
                                                y2="12"
                                            ></line>
                                        </svg>
                                    </button>
                                </div>
                                <div
                                    class="accordion list-group list-group-flush rui-profile-task-list"
                                    id="accordionExample"
                                >
                                    <div
                                        class="accordion-group"
                                        v-for="(row, index) in reportcs.order"
                                        :key="index"
                                    >
                                        <a
                                            class="collapse-link collapsed"
                                            :href="
                                                '#' +
                                                    row.customer_name.replace(/\s/g, '') +
                                                    row.waybill
                                            "
                                            id="headingTwo"
                                            data-toggle="collapse"
                                            aria-expanded="false"
                                            :aria-controls="
                                                row.customer_name.replace(/\s/g, '') + row.waybill
                                            "
                                        >
                                            {{ row.customer_name }} [<span
                                                class="text-brand"
                                                >{{ row.waybill }}</span
                                            >]
                                        </a>
                                        <div
                                            :id="
                                                row.customer_name.replace(/\s/g, '') + row.waybill
                                            "
                                            class="collapse"
                                            aria-labelledby="headingTwo"
                                            data-parent="#accordionExample"
                                        >
                                            <div class="collapse-content">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">
                                                                    #
                                                                </th>
                                                                <th scope="col">
                                                                    Product Name
                                                                </th>
                                                                <th scope="col">
                                                                    Price
                                                                </th>
                                                                <th scope="col">
                                                                    QTY
                                                                </th>
                                                                <th scope="col">
                                                                    Total
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                v-for="(rows,
                                                                indexs) in row.order_detail"
                                                                :key="indexs"
                                                            >
                                                                <th scope="row">
                                                                    {{
                                                                        indexs +
                                                                            1
                                                                    }}
                                                                </th>
                                                                <td>
                                                                    {{
                                                                        rows
                                                                            .product
                                                                            .name
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        rows.price
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        rows.qty
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        rows.qty *
                                                                            rows.price
                                                                    }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { mapActions, mapState } from "vuex";
import CustomerAdd from "./module/CustomerAdd.vue";
import ReportsCSAdd from "./module/ReportCSAdd.vue";
export default {
    components: { CustomerAdd, ReportsCSAdd },
    name: "ViewReportsCS",
    created() {
        this.viewCsReport(this.$route.params.date);
    },
    computed: {
        ...mapState("csReport", {
            reportcs: state => state.reportcs
        }),
        getPrice() {
            for (let i = 0; i < this.reportcs.length; i++) {
                var results = this.getChildren(i);
                var res = Object.keys(results).map(function(key) {
                    var harga = results[key].product_id["id"];
                    var total = results[key].total_order;
                    return harga;
                });

                return results;
            }
        }
    },
    methods: {
        ...mapActions("csReport", ["viewCsReport"])
    }
};
</script>

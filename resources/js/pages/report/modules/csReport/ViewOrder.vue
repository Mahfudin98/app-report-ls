<template>
<div class="row">
    <page-loader />
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{ name: 'cs.report.data' }" class="btn btn-secondary">
                    <span class="material-icons align-middle">
                        reply
                    </span>
                    <span class="align-middle">Back</span>
                </router-link>
                <div class="row xs-gap">
                    <div class="col-12">
                        <div class="input-group">
                            <date-picker v-model="search" placeholder="Pilih range tanggal" range></date-picker>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <b-table :items="filterItem" :fields="fields" show-empty>
                    <template #cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template #cell(waybill)="data">
                        <h6 class="badge bg-primary rounded-pill">
                            {{ data.item.waybill }}
                        </h6>
                    </template>
                    <template #cell(view)="data">
                        <button @click="data.toggleDetails" class="btn btn-primary btn-long btn-round">
                            <span class="material-icons align-middle">
                                visibility
                            </span>
                            <span class="align-middle">View Detail</span>
                        </button>
                    </template>
                    <template #row-details="row">
                        <b-card>
                            <h4>
                                Status Order :
                                <span v-html="row.item.status_label"></span>
                            </h4>
                            <b-table :items="row.item.order_detail" :fields="details" borderless>
                                <template #cell(produk)="data">
                                    {{ data.item.product.name }}
                                </template>
                                <template #cell(price)="rows">
                                    Rp. {{ rows.item.price | formatNumber }}
                                </template>
                                <template #cell(subtotal)="rows">
                                    Rp.
                                    {{ rows.item.subtotal | formatNumber }}
                                </template>
                            </b-table>
                        </b-card>
                    </template>
                </b-table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <p v-if="viewOrder.data">
                        <span class="material-icons align-middle">
                            menu
                        </span>
                        <span class="align-middle">
                            {{ viewOrder.data.length }} item dari
                            {{ viewOrder.meta.total }} total data
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        <b-pagination v-model="page" :total-rows="viewOrder.meta.total" :per-page="viewOrder.meta.per_page" aria-controls="viewOrder" v-if="viewOrder.data && viewOrder.data.length > 0"></b-pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import PageLoader from "../../../../components/PageLoader.vue";
import {
    mapActions,
    mapState
} from "vuex";
import DatePicker from "vue2-datepicker";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: {
        VueMomentsAgo,
        DatePicker,
        PageLoader
    },
    name: "ViewOrder",

    created() {
        this.viewOrderCS({
            view: this.$route.params.id
        });
    },

    data() {
        return {
            view: '',
            search: {},
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "waybill",
                    label: "Waybill"
                },
                {
                    key: "customer_name",
                    label: "Customer Name"
                },
                {
                    key: "customer_phone",
                    label: "Customer Phone"
                },
                {
                    key: "customer_address",
                    label: "customer Address"
                },
                {
                    key: "date",
                    label: "Date",
                    sortable: true
                },
                {
                    key: "view",
                    label: "View Detail"
                }
            ],
            details: [{
                    key: "produk",
                    label: "Nama Produk"
                },
                {
                    key: "price",
                    label: "Harga"
                },
                {
                    key: "qty",
                    label: "Jumlah"
                },
                {
                    key: "subtotal",
                    label: "Subtotal"
                }
            ]
        };
    },

    computed: {
        ...mapState("csReport", {
            viewOrder: state => state.viewOrder
        }),
        filterItem() {
            let startDate = this.convert(this.search[0]);
            let endDate = this.convert(this.search[1]);

            const itemList = this.viewOrder.data;
            if (startDate != "NaN-aN-aN" && this.search[0] != null) {
                return itemList.filter(item => {
                    const itemDate = item.date;
                    if (startDate && endDate) {
                        return startDate <= itemDate && itemDate <= endDate;
                    }
                    if (startDate && !endDate) {
                        return startDate <= itemDate;
                    }
                    if (!startDate && endDate) {
                        return itemDate <= endDate;
                    }
                    return true;
                });
            } else {
                return itemList;
            }
        },

        page: {
            get() {
                return this.$store.state.csReport.page;
            },
            set(val) {
                this.$store.commit("csReport/SET_PAGE", val);
            }
        }
    },

    watch: {
        page() {
            this.viewOrderCS({
                view: this.$route.params.id
            });
        },

        view() {
            this.viewOrderCS({
                view: this.$route.params.id
            });
        }
    },

    methods: {
        convert(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        },
        ...mapActions("csReport", ["viewOrderCS"]),
        formatDate(date) {
            return new Intl.DateTimeFormat("en-US", {
                dateStyle: "long"
            }).format(new Date(date));
        }
    }
};
</script>

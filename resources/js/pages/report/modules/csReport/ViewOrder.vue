<template>
    <main>
        <page-loader />
        <div class="rui-page-content">
            <div class="container-fluid">
                <div
                    class="d-flex justify-content-between align-items-center mb-20"
                >
                    <router-link
                        :to="{ name: 'cs.report.data' }"
                        class="btn btn-secondary"
                    >
                        <span class="icon">
                            <span class="fas fa-arrow-alt-circle-left"></span>
                        </span>
                        <span class="text">Back</span>
                    </router-link>
                    <div class="row xs-gap">
                        <div class="col-12">
                            <div class="input-group">
                                <date-picker
                                    v-model="search"
                                    placeholder="Pilih range tanggal"
                                    range
                                ></date-picker>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <b-table :items="filterItem" :fields="fields">
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(waybill)="data">
                            <h6 class="badge badge-brand">
                                {{ data.item.waybill }}
                            </h6>
                        </template>
                        <template #cell(view)="data">
                            <button
                                @click="data.toggleDetails"
                                class="btn btn-brand btn-long btn-round"
                            >
                                <span class="icon">
                                    <span
                                        data-feather="check"
                                        class="fas fa-eye"
                                    ></span
                                ></span>
                                <span class="text">
                                    {{ data.detailsShowing ? "Hide" : "Show" }}
                                    Detail
                                </span>
                            </button>
                        </template>
                        <template #row-details="row">
                            <b-card>
                                <h4>
                                    Status Order :
                                    <span v-html="row.item.status_label"></span>
                                </h4>
                                <b-table
                                    :items="row.item.order_detail"
                                    :fields="details"
                                    borderless
                                >
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
        </div>
    </main>
</template>
<script>
import PageLoader from "../../../../components/PageLoader.vue";
import { mapActions, mapState } from "vuex";
import DatePicker from "vue2-datepicker";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { VueMomentsAgo, DatePicker, PageLoader },
    name: "ViewOrder",

    created() {
        this.viewOrderCS(this.$route.params.id);
    },

    data() {
        return {
            search: {},
            fields: [
                { key: "index", label: "#" },
                { key: "waybill", label: "Waybill" },
                { key: "customer_name", label: "Customer Name" },
                { key: "customer_phone", label: "Customer Phone" },
                { key: "customer_address", label: "customer Address" },
                { key: "date", label: "Date", sortable: true },
                { key: "view", label: "View Detail" }
            ],
            details: [
                { key: "produk", label: "Nama Produk" },
                { key: "price", label: "Harga" },
                { key: "qty", label: "Jumlah" },
                { key: "subtotal", label: "Subtotal" }
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

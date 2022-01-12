<template>
<main>
    <page-loader />
    <div class="rui-page-content">
        <!-- for adv -->
        <div class="card" v-if="$can('create reports adv')">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <router-link :to="{ name: 'adv.report.data' }" class="btn btn-secondary">
                        <span class="material-icons align-middle">
                            reply
                        </span>
                        <span class="align-middle">Back</span>
                    </router-link>
                </div>
            </div>
            <div clas="card-body">
                <div class="table-responsive">
                    <b-table :items="view" :fields="fields" show-empty>
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>

                        <template #cell(view)="data">
                            <button @click="data.toggleDetails" class="btn btn-brand btn-long btn-round">
                                <span class="material-icons align-middle">
                                    visibility
                                </span>
                                <span class="align-middle">View Detail</span>
                            </button>
                        </template>
                        <template #row-details="row">
                            <b-card>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="title-text">
                                                    Deskripsi Report
                                                </h4>
                                                <p v-if="row.item.description != null" v-html="row.item.description"></p>
                                                <p v-if="row.item.description == null">
                                                    <i>Tidak Ada Deskripsi!</i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <b-table :items="row.item.order" :fields="det" show-empty>
                                                        <template #cell(status)="data">
                                                            <p v-html="data.item.status_label"></p>
                                                        </template>
                                                        <template #cell(action)="data">
                                                            <button @click="info(data.item, data.item.waybill, $event.target)" class="btn btn-primary btn-long btn-round">
                                                                <span class="material-icons align-middle">
                                                                    visibility
                                                                </span>
                                                            </button>
                                                        </template>
                                                    </b-table>
                                                    <b-modal :id="infoModal.id" :title="infoModal.title" size="lg" ok-only @hide="resetInfoModal">
                                                        <div class="table-responsive">
                                                            <b-table :items="infoModal.content.order_detail" :fields="modtab" show-empty>
                                                                <template #cell(index)="data">
                                                                    {{data.index + 1}}
                                                                </template>
                                                                <template #cell(price)="data">
                                                                    Rp. {{data.item.price | formatNumber}}
                                                                </template>
                                                                <template #cell(subtotal)="data">
                                                                    Rp. {{data.item.subtotal | formatNumber}}
                                                                </template>
                                                            </b-table>
                                                        </div>
                                                    </b-modal>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-card>
                        </template>
                    </b-table>
                </div>
            </div>
        </div>
        <!-- for manager -->
        <div class="card" v-if="$can('read projects')">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <router-link :to="{ name: 'adv.report.show', params: { id: $route.params.id } }" class="btn btn-secondary">
                        <span class="material-icons align-middle">
                            reply
                        </span>
                        <span class="align-middle">Back</span>
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <b-table :items="viewManage" :fields="fields" show-empty>
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>

                        <template #cell(view)="data">
                            <button @click="data.toggleDetails" class="btn btn-brand btn-long btn-round">
                                <span class="material-icons align-middle">
                                    visibility
                                </span>
                                <span class="align-middle">Back</span>
                            </button>
                        </template>
                        <template #row-details="row">
                            <b-card>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="title-text">
                                                    Deskripsi Report
                                                </h4>
                                                <p v-if="row.item.description != null" v-html="row.item.description"></p>
                                                <p v-if="row.item.description == null">
                                                    <i>Tidak Ada Deskripsi!</i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <b-table :items="row.item.order" :fields="det" show-empty>
                                                        <template #cell(status)="data">
                                                            <p v-html="data.item.status_label"></p>
                                                        </template>
                                                        <template #cell(action)="data">
                                                            <button @click="info(data.item, data.item.waybill, $event.target)" class="btn btn-brand btn-long btn-round">
                                                                <span class="material-icons align-middle">
                                                                    visibility
                                                                </span>
                                                            </button>
                                                        </template>
                                                    </b-table>
                                                    <b-modal :id="infoModal.id" :title="infoModal.title" size="lg" ok-only @hide="resetInfoModal">
                                                        <div class="table-responsive">
                                                            <b-table :items="infoModal.content.order_detail" :fields="modtab" show-empty>
                                                                <template #cell(index)="data">
                                                                    {{data.index + 1}}
                                                                </template>
                                                                <template #cell(price)="data">
                                                                    Rp. {{data.item.price | formatNumber}}
                                                                </template>
                                                                <template #cell(subtotal)="data">
                                                                    Rp. {{data.item.subtotal | formatNumber}}
                                                                </template>
                                                            </b-table>
                                                        </div>
                                                    </b-modal>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-card>
                        </template>
                    </b-table>
                </div>
            </div>
        </div>
    </div>
</main>
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
    name: "DataReportADV",

    created() {
        if (this.$route.name == "adv.report.view") {
            this.viewAdvReport({
                start: this.$route.params.start,
                end: this.$route.params.end
            });
        }
        if (this.$route.name == "adv.report.view.manage") {
            this.viewManageAdvReport({
                id: this.$route.params.id,
                start: this.$route.params.start,
                end: this.$route.params.end
            });
        }
    },

    data() {
        return {
            search: {},
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "user.name",
                    label: "Nama CS"
                },
                {
                    key: "chat",
                    label: "Chat"
                },
                {
                    key: "transaksi",
                    label: "Transaksi"
                },
                {
                    key: "date",
                    label: "Date"
                },
                {
                    key: "view",
                    label: "View Detail"
                }
            ],
            det: [{
                    key: "waybill",
                    label: "Waybill"
                },
                {
                    key: "customer_name",
                    label: "Customer Name"
                },
                {
                    key: "customer_phone",
                    label: "Phone"
                },
                {
                    key: "customer_address",
                    label: "Address"
                },
                {
                    key: "status",
                    label: "Status"
                },
                {
                    key: "action",
                    label: "Action"
                }
            ],
            modtab: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "product.name",
                    label: "Nama Produk"
                },
                {
                    key: "qty",
                    label: "QTY"
                },
                {
                    key: "price",
                    label: "Harga"
                },
                {
                    key: "subtotal",
                    label: "Subtotal"
                }
            ],
            infoModal: {
                id: "info-modal",
                title: "",
                content: ""
            }
        };
    },

    computed: {
        ...mapState("advReport", {
            view: state => state.view,
            viewManage: state => state.viewManage
        })
    },

    methods: {
        ...mapActions("advReport", ["viewAdvReport", "viewManageAdvReport"]),
        info(item, waybill, button) {
            this.infoModal.title = `Waybill: ${waybill}`;
            this.infoModal.content = item;
            this.$root.$emit("bv::show::modal", this.infoModal.id, button);
        },
        resetInfoModal() {
            this.infoModal.title = "";
            this.infoModal.content = "";
        }
    }
};
</script>

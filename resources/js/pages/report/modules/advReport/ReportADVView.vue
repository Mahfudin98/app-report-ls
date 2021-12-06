<template>
<main>
    <page-loader />
    <div class="rui-page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <div class="row xs-gap">
                    <div class="col-12">
                        <div class="input-group">
                            <date-picker v-model="search" placeholder="Pilih range tanggal" range></date-picker>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <b-table :items="view" :fields="fields" show-empty>
                    <template #cell(index)="data">
                        {{ data.index + 1 }}
                    </template>

                    <template #cell(view)="data">
                        <button @click="data.toggleDetails" class="btn btn-brand btn-long btn-round">
                            <span class="icon">
                                <span data-feather="check" class="fas fa-eye"></span></span>
                            <span class="text">
                                {{ data.detailsShowing ? "Hide" : "Show" }}
                                Detail
                            </span>
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
                                            <p v-if="
                                                        row.item.description !=
                                                            null
                                                    " v-html="
                                                        row.item.description
                                                    "></p>
                                            <p v-if="
                                                        row.item.description ==
                                                            null
                                                    ">
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
                                                        <p v-html="
                                                                    data.item
                                                                        .status_label
                                                                "></p>
                                                    </template>
                                                    <template #cell(action)="data">
                                                        <button @click="info(data.item, data.index, $event.target)" class="btn btn-brand btn-long btn-round">
                                                            <span class="icon">
                                                                <span data-feather="check" class="fas fa-eye"></span></span>
                                                            <span class="text">
                                                                Info modal
                                                            </span>
                                                        </button>
                                                    </template>
                                                </b-table>
                                                <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
                                                    <pre>data</pre>
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
        this.viewAdvReport({
            start: this.$route.params.start,
            end: this.$route.params.end
        });
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
            infoModal: {
                id: 'info-modal',
                title: '',
                content: ''
            }
        };
    },

    computed: {
        ...mapState("advReport", {
            view: state => state.view
        })
    },

    methods: {
        ...mapActions("advReport", ["viewAdvReport"]),
        info(item, index, button) {
            this.infoModal.title = `Row index: ${index}`
            this.infoModal.content = JSON.stringify(item, null, 2)
            this.$root.$emit('bv::show::modal', this.infoModal.id, button)
        },
        resetInfoModal() {
            this.infoModal.title = ''
            this.infoModal.content = ''
        },

    }
};
</script>

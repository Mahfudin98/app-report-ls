<template>
<div class="row">
    <page-loader />
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{ name: 'adv.report.data' }" class="btn btn-secondary">
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
                <b-table :items="show.data" :fields="fields" show-empty>
                    <template #cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template #cell(biaya_iklan)="row">
                        Rp. {{ row.item.biaya_iklan | formatNumber }}
                    </template>
                    <template #cell(omset)="row">
                        Rp. {{ row.item.omset | formatNumber }}
                    </template>
                    <template #cell(cp_wa)="row">
                        Rp. {{ row.item.cp_wa | formatNumber }}
                    </template>
                    <template #cell(date)="row">
                        {{ row.item.date }}
                    </template>
                    <template #cell(created_at)="row">
                        <vue-moments-ago prefix="posted" suffix="ago" :date="row.item.created_at" />
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <span class="align-middle">View Detail</span>
                                                <span class="material-icons align-middle">
                                                    visibility
                                                </span>
                                            </h5>
                                            <router-link :to="{ name: 'adv.report.view.manage', params: {id: $route.params.id, start: row.item.date_start, end: row.item.date_end}}" class="btn btn-primary">
                                                <span class="material-icons align-middle">
                                                    visibility
                                                </span>
                                                <span class="align-middle">View Detail</span>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <h4 class="title-text">
                                                    Deskripsi Report
                                                </h4>
                                            </div>
                                            <p v-if="row.item.keterangan != null" v-html="row.item.keterangan"></p>
                                            <p v-if="row.item.keterangan == null">
                                                <i>Tidak Ada Deskripsi!</i>
                                            </p>
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
        this.ShowAdvReport(this.$route.params.id);
    },

    data() {
        return {
            search: {},
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "lead",
                    label: "Lead"
                },
                {
                    key: "dashboard",
                    label: "Dashboard"
                },
                {
                    key: "omset",
                    label: "Omset"
                },
                {
                    key: "biaya_iklan",
                    label: "Biaya Iklan"
                },
                {
                    key: "cp_wa",
                    label: "CP WA"
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
            ],
            adv: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "name",
                    label: "Nama ADV"
                },
                {
                    key: "view",
                    label: "Detail"
                }
            ]
        };
    },

    computed: {
        ...mapState("advReport", {
            show: state => state.show
        })
    },

    watch: {
        search() {
            this.ShowAdvReport(
                this.convert(this.search[0]) +
                "+-+" +
                this.convert(this.search[1])
            );
        }
    },

    methods: {
        convert(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        },
        ...mapActions("advReport", ["ShowAdvReport"])
    }
};
</script>

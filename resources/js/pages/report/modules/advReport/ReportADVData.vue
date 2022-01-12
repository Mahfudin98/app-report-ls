<template>
<div class="row">
    <page-loader />
    <div class="card" v-if="$can('create reports adv')">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <div class="row xs-gap">
                    <div class="col-12">
                        <div class="input-group">
                            <date-picker v-model="search" placeholder="Pilih range tanggal" range></date-picker>
                        </div>
                    </div>
                </div>
                <router-link class="btn btn-primary" v-if="$can('create reports adv')" :to="{ name: 'adv.report.add' }">
                    <span class="material-icons align-middle">
                        add_circle_outline
                    </span>
                    <span class="align-middle">New Report</span>
                </router-link>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <b-table :items="advReports.data" :fields="fields" show-empty>
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
                            <span class="align-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
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
                                                <span class="align-middle">Setting</span>
                                                <span class="material-icons align-middle">
                                                    settings
                                                </span>
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <router-link :to="{name: 'adv.report.edit', params: {id: row.item.id}}" class="btn btn-warning">
                                                        <span class="material-icons align-middle">
                                                            edit
                                                        </span>
                                                        <span class="align-middle">Edit</span>
                                                    </router-link>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-danger" @click="deleteReport(row.item.id)">
                                                        <span class="material-icons align-middle">
                                                            delete
                                                        </span>
                                                        <span class="align-middle">Hapus</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h4 class="title-text">
                                                        Deskripsi Report
                                                    </h4>
                                                </div>
                                                <div class="col">
                                                    <router-link :to="{name: 'adv.report.view', params: { start: row.item.date_start, end: row.item.date_end}}" class="btn btn-primary">
                                                        <span class="align-middle">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </span>
                                                        <span class="align-middle">View Detail</span>
                                                    </router-link>
                                                </div>
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
    <!-- for manager -->
    <div class="card" v-if="$can('read projects')">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
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
                <b-table :items="users" :fields="adv" show-empty>
                    <template #cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template #cell(count)="data">
                        <h5>
                            <b-badge pill variant="light">{{ data.item.child.length }}</b-badge> Orang
                        </h5>
                    </template>
                    <template #cell(view)="data">
                        <router-link :to="{
                                    name: 'adv.report.show',
                                    params: {
                                        id: data.item.id
                                    }
                                }" class="btn btn-primary btn-long btn-round">
                            <span class="icon">
                                <span data-feather="check" class="fas fa-eye"></span></span>
                            <span class="text">
                                Show
                                Detail
                            </span>
                        </router-link>
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
        this.getAdvReports();
        this.getAdv();
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
                    key: "count",
                    label: "Jumlah CS"
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
            advReports: state => state.advReports
        }),
        ...mapState("user", {
            users: state => state.users
        })
    },

    watch: {
        search() {
            this.getAdvReports(
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
        ...mapActions("advReport", ["getAdvReports", "removeAdvReport"]),
        ...mapActions("user", ["getAdv"]),
        deleteReport(id) {
            this.$swal
                .fire({
                    title: "Kamu Yakin?",
                    text: "Tindakan ini akan menghapus secara permanent!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                })
                .then(result => {
                    if (result.isConfirmed) {
                        this.removeAdvReport(id);
                        this.$swal(
                            "Terhapus!",
                            "Produk sudah dihapus.",
                            "success"
                        );
                    }
                });
        }
    }
};
</script>

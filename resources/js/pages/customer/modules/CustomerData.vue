<template>
<div class="row">
    <page-loader />
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <div class="row xs-gap">
                <div class="col-12">
                    <div class="input-group">
                        <date-picker v-model="search" placeholder="Pilih range tanggal" range></date-picker>
                    </div>
                </div>
            </div>
            <button @click="exportData" type="button" class="btn btn-primary btn-long">
                <span class="material-icons align-middle">
                    file_download
                </span>
                <span class="align-middle">Export</span>
            </button>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <b-table :items="dataCustomers.data" :fields="fields" show-empty>
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                    </b-table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <p v-if="dataCustomers.data">
                            <span class="material-icons align-middle">
                                menu
                            </span>
                            <span class="align-middle">
                                {{ dataCustomers.data.length }} item dari
                                {{ dataCustomers.meta.total }} total data
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <b-pagination v-model="page" :total-rows="dataCustomers.meta.total" :per-page="dataCustomers.meta.per_page" aria-controls="dataCustomers" v-if="dataCustomers.data && dataCustomers.data.length > 0"></b-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import PageLoader from "../../../components/PageLoader.vue";
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
    name: "DataCustomer",

    created() {
        this.getDataCustomer();
    },

    data() {
        return {
            search: {},
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "customer_name",
                    label: "Nama Customer"
                },
                {
                    key: "customer_address",
                    label: "Alamat Customer"
                },
                {
                    key: "customer_phone",
                    label: "Phone Customer"
                },
                {
                    key: "date",
                    label: "Date"
                }
            ]
        };
    },

    computed: {
        ...mapState("dashboard", {
            dataCustomers: state => state.dataCustomers
        }),
        page: {
            get() {
                return this.$store.state.dashboard.page;
            },
            set(val) {
                this.$store.commit("dashboard/SET_PAGE", val);
            }
        }
    },

    watch: {
        page() {
            this.getDataCustomer();
        },
        search() {
            this.getDataCustomer(
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
        ...mapActions("dashboard", ["getDataCustomer"]),

        exportData() {
            window.open(
                `/api/export/customer?api_token=${
                    this.token
                }&date=${this.convert(this.search[0]) +
                    "+-+" +
                    this.convert(this.search[1])}`
            );
        }
    }
};
</script>

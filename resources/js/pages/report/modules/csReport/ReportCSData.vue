<template>
    <main>
        <page-loader />
        <div class="rui-page-content">
            <div class="container-fluid" v-if="$can('create reports cs')">
                <calender />
            </div>
            <div class="container-fluid" v-if="authenticated.position_id == 13">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <select v-model="month" class="form-control">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select v-model="year" class="form-control">
                                <option
                                    v-for="(y, i) in years"
                                    :key="i"
                                    :value="y"
                                    >{{ y }}</option
                                >
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <b-table
                        :items="listCS.data"
                        :fields="fields"
                        head-variant="light"
                        show-empty
                    >
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(view)="row">
                            <router-link
                                class="btn btn-brand btn-long btn-round"
                                :to="{
                                    name: 'report.vieworder',
                                    params: { id: row.item.id }
                                }"
                            >
                                <span class="icon">
                                    <span
                                        data-feather="check"
                                        class="fas fa-eye"
                                    ></span
                                ></span>
                                <span class="text">View Detail</span>
                            </router-link>
                        </template>
                    </b-table>
                </div>
            </div>
            <div class="container-fluid" v-if="authenticated.position_id == 1 || authenticated.position_id == 2 || authenticated.position_id == 6 || authenticated.position_id == null">
                <div class="table-responsive">
                    <b-table
                        :items="listAllCS.data"
                        :fields="fieldsAll"
                        head-variant="light"
                        show-empty
                    >
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(jumlah_lead)="data">
                            <h6 class="badge badge-brand">
                                {{ data.item.chats }}
                            </h6>
                        </template>
                        <template #cell(transaction)="data">
                            <h6 class="badge badge-brand">
                                {{ data.item.transaction }}
                            </h6>
                        </template>
                        <template #cell(view)="row">
                            <router-link
                                class="btn btn-brand btn-long btn-round"
                                :to="{
                                    name: 'report.vieworder',
                                    params: { id: row.item.id }
                                }"
                            >
                                <span class="icon">
                                    <span
                                        data-feather="check"
                                        class="fas fa-eye"
                                    ></span
                                ></span>
                                <span class="text">View Detail</span>
                            </router-link>
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
import Calender from "./module/Calendar.vue";
import moment from "moment";
export default {
    components: { VueMomentsAgo, DatePicker, Calender, PageLoader },
    name: "DataReportCS",

    created() {
        this.getListCS({
            month: this.month,
            year: this.year
        });
        this.getAllListCS();
    },

    data() {
        return {
            range: {},
            search: {},
            fields: [
                { key: "index", label: "#" },
                { key: "user.name", label: "Name CS" },
                { key: "chat", label: "Lead" },
                { key: "transaksi", label: "Transaksi" },
                { key: "view", label: "View Detail" }
            ],
            fieldsAll: [
                { key: "index", label: "#" },
                { key: "name", label: "Name CS" },
                { key: "jumlah_lead", label: "Lead" },
                { key: "transaction", label: "Transaksi" },
                { key: "view", label: "View Detail" }
            ],
            month: moment().format("MM"),
            year: moment().format("Y")
        };
    },

    computed: {
        ...mapState("csReport", {
            listCS: state => state.listCS,
            listAllCS: state => state.listAllCS
        }),
        ...mapState("user", {
            authenticated: state => state.authenticated
        }),
        years() {
            return _.range(
                2019,
                moment()
                    .add(1, "years")
                    .format("Y")
            );
        }
    },

    watch: {
        month() {
            this.getListCS({
                month: this.month,
                year: this.year
            });
        },
        year() {
            this.getListCS({
                month: this.month,
                year: this.year
            });
        }
    },

    methods: {
        ...mapActions("csReport", ["getListCS", "getAllListCS"])
    }
};
</script>

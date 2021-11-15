<template>
    <main>
        <page-loader />
        <div class="rui-page-content">
            <div class="container-fluid" v-if="authenticated.position_id == 12 || authenticated.position_id == 14 || authenticated.position_id == 15">
                <calender />
            </div>
            <div class="container-fluid" v-if="authenticated.position_id == 13">
                <div class="table-responsive">
                    <b-table
                        :items="listCS.data"
                        :fields="fields"
                        head-variant="light"
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
            <div class="container-fluid" v-if="authenticated.position_id == 1 || authenticated.position_id == 2 || authenticated.position_id == 6 || authenticated.position_id == null">
                <div class="table-responsive">
                    <b-table
                        :items="listAllCS.data"
                        :fields="fieldsAll"
                        head-variant="light"
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
export default {
    components: { VueMomentsAgo, DatePicker, Calender, PageLoader },
    name: "DataReportCS",

    created() {
        this.getListCS();
        this.getAllListCS();
    },

    data() {
        return {
            range: {},
            search: {},
            fields: [
                { key: "index", label: "#" },
                { key: "name", label: "Name CS" },
                { key: "jumlah_lead", label: "Lead" },
                { key: "transaction", label: "Transaksi" },
                { key: "view", label: "View Detail" }
            ],
            fieldsAll: [
                { key: "index", label: "#" },
                { key: "name", label: "Name CS" },
                { key: "jumlah_lead", label: "Lead" },
                { key: "transaction", label: "Transaksi" },
                { key: "view", label: "View Detail" }
            ]
        };
    },

    computed: {
        ...mapState("csReport", {
            listCS: state => state.listCS,
            listAllCS: state => state.listAllCS
        }),
        ...mapState("user", {
            authenticated: state => state.authenticated
        })
    },

    watch: {
        search() {
            this.getListCS(
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
        ...mapActions("csReport", ["getListCS", "getAllListCS"])
    }
};
</script>

<template>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <b-table :items="listAllCS.data" :fields="fieldsAll" head-variant="light" show-empty>
                <template #cell(index)="data">
                    {{ data.index + 1 }}
                </template>
                <template #cell(jumlah_lead)="data">
                    <h6 class="badge bg-primary rounded-pill">
                        {{ data.item.chats }}
                    </h6>
                </template>
                <template #cell(transaction)="data">
                    <h6 class="badge bg-primary rounded-pill">
                        {{ data.item.transaction }}
                    </h6>
                </template>
                <template #cell(view)="row">
                    <router-link class="btn btn-primary btn-long btn-round" :to="{
                                name: 'all.cs.report.data.calendar',
                                params: { id: row.item.id }
                            }">
                        <span class="material-icons align-middle">
                            visibility
                        </span>
                        <span class="align-middle">View Detail</span>
                    </router-link>
                </template>
            </b-table>
        </div>
    </div>
</div>
</template>

<script>
import PageLoader from "../../../../../components/PageLoader.vue";
import {
    mapActions,
    mapState
} from "vuex";
import VueMomentsAgo from "vue-moments-ago";
import moment from "moment";
export default {
    components: {
        VueMomentsAgo,
        PageLoader
    },
    name: "DataReportCS",

    created() {
        this.getAllListCS();
    },

    data() {
        return {
            fieldsAll: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "name",
                    label: "Name CS"
                },
                {
                    key: "jumlah_lead",
                    label: "Lead"
                },
                {
                    key: "transaction",
                    label: "Transaksi"
                },
                {
                    key: "view",
                    label: "View Detail"
                }
            ]
        };
    },

    computed: {
        ...mapState("csReport", {
            listAllCS: state => state.listAllCS
        })
    },

    methods: {
        ...mapActions("csReport", ["getAllListCS"])
    }
};
</script>

<template>
<main>
    <page-loader/>
    <div class="rui-page-content">
        <div class="container-fluid" v-if="viewReportWebs.data != null">
            <div class="row">
                <div class="col-6">
                    <b-card bg-variant="brand" text-variant="white" :title="'Report URL ' + urlShow">
                        <b-card-text>
                            Total {{ viewReportWebs.data.total }} View
                        </b-card-text>
                        <b-card-text>
                            Tanggal {{ viewReportWebs.data.date }}
                        </b-card-text>
                        <b-img v-b-modal.modal-xl center width="100" height="100" thumbnail fluid :src="'../../storage/report-webs/' + viewReportWebs.data.image" :alt="viewReportWebs.data.image" v-if="viewReportWebs.data.image != null">
                        </b-img>
                        <b-list-group v-else>
                            <b-list-group-item class="d-flex justify-content-between align-items-center">
                                <b-icon icon="card-image"></b-icon>
                                Gambar Tidak Ditemukan
                            </b-list-group-item>
                        </b-list-group>
                    </b-card>
                    <b-modal id="modal-xl" size="xl" :title="viewReportWebs.data.image" hide-footer>
                        <b-img center v-show="viewReportWebs.data.image != null" :src="'../../storage/report-webs/' + viewReportWebs.data.image" :alt="viewReportWebs.data.image" fluid-grow>
                        </b-img>
                    </b-modal>
                </div>
                <div class="col-6">
                    <b-card border-variant="brand" :header="'Report Tanggal ' + viewReportWebs.data.date" header-bg-variant="brand" header-text-variant="white" align="center">
                        <div class="table-responsive">
                            <b-table :items="viewReportWebs.data.page" :fields="fields" show-empty>
                                <template #cell(index)="data">
                                    {{ data.index + 1 }}
                                </template>
                                <template #cell(page)="row">
                                    <span class="badge badge-brand">
                                        {{ row.item.page }}
                                    </span>
                                </template>
                                <template #cell(count)="row">
                                    <span class="badge badge-brand">
                                        {{ row.item.count }}
                                    </span>
                                    View
                                </template>
                            </b-table>
                        </div>
                    </b-card>
                </div>
            </div>
        </div>
        <div class="container-fluid" v-else>
            <b-card overlay img-src="https://picsum.photos/900/250/?image=3" img-alt="Card Image" text-variant="white" title="Data Tidak Ditemukan">
                <b-card-text>
                    Data Masih Kosong
                </b-card-text>
            </b-card>
        </div>
    </div>
</main>
</template>

<script>
import {
    mapActions,
    mapState
} from "vuex";
import moment from "moment";
import PageLoader from '../../../components/PageLoader.vue'
export default {
    name: "ViewProject",
    components: {PageLoader},
    created() {
        this.getViewReportWeb(this.$route.params.date);
    },

    data() {
        return {
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "page",
                    label: "Page Name"
                },
                {
                    key: "count",
                    label: "Total View"
                },
                {
                    key: "date",
                    label: "Tanggal"
                },
            ]
        };
    },

    computed: {
        ...mapState("reportWeb", {
            viewReportWebs: state => state.viewReportWebs
        }),
        urlShow() {
            return this.viewReportWebs.data.url
        }
    },

    watch: {
        // this code for watch
    },

    methods: {
        ...mapActions("reportWeb", ["getViewReportWeb"]),
    }
};
</script>

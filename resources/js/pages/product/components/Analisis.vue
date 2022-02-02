<template>
<div class="row">
    <div class="col-12 col-lg-8 col-xxl-9 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Bar Chart</h5> </br>
                <div class="row">
                    <div class="col-md-5">
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
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select v-model="year" class="form-control">
                                <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>Export To Excel</label>
                        <button class="btn btn-primary btn-sm pull-right" @click="exportData">
                            Export
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body d-flex">
                <div class="align-self-center w-100">
                    <div class="py-3">
                        <div class="chart chart-xs">
                            <bar-chart v-if="bar.length > 0" :data="bar" :options="chartOptions" :labels="bar" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4 col-xxl-3 d-flex">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Donat Chart</h5>
            </div>
            <div class="card-body d-flex w-100">
                <div class="align-self-center chart chart-lg">
                    <donat-chart v-if="donat.length > 0" :data="donat" :options="chartOptions" :labels="donat" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">List Analisis</h5>
            </div>
            <div class="table-responsive">
                <b-table :items="lists.data" :fields="fields" show-empty>
                    <template #cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template #cell(type)="row">
                        <!-- <span v-html="row.item.product.type_product_label"></span> -->
                        <span v-if="row.item.product.origin_order == 'Shopee'" class="badge bg-danger rounded-pill">Shopee</span>
                        <span v-if="row.item.product.origin_order == 'Lazada'" class="badge bg-info rounded-pill">Lazada</span>
                        <span v-if="row.item.product.origin_order == 'Iklan'" class="badge bg-warning rounded-pill">Iklan</span>
                        <span v-if="row.item.product.origin_order == null" class="badge bg-secondary rounded-pill">Belum Diatur</span>
                    </template>
                </b-table>
            </div>
        </div>
    </div>
</div>
<!-- <div class="rui-page-content">
        <div class="container-fluid">
            <h2>Bar Chart</h2>
            <div class="row">
                <div class="col-md-5">
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
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Tahun</label>
                        <select v-model="year" class="form-control">
                            <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Export To Excel</label>
                    <button class="btn btn-primary btn-sm pull-right" @click="exportData">
                        Export
                    </button>
                </div>
            </div>
            <div class="row vertical-gap">
                <div class="col-lg-8">
                    <div class="rui-widget p-0">
                        <bar-chart v-if="bar.length > 0" :data="bar" :options="chartOptions" :labels="bar" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="rui-widget">
                        <div class="rui-widget-content">
                            <donat-chart v-if="donat.length > 0" :data="donat" :options="chartOptions" :labels="donat" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="rui-widget p-0">
                        <div class="table-responsive">
                            <b-table :items="lists.data" :fields="fields" show-empty>
                                <template #cell(index)="data">
                                    {{ data.index + 1 }}
                                </template>
                                <template #cell(type)="row">
                                    <span v-html="row.item.product.type_product_label"></span>
                                </template>
                            </b-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
import moment from "moment";
import _ from "lodash";

import BarChart from "./modules/Barchart.vue";
import DonatChart from "./modules/DonatChart.vue";
import {
    mapActions,
    mapState
} from "vuex";
export default {
    components: {
        BarChart,
        DonatChart
    },
    created() {
        this.getChartBar({
            month: this.month,
            year: this.year
        });
        this.getListChart({
            month: this.month,
            year: this.year
        });
        this.getDonatChart({
            month: this.month,
            year: this.year
        });
    },
    data() {
        return {
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            },
            barOmset: {},
            persen: {},
            month: moment().format("MM"),
            year: moment().format("Y"),

            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "product.name",
                    label: "Name"
                },
                {
                    key: "sum",
                    label: "Total"
                },
                {
                    key: "type",
                    label: "Tipe Produk"
                },
                {
                    key: "date",
                    label: "Date"
                }
            ]
        };
    },
    watch: {
        month() {
            this.getChartBar({
                month: this.month,
                year: this.year
            });
            this.getListChart({
                month: this.month,
                year: this.year
            });
            this.getDonatChart({
                month: this.month,
                year: this.year
            });
        },
        year() {
            this.getChartBar({
                month: this.month,
                year: this.year
            });
            this.getListChart({
                month: this.month,
                year: this.year
            });
            this.getDonatChart({
                month: this.month,
                year: this.year
            });
        }
    },
    computed: {
        ...mapState("product", {
            bar: state => state.bar,
            lists: state => state.lists,
            donat: state => state.donat
        }),
        years() {
            return _.range(
                2019,
                moment()
                .add(1, "years")
                .format("Y")
            );
        },
    },

    methods: {
        ...mapActions("product", [
            "getChartBar",
            "getListChart",
            "getDonatChart"
        ]),
        exportData() {
            window.open(`/api/export?api_token=${this.token}&month=${this.month}&year=${this.year}`)
        }
    }
};
</script>

<template>
<main class="content">
    <page-loader />
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ $route.meta.title }}</h1>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All Omset</h5> </br>
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
                                        <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <label>Export To Excel</label>
                            <button class="btn btn-primary" @click="exportData">
                                Export
                            </button>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <line-chart v-if="allOmsets.length > 0" :data="allOrder_data" :options="chartOptions" :labels="labels" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">List Omset CS</h5>
                    </div>
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            <table class="table table-hover my-0">
                                <tbody>
                                    <tr v-for="row in omsets" :key="row.total">
                                        <td>
                                            <div class="d-flex align-items-start">
                                                <img v-show="row.image != null" :src="'../storage/teams/' + row.image" :alt="row.name" width="36" height="36" class="rounded-circle me-2" alt="Vanessa Tucker">
                                                <div class="flex-grow-1">
                                                    <strong> {{ row.labels }}</strong><br />
                                                    <small class="text-muted">{{ row.position }}</small><br />
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            Rp. {{ row.total | formatNumber }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Omset CS</h5> </br>
                        <date-picker v-model="barOmset" placeholder="Pilih range tanggal" range></date-picker>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <bar-chart v-if="omsets.length > 0" :data="omsets" :options="chartOptions" :labels="omsets" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">List Performa CS</h5> </br>
                        <date-picker v-model="persen" placeholder="Pilih range tanggal" range></date-picker>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Nama CS</th>
                                <th class="d-none d-xl-table-cell">Lead</th>
                                <th class="d-none d-xl-table-cell">Order</th>
                                <th>Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in persentasecs" :key="index">
                                <td>{{ row.name }}</td>
                                <td class="d-none d-xl-table-cell">{{ row.lead }}</td>
                                <td class="d-none d-xl-table-cell">{{ row.order }}</td>
                                <td><span class="badge bg-success">{{ row.total_order }} %</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Donat Chart</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <donat-chart v-if="persentasecs.length > 0" :data="persentasecs" :options="chartOptions" :labels="persentasecs" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="rui-page-content">
        <div class="container-fluid">
            <h2>All Omset</h2>
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
                <div class="col-lg-12">
                    <div class="rui-widget p-0">
                        <line-chart v-if="allOmsets.length > 0" :data="allOrder_data" :options="chartOptions" :labels="labels" />
                    </div>
                </div>
            </div>
            <div class="rui-gap-2"></div>
            <h2>Omset CS</h2>
            <div class="d-flex justify-content-between align-items-center mb-20">
                <div class="row xs-gap">
                    <div class="col-12">
                        <div class="input-group">
                            <date-picker v-model="barOmset" placeholder="Pilih range tanggal" range></date-picker>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row vertical-gap">
                <div class="col-lg-8">
                    <div class="rui-widget p-0">
                        <bar-chart v-if="omsets.length > 0" :data="omsets" :options="chartOptions" :labels="omsets" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="rui-widget">
                        <div class="rui-widget-content">
                            <ul class="list-group list-group-flush rui-widget-list rui-widget-country-list rui-scrollbar rui-scrollbar-ready os-host os-theme-dark os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
                                <div class="os-resize-observer-host observed">
                                    <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
                                </div>
                                <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                                    <div class="os-resize-observer"></div>
                                </div>
                                <div class="os-content-glue" style="margin: 0px; height: 519px; width: 380px;"></div>
                                <div class="os-padding">
                                    <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                                        <div class="os-content" style="padding: 0px; height: auto; width: 100%;">
                                            <li class="list-group-item" v-for="row in omsets" :key="row.total">
                                                <div class="media media-filled media-country">
                                                    <a href="#" class="media-link"><span class="media-img"><img v-show="
                                                                        row.image !=
                                                                            null
                                                                    " :src="
                                                                        '../storage/teams/' +
                                                                            row.image
                                                                    " :alt="
                                                                        row.name
                                                                    " /> </span><span class="media-body">
                                                            <div class="media-title">
                                                                {{
                                                                        row.labels
                                                                    }}
                                                            </div>
                                                            <div class="media-country-price">
                                                                Rp.
                                                                {{
                                                                        row.total
                                                                            | formatNumber
                                                                    }}
                                                            </div>
                                                        </span></a>
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                                <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable">
                                    <div class="os-scrollbar-track">
                                        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
                                    </div>
                                </div>
                                <div class="os-scrollbar os-scrollbar-vertical">
                                    <div class="os-scrollbar-track">
                                        <div class="os-scrollbar-handle" style="height: 74.6641%; transform: translate(0px, 0px);"></div>
                                    </div>
                                </div>
                                <div class="os-scrollbar-corner"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rui-gap-2"></div>
            <h2>Performa CS</h2>
            <div class="d-flex justify-content-between align-items-center mb-20">
                <div class="row xs-gap">
                    <div class="col-12">
                        <div class="input-group">
                            <date-picker v-model="persen" placeholder="Pilih range tanggal" range></date-picker>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row vertical-gap">
                <div class="col-lg-8">
                    <div class="rui-widget p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr class="users-table-info">
                                        <th scope="col">Nama CS</th>
                                        <th scope="col">Lead</th>
                                        <th scope="col">Order</th>
                                        <th scope="col">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, index) in persentasecs" :key="index">
                                        <td>{{ row.name }}</td>
                                        <td>{{ row.lead }}</td>
                                        <td>{{ row.order }}</td>
                                        <td>{{ row.total_order }} %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="rui-widget">
                        <div class="rui-widget-content">
                            <donat-chart v-if="persentasecs.length > 0" :data="persentasecs" :options="chartOptions" :labels="persentasecs" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
</main>
</template>

<script>
import moment from "moment";
import _ from "lodash";

import BarChart from "./components/BarChart.vue";
import DonatChart from "./components/DonatChart.vue";
import DatePicker from "vue2-datepicker";
import LineChart from "./components/LineChart.vue";
import {
    mapActions,
    mapState
} from "vuex";
import PageLoader from "../../components/PageLoader.vue";
export default {
    components: {
        BarChart,
        DonatChart,
        DatePicker,
        LineChart,
        PageLoader
    },
    created() {
        this.getChartBarOmset();
        this.getChartPersentaseCS();
        this.getChartAllOrder({
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
            year: moment().format("Y")
        };
    },
    watch: {
        barOmset() {
            this.getChartBarOmset(
                this.convert(this.barOmset[0]) +
                "+-+" +
                this.convert(this.barOmset[1])
            );
        },
        persen() {
            this.getChartPersentaseCS(
                this.convert(this.persen[0]) +
                "+-+" +
                this.convert(this.persen[1])
            );
        },

        month() {
            this.getChartAllOrder({
                month: this.month,
                year: this.year
            });
        },
        year() {
            this.getChartAllOrder({
                month: this.month,
                year: this.year
            });
        }
    },
    computed: {
        ...mapState("dashboard", {
            omsets: state => state.omsets,
            persentasecs: state => state.persentasecs,
            allOmsets: state => state.allOmsets
        }),
        years() {
            return _.range(
                2019,
                moment()
                .add(1, "years")
                .format("Y")
            );
        },

        labels() {
            return _.map(this.allOmsets, function (o) {
                return moment(o.date).format("DD");
            });
        },
        allOrder_data() {
            let total = _.map(this.allOmsets, function (o) {
                return o.total;
            });
            let dataRetur = _.map(this.allOmsets, function (o) {
                return o.totalRetur;
            });
            return [total, dataRetur]
        }
    },

    methods: {
        convert(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        },
        ...mapActions("dashboard", [
            "getChartBarOmset",
            "getChartPersentaseCS",
            "getChartAllOrder"
        ]),

        exportData() {
            window.open(`/api/export?api_token=${this.token}&month=${this.month}&year=${this.year}`)
        }
    }
};
</script>

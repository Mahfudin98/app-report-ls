<template>
    <main>
        <div class="rui-page-title">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard.html">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Apps</a></li>
                    </ol>
                </nav>
                <h1>{{ $route.meta.title }}</h1>
            </div>
        </div>
        <div class="rui-page-content">
            <div class="container-fluid">
                <!--Omset CS Chart-->
                <h2>Omset CS</h2>
                <div
                    class="d-flex justify-content-between align-items-center mb-20"
                >
                    <div class="row xs-gap">
                        <div class="col-12">
                            <div class="input-group">
                                <date-picker
                                    v-model="barOmset"
                                    placeholder="Pilih range tanggal"
                                    range
                                ></date-picker>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row vertical-gap">
                    <div class="col-lg-8">
                        <div class="rui-widget p-0">
                            <bar-chart
                                v-if="omsets.length > 0"
                                :data="omsets"
                                :options="chartOptions"
                                :labels="omsets"
                            />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="rui-widget">
                            <div class="rui-widget-content">
                                <ul
                                    class="list-group list-group-flush rui-widget-list rui-widget-country-list rui-scrollbar rui-scrollbar-ready os-host os-theme-dark os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"
                                >
                                    <div
                                        class="os-resize-observer-host observed"
                                    >
                                        <div
                                            class="os-resize-observer"
                                            style="left: 0px; right: auto;"
                                        ></div>
                                    </div>
                                    <div
                                        class="os-size-auto-observer observed"
                                        style="height: calc(100% + 1px); float: left;"
                                    >
                                        <div class="os-resize-observer"></div>
                                    </div>
                                    <div
                                        class="os-content-glue"
                                        style="margin: 0px; height: 519px; width: 380px;"
                                    ></div>
                                    <div class="os-padding">
                                        <div
                                            class="os-viewport os-viewport-native-scrollbars-invisible"
                                            style="overflow-y: scroll;"
                                        >
                                            <div
                                                class="os-content"
                                                style="padding: 0px; height: auto; width: 100%;"
                                            >
                                                <li
                                                    class="list-group-item"
                                                    v-for="row in omsets"
                                                    :key="row.total"
                                                >
                                                    <div
                                                        class="media media-filled media-country"
                                                    >
                                                        <a
                                                            href="#"
                                                            class="media-link"
                                                            ><span
                                                                class="media-img"
                                                                ><img
                                                                    v-show="
                                                                        row.image !=
                                                                            null
                                                                    "
                                                                    :src="
                                                                        '../storage/teams/' +
                                                                            row.image
                                                                    "
                                                                    :alt="
                                                                        row.name
                                                                    "
                                                                /> </span
                                                            ><span
                                                                class="media-body"
                                                            >
                                                                <div
                                                                    class="media-title"
                                                                >
                                                                    {{
                                                                        row.labels
                                                                    }}
                                                                </div>
                                                                <div
                                                                    class="media-country-price"
                                                                >
                                                                    Rp.
                                                                    {{
                                                                        row.total
                                                                            | formatNumber
                                                                    }}
                                                                </div>
                                                            </span></a
                                                        >
                                                    </div>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable"
                                    >
                                        <div class="os-scrollbar-track">
                                            <div
                                                class="os-scrollbar-handle"
                                                style="width: 100%; transform: translate(0px, 0px);"
                                            ></div>
                                        </div>
                                    </div>
                                    <div
                                        class="os-scrollbar os-scrollbar-vertical"
                                    >
                                        <div class="os-scrollbar-track">
                                            <div
                                                class="os-scrollbar-handle"
                                                style="height: 74.6641%; transform: translate(0px, 0px);"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="os-scrollbar-corner"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rui-gap-2"></div>
                <!--Performa CS Chart-->
                <h2>Performa CS</h2>
                <div
                    class="d-flex justify-content-between align-items-center mb-20"
                >
                    <div class="row xs-gap">
                        <div class="col-12">
                            <div class="input-group">
                                <date-picker
                                    v-model="persen"
                                    placeholder="Pilih range tanggal"
                                    range
                                ></date-picker>
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
                                        <tr
                                            v-for="(row, index) in persentasecs"
                                            :key="index"
                                        >
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
                                <donat-chart
                                    v-if="persentasecs.length > 0"
                                    :data="persentasecs"
                                    :options="chartOptions"
                                    :labels="persentasecs"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import _ from "lodash";
import BarChart from "./components/BarChart.vue";
import DonatChart from "./components/DonatChart.vue";
import DatePicker from "vue2-datepicker";
import { mapActions, mapState } from "vuex";
export default {
    components: { BarChart, DonatChart, DatePicker },
    created() {
        this.getChartBarOmset();
        this.getChartPersentaseCS();
    },
    data() {
        return {
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            },
            barOmset: {},
            persen: {}
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
        }
    },
    computed: {
        ...mapState("dashboard", {
            omsets: state => state.omsets,
            persentasecs: state => state.persentasecs
        })
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
            "getChartPersentaseCS"
        ]),
        exportData() {}
    }
};
</script>

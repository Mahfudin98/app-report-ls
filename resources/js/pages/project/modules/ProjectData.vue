<template>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12">
            <div class="card flex-fill">
                <div class="card-header">
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
                                    <option
                                        v-for="(y, i) in years"
                                        :key="i"
                                        :value="y"
                                        >{{ y }}</option
                                    >
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label v-if="$can('create projects')">
                                Setting <b-icon icon="gear-fill"></b-icon>
                            </label>
                            <label v-else>Export To Excel</label>
                            <br />
                            <div
                                class="btn-group-lg"
                                role="group"
                                aria-label="Basic mixed styles example"
                            >
                                <button type="button" class="btn btn-primary">
                                    <b-icon icon="printer-fill"></b-icon>
                                </button>
                                <router-link
                                    :to="{ name: 'project.add' }"
                                    class="btn btn-primary"
                                    v-if="$can('create projects')"
                                >
                                    <span class="material-icons align-middle">
                                        add_circle_outline
                                    </span>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="rui-widget p-0">
                            <!-- for chart -->
                            <bar-chart
                                v-if="webBar.length > 0"
                                :data="total"
                                :options="chartOptions"
                                :labels="labels"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xxl-3 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Donat Chart</h5>
                </div>
                <div class="card-body d-flex w-100">
                    <div class="align-self-center chart chart-lg">
                        <donat-chart
                            v-if="donutChart.length > 0"
                            :data="donutChart"
                            :options="chartOptions"
                            :labels="donutChart"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xxl-3 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Description</h5>
                </div>
                <div class="card-body d-flex w-100">
                    <table class="table mb-0">
                        <tbody>
                            <tr
                                v-for="(rows, index) in donutChart"
                                :key="index"
                            >
                                <td>
                                    <h5>
                                        <i
                                            class="fab fa-chrome text-primary fa-fw"
                                        ></i>
                                        {{ rows.name }}
                                    </h5>
                                </td>
                                <td class="text-end">{{ rows.total }} Views</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <h2>Calendar</h2>
                    <Calender />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import VueMomentsAgo from "vue-moments-ago";
import Calender from "./Calendar.vue";
import moment from "moment";
import BarChart from "./BarChart.vue";
import DonatChart from "./DonutChart.vue";
export default {
    components: {
        BarChart,
        VueMomentsAgo,
        Calender,
        DonatChart
    },
    created() {
        this.getChartBarWeb({
            month: this.month,
            year: this.year
        });
        this.getChartDonutWeb({
            month: this.month,
            year: this.year
        });
    },

    data() {
        return {
            chartOptions: {
                // responsive: true,
                // maintainAspectRatio: false
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 70
            },
            barOmset: {},
            month: moment().format("MM"),
            year: moment().format("Y")
        };
    },

    computed: {
        ...mapState("reportWeb", {
            webBar: state => state.webBar,
            donutChart: state => state.donutChart
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
            return _.map(this.webBar, function(o) {
                return moment(o.labels).format("DD");
            });
        },
        total() {
            let total = _.map(this.webBar, function(o) {
                return o.total;
            });
            return total;
        }
    },

    watch: {
        month() {
            this.getChartBarWeb({
                month: this.month,
                year: this.year
            });
            this.getChartDonutWeb({
                month: this.month,
                year: this.year
            });
        },
        year() {
            this.getChartBarWeb({
                month: this.month,
                year: this.year
            });
            this.getChartDonutWeb({
                month: this.month,
                year: this.year
            });
        }
    },

    methods: {
        ...mapActions("reportWeb", ["getChartBarWeb", "getChartDonutWeb"])
    }
};
</script>

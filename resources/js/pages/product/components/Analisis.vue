<template>
<main>
    <div class="rui-page-content">
        <div class="container-fluid">
            <!--Omset CS Chart-->
            <h2>Bar Chart</h2>
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
                <div class="col-lg-12">
                    <div class="rui-widget p-0">
                        <bar-chart v-if="bar.length > 0" :data="bar" :options="chartOptions" :labels="bar" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="rui-widget p-0">
                        <div class="table-responsive">
                            <b-table :items="lists.data" :fields="fields" show-empty>
                                <template #cell(index)="data">
                                    {{ data.index + 1 }}
                                </template>
                            </b-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</template>

<script>
import moment from "moment";
import _ from "lodash";

import BarChart from "./modules/Barchart.vue";
import DatePicker from "vue2-datepicker";
import {
    mapActions,
    mapState
} from "vuex";
export default {
    components: {
        BarChart,
        DatePicker
    },
    created() {
        this.getChartBar();
        this.getListChart();
    },
    data() {
        return {
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            },
            barOmset: {},

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
                    key: "date",
                    label: "Date"
                }
            ]
        };
    },
    watch: {
        barOmset() {
            this.getChartBar(
                this.convert(this.barOmset[0]) +
                "+-+" +
                this.convert(this.barOmset[1])
            );
            this.getListChart(
                this.convert(this.barOmset[0]) +
                "+-+" +
                this.convert(this.barOmset[1])
            );
        },
    },
    computed: {
        ...mapState("product", {
            bar: state => state.bar,
            lists: state => state.lists
        }),
    },

    methods: {
        convert(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        },
        ...mapActions("product", [
            "getChartBar",
            "getListChart"
        ]),
    }
};
</script>

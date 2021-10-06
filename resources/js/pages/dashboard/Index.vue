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
                <div
                    class="d-flex justify-content-between align-items-center mb-20"
                >
                    <div class="row xs-gap">
                    <div class="col-12">
                        <div class="input-group">
                            <date-picker v-model="search" placeholder="Pilih range tanggal" range></date-picker>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="rui-profile row vertical-gap">
                    <div class="panel-body">
                        <bar-chart v-if="omsets.length > 0" :data="omsets" :options="chartOptions" :labels="omsets" />
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import moment from "moment";
import _ from "lodash";
import BarChart from "./components/BarChart.vue";
import DatePicker from "vue2-datepicker";
import { mapActions, mapState } from "vuex";
export default {
    components: { BarChart, DatePicker },
    created() {
        this.getChartData();
    },
    data() {
        return {
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            },
            search: {}
        };
    },
    watch: {
        search() {
            this.getChartData(this.convert(this.search[0])+'+-+'+this.convert(this.search[1]));
        }
    },
    computed: {
        ...mapState("dashboard", {
            omsets: state => state.omsets //AMBIL DATA DARI STATE
        })
    },

    methods: {
        convert(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        },
        ...mapActions('dashboard', ['getChartData']),
        exportData() {

        }
    }
};
</script>

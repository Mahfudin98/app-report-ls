<template>
    <main>
        <div class="rui-page-content">
            <div class="container-fluid">
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
                        <label>Export To Excel</label>
                        <button
                            class="btn btn-primary btn-sm pull-right"
                        >
                            Export
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <b-table :items="targets.data" :fields="fields" show-empty>
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(omset)="row">
                            Rp. {{ row.item.omset | formatNumber }}
                        </template>
                        <template #cell(target)="row">
                            Rp. {{ row.item.target | formatNumber }}
                        </template>
                        <template #cell(date)="row">
                            {{
                                moment(row.item.start_date).format(
                                    "MMMM - YYYY"
                                )
                            }}
                        </template>
                        <template #cell(percent)="row">
                            <h3 class="badge badge-brand">
                                {{
                                    (
                                        (row.item.omset / row.item.target) *
                                        100
                                    ).toFixed(2)
                                }}
                                %
                            </h3>
                        </template>
                        <template #cell(action)="data">
                            <button
                                @click="data.toggleDetails"
                                class="btn btn-brand btn-long btn-round"
                            >
                                <span class="icon">
                                    <span
                                        data-feather="check"
                                        class="fas fa-eye"
                                    ></span
                                ></span>
                                <span class="text">
                                    {{ data.detailsShowing ? "Hide" : "Show" }}
                                    Detail
                                </span>
                            </button>
                        </template>
                        <template #row-details="row">
                            <b-card>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <Progress
                                                    strokeColor="#00C58E"
                                                    :transitionDuration="1000"
                                                    :radius="50"
                                                    :strokeWidth="10"
                                                    :value="
                                                        (
                                                            (row.item.omset /
                                                                row.item
                                                                    .target) *
                                                            100
                                                        ).toFixed(2)
                                                    "
                                                >
                                                    <template v-slot:footer>
                                                        <b
                                                            >Bulan
                                                            {{
                                                                moment(
                                                                    row.item
                                                                        .start_date
                                                                ).format(
                                                                    "MMMM - YYYY"
                                                                )
                                                            }}</b
                                                        >
                                                    </template>
                                                </Progress>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-card>
                        </template>
                    </b-table>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import Progress from "easy-circular-progress";
import moment from "moment";
import { mapActions, mapState } from "vuex";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { VueMomentsAgo, Progress },
    created() {
        this.getTarget({
            month: this.month,
            year: this.year
        });
    },

    data() {
        return {
            search: "",
            fields: [
                { key: "index", label: "#" },
                { key: "user.name", label: "Name" },
                { key: "omset", label: "Omset" },
                { key: "target", label: "Target" },
                { key: "date", label: "Date" },
                { key: "percent", label: "Persentase" },
                { key: "action", label: "Aksi" }
            ],
            month: moment().format("MM"),
            year: moment().format("Y")
        };
    },

    computed: {
        ...mapState("target", {
            targets: state => state.targets
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

    watch: {
        month() {
            this.getTarget({
                month: this.month,
                year: this.year
            });
        },
        year() {
            this.getTarget({
                month: this.month,
                year: this.year
            });
        }
    },

    methods: {
        ...mapActions("target", ["getTarget", "removeProduct"]),
    }
};
</script>

<template>
    <div class="rui-snippet-preview demo">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <h5 class="card-title h2">Lead</h5>
                            <div class="form-group">
                                <date-picker
                                    v-model="search"
                                    placeholder="Pilih range tanggal"
                                    range
                                ></date-picker>
                            </div>
                            <div class="form-group">
                                <label for="chat">Chat</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :value="leads"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <h5 class="card-title h2">Report</h5>
                            <div class="form-group">
                                <label for="biaya_iklan">Biaya Iklan</label>
                                <input
                                    id="biaya_iklan"
                                    class="form-control"
                                    type="number"
                                    name="biaya_iklan"
                                    placeholder="Enter page title"
                                    v-model="advReport.biaya_iklan"
                                    required
                                />
                                <p
                                    class="text-danger"
                                    v-if="errors.biaya_iklan"
                                >
                                    {{ errors.biaya_iklan[0] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="cp_wa">CP WA</label>
                                <input
                                    type="number"
                                    id="cp_wa"
                                    class="form-control"
                                    name="cp_wa"
                                    placeholder="Enter page title"
                                    :value="cp_wa.toFixed() || 0"
                                    required
                                    readonly
                                />
                                <p class="text-danger" v-if="errors.cp_wa">
                                    {{ errors.cp_wa[0] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input
                                    id="date"
                                    class="form-control"
                                    type="date"
                                    name="date"
                                    placeholder="Enter page title"
                                    v-model="advReport.date"
                                    required
                                />
                                <p class="text-danger" v-if="errors.date">
                                    {{ errors.date[0] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import { mapState, mapActions, mapMutations } from "vuex";
import DatePicker from "vue2-datepicker";
export default {
    name: "ReportADVForm",
    components: { DatePicker },
    created() {
        this.getAdvReports();
        this.getLeads();

        if (this.$route.name == "adv.report.edit") {
            this.editAdvReport(this.$route.params.id).then(res => {
                this.advReport = {
                    biaya_iklan: res.data.biaya_iklan,
                    cp_wa: res.data.cp_wa,
                    date: res.data.date
                };
            });
        }
    },
    data() {
        return {
            search: "",
            advReport: {
                biaya_iklan: "",
                cp_wa: "",
                date: ""
            }
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("advReport", {
            advReports: state => state.advReports
        }),
        ...mapState("order", {
            leads: state => state.leads
        }),
        cp_wa: function() {
            return this.advReport.biaya_iklan / this.leads
        },
    },
    watch: {
        search() {
            this.getLeads(
                this.convert(this.search[0]) +
                    "+-+" +
                    this.convert(this.search[1])
            );
        }
    },
    methods: {
        ...mapActions("advReport", [
            "getAdvReports",
            "submitAdvReport",
            "editAdvReport",
            "updateAdvReport"
        ]),
        ...mapMutations("advReport", ["SET_ID_UPDATE"]),
        convert(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        },
        ...mapActions("order", ["getLeads"]),
        submit() {
            let form = new FormData();

            form.append("biaya_iklan", this.advReport.biaya_iklan);
            form.append("cp_wa", this.cp_wa.toFixed());
            form.append("date", this.advReport.date);

            if (this.$route.name == "adv.report.add") {
                this.submitAdvReport(form).then(() => {
                    this.csReport = {
                        biaya_iklan: "",
                        cp_wa: "",
                        date: ""
                    };

                    this.$router.push({ name: "adv.report.data" });
                });
            } else if (this.$route.name == "adv.report.edit") {
                this.SET_ID_UPDATE(this.$route.params.id);
                this.updateAdvReport(form).then(() => {
                    this.advReport = {
                        biaya_iklan: "",
                        cp_wa: "",
                        date: ""
                    };
                    this.$router.push({ name: "adv.report.data" });
                });
            }
        }
    }
};
</script>

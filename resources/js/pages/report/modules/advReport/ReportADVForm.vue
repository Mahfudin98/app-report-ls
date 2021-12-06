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
                                    disabled
                                />
                            </div>
                            <div class="form-group">
                                <label for="chat">Omset</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :value="omsetsAdv"
                                    disabled
                                />
                            </div>
                            <div class="form-group">
                                <label for="dashboard">Dashboard</label>
                                <input
                                    id="dashboard"
                                    class="form-control"
                                    type="number"
                                    name="dashboard"
                                    placeholder="Enter page title"
                                    v-model="advReport.dashboard"
                                    required
                                />
                                <p
                                    class="text-danger"
                                    v-if="errors.dashboard"
                                >
                                    {{ errors.dashboard[0] }}
                                </p>
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
                            <div class="form-group">
                                <label
                                    >Berikan keterangan report kamu dibawah
                                    ini!</label
                                >
                                <ckeditor
                                    v-model="advReport.keterangan"
                                    :config="editorConfig"
                                ></ckeditor>
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
import CKEditor from "ckeditor4-vue";
export default {
    name: "ReportADVForm",
    components: { DatePicker, ckeditor: CKEditor.component },
    created() {
        this.getAdvReports();
        this.getLeads();
        this.getOmsets();

        if (this.$route.name == "adv.report.edit") {
            this.editAdvReport(this.$route.params.id).then(res => {
                this.advReport = {
                    biaya_iklan: res.data.biaya_iklan,
                    cp_wa: res.data.cp_wa,
                    date: res.data.date,
                    dashboard: res.data.dashboard,
                    keterangan: res.data.keterangan,
                };
            });
        }
    },
    data() {
        return {
            search: "",
            advReport: {
                biaya_iklan: "",
                dashboard: "",
                keterangan: "",
                cp_wa: "",
                date: ""
            },
            editorConfig: {
                uiColor: '#9AB8F3'
            }
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("advReport", {
            advReports: state => state.advReports
        }),
        ...mapState("order", {
            leads: state => state.leads,
            omsetsAdv: state => state.omsetsAdv
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
            this.getOmsets(
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
        ...mapActions("order", ["getLeads", "getOmsets"]),
        submit() {
            let form = new FormData();

            form.append("biaya_iklan", this.advReport.biaya_iklan);
            form.append("lead", this.leads);
            form.append("dashboard", this.advReport.dashboard);
            form.append("omset", this.omsetsAdv);
            form.append("date_start", this.convert(this.search[0]));
            form.append("date_end", this.convert(this.search[1]));
            form.append("cp_wa", this.cp_wa.toFixed());
            form.append("date", this.advReport.date);
            form.append("keterangan", this.advReport.keterangan);

            if (this.$route.name == "adv.report.add") {
                this.submitAdvReport(form).then(() => {
                    this.csReport = {
                        biaya_iklan: "",
                        dashboard: "",
                        keterangan: "",
                        cp_wa: "",
                        date: ""
                    };
                    this.$swal({
                        background: "#FFFFFF",
                        title: "Ditambah!",
                        text: "Data Berhasil ditambah!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$router.push({ name: "adv.report.data" });
                });
            } else if (this.$route.name == "adv.report.edit") {
                this.SET_ID_UPDATE(this.$route.params.id);
                this.updateAdvReport(form).then(() => {
                    this.advReport = {
                        biaya_iklan: "",
                        dashboard: "",
                        keterangan: "",
                        cp_wa: "",
                        date: ""
                    };
                    this.$swal({
                        background: "#FFFFFF",
                        title: "Diupdate!",
                        text: "Data Berhasil diupdate!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$router.push({ name: "adv.report.data" });
                });
            }
        }
    }
};
</script>

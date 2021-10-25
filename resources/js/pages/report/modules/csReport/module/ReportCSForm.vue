<template>
    <div class="rui-snippet-preview demo">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="form-group">
                                <label for="chat">Chat</label>
                                <input
                                    id="chat"
                                    class="form-control"
                                    type="number"
                                    name="chat"
                                    placeholder="Masukan Jumlah Lead"
                                    v-model="csReport.chat"
                                    required
                                />
                                <p class="text-danger" v-if="errors.chat">
                                    {{ errors.chat[0] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="transaksi">Transaksi</label>
                                <input
                                    id="transaksi"
                                    class="form-control"
                                    type="number"
                                    name="transaksi"
                                    v-model="csReport.transaksi"
                                    readonly
                                />
                                <p class="text-danger" v-if="errors.transaksi">
                                    {{ errors.transaksi[0] }}
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
                                    v-model="csReport.date"
                                    readonly
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
export default {
    name: "AddReportCS",
    created() {
        this.viewCsReport(this.$route.params.date);
    },
    data() {
        return {
            csReport: {
                chat: "",
                transaksi: 0,
                date: this.$route.params.date
            }
        };
    },
    computed: {
        ...mapState("csReport", {
            reportcs: state => state.reportcs
        }),
    },
    methods: {
        ...mapState(["errors"]),
        ...mapActions("csReport", ["viewCsReport", "submitCsReport"]),
        submit() {
            let form = new FormData();
            form.append("chat", this.csReport.chat);
            form.append("transaksi", this.csReport.transaksi);
            form.append("date", this.$route.params.date);
            this.submitCsReport(form).then(() => {
                this.csReport = {
                    chat: "",
                    transaksi: 0,
                    date: this.$route.params.date
                };
                this.$swal({
                    background: "#FFFFFF",
                    title: "Ditambah!",
                    text: "Data Berhasil ditambah!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }
    }
};
</script>

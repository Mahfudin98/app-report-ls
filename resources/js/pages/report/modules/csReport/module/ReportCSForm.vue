<template>
    <div class="container-fluid p-0">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="mb-3">
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
                            <div class="mb-3">
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
                            <div class="mb-3">
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
                            <div class="mb-3">
                                <label
                                    >Berikan keterangan report kamu dibawah
                                    ini!</label
                                >
                                <ckeditor
                                    v-model="csReport.description"
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
import CKEditor from "ckeditor4-vue";
export default {
    name: "AddReportCS",
    components: {
        // Use the <ckeditor> component in this view.
        ckeditor: CKEditor.component
    },
    created() {
        this.viewCsReport(this.$route.params.date);
    },
    data() {
        return {
            csReport: {
                chat: "",
                transaksi: 0,
                date: this.$route.params.date,
                description: "",
            },
            editorConfig: {
                uiColor: '#9AB8F3'
            }
        };
    },
    computed: {
        ...mapState("csReport", {
            reportcs: state => state.reportcs
        })
    },
    methods: {
        ...mapState(["errors"]),
        ...mapActions("csReport", ["viewCsReport", "submitCsReport"]),
        submit() {
            let form = new FormData();
            form.append("chat", this.csReport.chat);
            form.append("transaksi", this.csReport.transaksi);
            form.append("date", this.$route.params.date);
            form.append("description", this.csReport.description);
            this.submitCsReport(form).then(() => {
                this.csReport = {
                    chat: "",
                    transaksi: 0,
                    date: this.$route.params.date,
                    description: "",
                };
                this.$swal({
                    background: "#FFFFFF",
                    title: "Ditambah!",
                    text: "Data Berhasil ditambah!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
                window.location.reload();
            });
        }
    }
};
</script>

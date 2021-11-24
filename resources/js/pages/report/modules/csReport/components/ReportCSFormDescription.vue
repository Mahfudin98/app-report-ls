<template>
    <div class="rui-snippet-preview demo">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-6">
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label
                            >Berikan keterangan report kamu dibawah ini!</label
                        >
                        <ckeditor
                            v-model="csReport.description"
                            :config="editorConfig"
                        ></ckeditor>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import CKEditor from "ckeditor4-vue";
import { mapActions, mapState, mapMutations } from "vuex";
export default {
    name: "FormDescription",
    components: {
        // Use the <ckeditor> component in this view.
        ckeditor: CKEditor.component
    },
    created() {
        this.viewCsReport(this.$route.params.date).then(res => {
                this.csReport = {
                    chat: res.chat,
                    transaksi: res.transaksi,
                    date: this.$route.params.date,
                    description: res.description,
                };
            });
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
        }),
        getID(){
            var result = this.reportcs.id;
            // var res = Object.keys(result).map(function(key) {
            //     return parseInt(result[key].id);
            // });
            return result;
        }
    },
    methods: {
        ...mapState(["errors"]),
        ...mapMutations("csReport", ["SET_ID_UPDATE"]),
        ...mapActions("csReport", ["viewCsReport", "updateCsReport"]),
        submit() {
            let form = new FormData();
            form.append("chat", this.csReport.chat);
            form.append("transaksi", this.csReport.transaksi);
            form.append("date", this.$route.params.date);
            form.append("description", this.csReport.description);
            this.SET_ID_UPDATE(this.getID);
            this.updateCsReport(form).then(() => {
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
                this.$router.push({ name: 'report.data.date', params: { date: this.$route.params.date } });
            });
        }
    }
};
</script>

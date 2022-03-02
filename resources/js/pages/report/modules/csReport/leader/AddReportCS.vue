<template>
<b-modal id="addReportCS" title="Add Report CS">
    <div class="container-fluid p-0">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="mb-3">
                                <label for="chat">Chat</label>
                                <input id="chat" class="form-control" type="number" name="chat" placeholder="Masukan Jumlah Lead" v-model="csReport.chat" required />
                                <p class="text-danger" v-if="errors.chat">
                                    {{ errors.chat[0] }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="transaksi">Transaksi</label>
                                <input id="transaksi" class="form-control" type="number" name="transaksi" v-model="csReport.transaksi" readonly />
                                <p class="text-danger" v-if="errors.transaksi">
                                    {{ errors.transaksi[0] }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="date">Date</label>
                                <input id="date" class="form-control" type="date" name="date" placeholder="Enter page title" v-model="csReport.date" readonly />
                                <p class="text-danger" v-if="errors.date">
                                    {{ errors.date[0] }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Berikan keterangan report kamu dibawah
                                    ini!</label>
                                <ckeditor v-model="csReport.description" :config="editorConfig"></ckeditor>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <template #modal-footer>
        <div class="w-100">
            <!-- <b-button variant="primary" size="sm" class="float-left" @click="submit" :disabled="checkVal">
                Simpan
            </b-button> -->
            <b-overlay :show="busy" rounded opacity="0.6" spinner-small spinner-variant="primary" class="d-inline-block float-right mb-2" @hidden="onHidden">
                <button ref="button" :disabled="busy" @click="onClick" class="btn btn-primary">
                    <span class="material-icons align-middle">
                        save
                    </span>
                    <span class="align-middle">Save</span>
                </button>
                <!-- <b-button ref="button" :disabled="busy" variant="brand" @click="onClick">
                    Save <b-icon  icon="upload" aria-hidden="true"></b-icon>
                </b-button> -->
            </b-overlay>
        </div>
    </template>
</b-modal>
</template>

<script>
import {
    mapState,
    mapActions,
    mapMutations
} from "vuex";
import CKEditor from "ckeditor4-vue";
export default {
    name: "AddReportCSLeader",
    components: {
        // Use the <ckeditor> component in this view.
        ckeditor: CKEditor.component
    },
    created() {
        this.viewDetailCsReport({
            id: this.$route.params.id,
            date: this.$route.params.date
        });
    },
    data() {
        return {
            busy: false,
            timeout: null,

            csReport: {
                user_id: this.$route.params.id,
                chat: "",
                transaksi: 0,
                date: this.$route.params.date,
                description: ""
            },
            editorConfig: {
                uiColor: "#9AB8F3"
            }
        };
    },
    beforeDestroy() {
        this.clearTimeout();
    },
    computed: {
        ...mapState("csReport", {
            viewDetail: state => state.viewDetail
        }),
    },
    methods: {
        ...mapState(["errors"]),
        ...mapActions("csReport", ["viewDetailCsReport", "submitCsReportLeader"]),
        submit() {
            let form = new FormData();
            form.append("user_id", this.csReport.user_id);
            form.append("chat", this.csReport.chat);
            form.append("transaksi", this.csReport.transaksi);
            form.append("date", this.$route.params.date);
            form.append("description", this.csReport.description);
            this.submitCsReportLeader(form).then(() => {
                this.csReport = {
                    user_id: this.$route.params.id,
                    chat: "",
                    transaksi: 0,
                    date: this.$route.params.date,
                    description: ""
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
        },

        // button
        clearTimeout() {
            if (this.timeout) {
                clearTimeout(this.timeout);
                this.timeout = null;
            }
        },
        setTimeout(callback) {
            this.clearTimeout();
            this.timeout = setTimeout(() => {
                this.clearTimeout();
                callback();
            }, 10000);
        },
        onHidden() {
            // Return focus to the button once hidden
            this.$refs.button.focus();
        },
        onClick() {
            this.busy = true;
            // Simulate an async request
            this.setTimeout(() => {
                this.busy = false;
            });
            this.submit();
            window.location.reload();
        }
    }
};
</script>

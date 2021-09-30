<template>
    <div class="rui-snippet-preview demo">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <h5 class="card-title h2">Order</h5>
                            <section
                                class="demo-colors bg-dark text-white"
                                v-for="(find, index) in finds"
                                :key="index"
                            >
                                <div class="form-group">
                                    <label for="produk" class="text-white"
                                        >Produk</label
                                    >
                                    <select
                                        name="product_id[]"
                                        id="product"
                                        class="form-control"
                                        v-model="csReport.product_id[index]"
                                        required
                                    >
                                        <option selected disabled="" value=""
                                            >Pilih Produk</option
                                        >
                                        <option
                                            v-for="(row,
                                            index) in products.data"
                                            :key="index"
                                            :value="row.id"
                                            >{{ row.name }}</option
                                        >
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="order" class="text-white"
                                        >Total Order</label
                                    >
                                    <input
                                        class="form-control"
                                        required
                                        type="number"
                                        name="total_order[]"
                                        placeholder="Jumlah Order Product"
                                        v-model="csReport.total_order[index]"
                                    />
                                </div>
                                <div class="form-group">
                                    <button
                                        class="btn btn-danger"
                                        type="button"
                                        @click="removeFind"
                                    >
                                        <i class="fas fa-trash"></i>Delete
                                    </button>
                                </div>
                            </section>
                        </div>
                        <div class="card-footer">
                            <button
                                class="btn btn-brand"
                                type="button"
                                @click="addFind"
                            >
                                <span class="icon">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add Product</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <h5 class="card-title h2">Report</h5>
                            <div class="form-group">
                                <label for="chat">Chat</label>
                                <input
                                    id="chat"
                                    class="form-control"
                                    type="number"
                                    name="chat"
                                    placeholder="Enter page title"
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
                                    type="number"
                                    id="transaksi"
                                    class="form-control"
                                    name="transaksi"
                                    placeholder="Enter page title"
                                    v-model="csReport.transaksi"
                                    required
                                />
                                <p class="text-danger" v-if="errors.transaksi">
                                    {{ errors.transaksi[0] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="omset">Omset</label>
                                <input
                                    class="form-control"
                                    id="omset"
                                    type="number"
                                    name="omset"
                                    placeholder="Enter page title"
                                    v-model="csReport.omset"
                                    required
                                />
                                <p class="text-danger" v-if="errors.omset">
                                    {{ errors.omset[0] }}
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
export default {
    name: "ReportCSForm",
    created() {
        this.getCsReports();
        this.getProducts();

        if (this.$route.name == "cs.report.edit") {
            this.editCSReport(this.$route.params.id).then(res => {
                this.csReport = {
                    chat: res.data.chat,
                    transaksi: res.data.transaksi,
                    omset: res.data.omset,
                    date: res.data.date
                };
            });
        }
    },
    data() {
        return {
            finds: [],
            csReport: {
                chat: "",
                transaksi: "",
                omset: "",
                date: "",
                // for order
                product_id: [""],
                total_order: [""]
            }
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("csReport", {
            csReports: state => state.csReports
        }),
        ...mapState("product", {
            products: state => state.products
        })
    },
    methods: {
        addFind: function() {
            this.finds.push({ value: "" });
        },
        removeFind(index) {
            this.finds.splice(index, 1);
        },
        ...mapActions("product", ["getProducts"]),
        ...mapActions("csReport", [
            "getCsReports",
            "submitTeam",
            "editTeam",
            "updateTeam"
        ]),
        ...mapMutations("csReport", ["SET_ID_UPDATE"]),

        submit() {
            let form = new FormData();

            form.append("chat", this.csReport.chat);
            form.append("transaksi", this.csReport.transaksi);
            form.append("omset", this.csReport.omset);
            form.append("date", this.csReport.date);
            // array order
            for (var i = 0; i < this.csReport.total_order.length; i++) {
                let total_order = this.csReport.total_order[i];
                let product_id = this.csReport.product_id[i];
                form.append("total_order[" + i + "]", total_order);
                form.append("product_id[" + i + "]", product_id);
            }

            if (this.$route.name == "cs.report.add") {
                this.submitTeam(form).then(() => {
                    this.csReport = {
                        chat: "",
                        transaksi: "",
                        omset: "",
                        date: "",
                        // for order
                        product_id: [""],
                        total_order: [""]
                    };

                    this.$router.push({ name: "cs.report.data" });
                });
            } else if (this.$route.name == "cs.report.edit") {
                this.SET_ID_UPDATE(this.$route.params.id);
                this.updateCsReport(form).then(() => {
                    this.csReport = {
                        chat: "",
                        transaksi: "",
                        omset: "",
                        date: "",
                        // for order
                        product_id: [""],
                        total_order: [""]
                    };
                    this.$router.push({ name: "cs.report.data" });
                });
            }
        }
    }
};
</script>

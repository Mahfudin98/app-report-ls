<template>
    <div class="rui-snippet-preview demo">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="form-group">
                                <label for="position_id">Posisi</label>
                                <select
                                    name="position_id"
                                    class="form-control"
                                    id="position_id"
                                    v-model="inventoriUsage.position_id"
                                >
                                    <option value="" disabled
                                        >Pilih Posisi</option
                                    >
                                    <option v-for="row in positions.data" :key="row.id" :value="row.id">{{row.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inventory_id">Nama Barang</label>
                                <select
                                    name="inventory_id"
                                    class="form-control"
                                    id="inventory_id"
                                    v-model="inventoriUsage.inventory_id"
                                >
                                    <option value="" disabled
                                        >Pilih Barang</option
                                    >
                                    <option v-for="row in inventorys.data" :key="row.id" :value="row.id">{{row.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="form-group">
                                <label for="jumlah">Jumlah Barang</label>
                                <input
                                    id="jumlah"
                                    class="form-control"
                                    type="number"
                                    name="jumlah"
                                    placeholder="Enter page title"
                                    v-model="inventoriUsage.jumlah"
                                    required
                                />
                                <p class="text-danger" v-if="errors.jumlah">
                                    {{ errors.jumlah[0] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="kondisi">Kondisi</label>
                                <select
                                    name="kondisi"
                                    class="form-control"
                                    id="kondisi"
                                    v-model="inventoriUsage.kondisi"
                                >
                                    <option value="" disabled
                                        >Pilih Kondisi</option
                                    >
                                    <option :value="1">Baik</option>
                                    <option :value="0">Buruk</option>
                                </select>
                                <p class="text-danger" v-if="errors.kondisi">
                                    {{ errors.kondisi[0] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="form-group">
                                <label for="keterngan">Keterangan</label>
                                <textarea
                                    class="form-control"
                                    v-model="inventoriUsage.keterngan"
                                    id="keterngan"
                                ></textarea>
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
        this.getPositions();
        this.getInventorys();
        if (this.$route.name == "adv.report.edit") {
            this.editAdvReport(this.$route.params.id).then(res => {
                this.inventoriUsage = {
                    kondisi: res.data.kondisi,
                    cp_wa: res.data.cp_wa,
                    date: res.data.date
                };
            });
        }
    },
    data() {
        return {
            inventoriUsage: {
                position_id: "",
                inventory_id: "",
                jumlah: "",
                kondisi: "",
                keterngan: ""
            }
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("inventory", {
            inventorys: state => state.inventorys,
            inventoriUsages: state => state.inventoriUsages
        }),
        ...mapState("position", {
            positions: state => state.positions
        })
    },
    methods: {
        ...mapActions("inventory", ["getInventorys", "getInventorUsages", "submitInventoriUsage"]),
        ...mapMutations("inventory", ["SET_ID_UPDATE"]),
        ...mapActions("position", ["getPositions"]),
        submit() {
            let form = new FormData();

            form.append("position_id", this.inventoriUsage.position_id);
            form.append("inventory_id", this.inventoriUsage.inventory_id);
            form.append("jumlah", this.inventoriUsage.jumlah);
            form.append("kondisi", this.inventoriUsage.kondisi);
            form.append("keterngan", this.inventoriUsage.keterngan);

            if (this.$route.name == "inventory.usage.add") {
                this.submitInventoriUsage(form).then(() => {
                    this.inventoriUsage = {
                        position_id: "",
                        inventory_id: "",
                        jumlah: "",
                        kondisi: "",
                        keterngan: ""
                    };

                    this.$router.push({ name: "inventory.usage" });
                });
            } else if (this.$route.name == "adv.report.edit") {
                this.SET_ID_UPDATE(this.$route.params.id);
                this.updateAdvReport(form).then(() => {
                    this.inventoriUsage = {
                        position_id: "",
                        inventory_id: "",
                        jumlah: "",
                        kondisi: "",
                        keterngan: ""
                    };
                    this.$router.push({ name: "adv.report.data" });
                });
            }
        }
    }
};
</script>

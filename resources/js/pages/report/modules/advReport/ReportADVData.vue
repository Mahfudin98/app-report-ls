<template>
    <main>
        <page-loader />
        <div class="rui-page-content">
            <div class="container-fluid">
                <div
                    class="d-flex justify-content-between align-items-center mb-20"
                >
                    <div class="row xs-gap">
                        <div class="col-12">
                            <div class="input-group">
                                <date-picker
                                    v-model="search"
                                    placeholder="Pilih range tanggal"
                                    range
                                ></date-picker>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <b-table
                        :items="advReports.data"
                        :fields="fields"
                        show-empty
                    >
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(biaya_iklan)="row">
                            Rp. {{ row.item.biaya_iklan | formatNumber }}
                        </template>
                        <template #cell(cp_wa)="row">
                            Rp. {{ row.item.cp_wa | formatNumber }}
                        </template>
                        <template #cell(date)="row">
                            {{ row.item.date }}
                        </template>
                        <template #cell(created_at)="row">
                            <vue-moments-ago
                                prefix="posted"
                                suffix="ago"
                                :date="row.item.created_at"
                                lang="en"
                            />
                        </template>
                        <template #cell(action)>
                            <div class="btn-group dropdown dropdown-triangle">
                                <button
                                    class="btn btn-brand btn-long dropdown-toggle"
                                    type="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <span class="text">Action</span>
                                    <span class="icon">
                                        <span class="fas fa-angle-down"></span>
                                    </span>
                                </button>
                                <ul class="dropdown-menu nav">
                                    <li>
                                        <a class="nav-link" href="#"
                                            ><span
                                                data-feather="plus-circle"
                                                class="fas fa-edit"
                                            ></span
                                            ><span>Edit</span
                                            ><span class="rui-nav-circle"></span
                                        ></a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#"
                                            ><span
                                                data-feather="x-circle"
                                                class="fas fa-trash"
                                            ></span
                                            ><span>Delete</span
                                            ><span class="rui-nav-circle"></span
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                        </template>
                    </b-table>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import PageLoader from "../../../../components/PageLoader.vue";
import { mapActions, mapState } from "vuex";
import DatePicker from "vue2-datepicker";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { VueMomentsAgo, DatePicker, PageLoader },
    name: "DataReportADV",

    created() {
        this.getAdvReports();
    },

    data() {
        return {
            search: {},
            fields: [
                { key: "index", label: "#" },
                { key: "biaya_iklan", label: "Biaya Iklan" },
                { key: "cp_wa", label: "CP WA" },
                { key: "date", label: "Date" },
                { key: "created_at", label: "Created At" },
                { key: "action", label: "Aksi" }
            ]
        };
    },

    computed: {
        ...mapState("advReport", {
            advReports: state => state.advReports
        })
    },

    watch: {
        search() {
            this.getAdvReports(
                this.convert(this.search[0]) +
                    "+-+" +
                    this.convert(this.search[1])
            );
        }
    },

    methods: {
        convert(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        },
        ...mapActions("advReport", ["getAdvReports", "removePosition"]),
        deletePosition(id) {
            this.$swal({
                title: "Kamu Yakin?",
                text: "Tindakan ini akan menghapus secara permanent!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, Lanjutkan!"
            }).then(result => {
                if (result.value) {
                    this.removePosition(id);
                }
            });
        }
    }
};
</script>

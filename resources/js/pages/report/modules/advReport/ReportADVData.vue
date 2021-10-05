<template>
    <div class="rui-page-content">
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <div class="row xs-gap">
                    <div class="col-12">
                        <div class="input-group">
                            <date-picker v-model="search" placeholder="Pilih range tanggal" range></date-picker>
                        </div>
                    </div>
                </div>
                <router-link
                    :to="{ name: 'adv.report.add' }"
                    class="btn btn-brand"
                >
                    <span class="icon"
                        ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-plus rui-icon rui-icon-stroke-1_5"
                        >
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line></svg
                    ></span>
                    <span class="text">Add Report</span>
                </router-link>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr class="users-table-info">
                            <th scope="col">Biaya Iklan</th>
                            <th scope="col">CP WA</th>
                            <th scope="col">Date</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in advReports.data" :key="row.id">
                            <th class="text-center">Rp. {{ row.biaya_iklan | formatNumber }}</th>
                            <td>Rp. {{ row.cp_wa | formatNumber }}</td>
                            <td>{{ row.date }}</td>
                            <td>
                                <vue-moments-ago
                                    prefix="posted"
                                    suffix="ago"
                                    :date="row.created_at"
                                    lang="en"
                                />
                            </td>
                            <td>
                                <div
                                    class="btn-group dropdown dropdown-triangle"
                                >
                                    <button
                                        class="btn btn-brand btn-long dropdown-toggle"
                                        type="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <span class="text">Action</span>
                                        <span class="icon">
                                            <span
                                                class="fas fa-angle-down"
                                            ></span>
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
                                                ><span
                                                    class="rui-nav-circle"
                                                ></span
                                            ></a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#"
                                                ><span
                                                    data-feather="x-circle"
                                                    class="fas fa-trash"
                                                ></span
                                                ><span>Delete</span
                                                ><span
                                                    class="rui-nav-circle"
                                                ></span
                                            ></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from "vuex";
import DatePicker from "vue2-datepicker";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { VueMomentsAgo, DatePicker },
    name: "DataReportADV",

    created() {
        this.getAdvReports();
    },

    data() {
        return {
            search: {},
        };
    },

    computed: {
        ...mapState("advReport", {
            advReports: state => state.advReports
        })
    },

    watch: {
        search() {
            this.getAdvReports(this.convert(this.search[0])+'+-+'+this.convert(this.search[1]));
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

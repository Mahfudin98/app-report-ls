<template>
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
                <router-link
                    :to="{ name: 'cs.report.add' }"
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
                            <th scope="col">Chat</th>
                            <th scope="col">Transaksi</th>
                            <th scope="col">Order</th>
                            <th scope="col">Omset</th>
                            <th scope="col">Date</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in csReports.data" :key="row.id">
                            <th class="text-center">{{ row.chat }}</th>
                            <td class="text-center">{{ row.transaksi }}</td>
                            <td>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-group">
                                        <a
                                            class="collapse-link d-flex justify-content-between align-items-center"
                                            :href="'#order' + row.id"
                                            id="headingOne"
                                            data-toggle="collapse"
                                            aria-expanded="true"
                                            aria-controls="collapseOne"
                                        >
                                            Order
                                            <span
                                                class="badge badge-brand badge-circle"
                                                >{{ row.order.length }}</span
                                            >
                                        </a>
                                        <div
                                            :id="'order' + row.id"
                                            class="collapse"
                                            aria-labelledby="headingOne"
                                            data-parent="#accordionExample"
                                        >
                                            <div class="collapse-content">
                                                <ul class="list-group">
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center"
                                                        v-for="(item,
                                                        index) in row.order"
                                                        :key="index"
                                                    >
                                                        {{ item.product.name }}
                                                        <span
                                                            class="badge badge-brand badge-circle"
                                                            >{{
                                                                item.total_order
                                                            }}</span
                                                        >
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Rp. {{ row.omset | formatNumber }}</td>
                            <td>
                                {{ row.date }}
                            </td>
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
                        <tr v-if="csReports.data == 0">
                            <td class="text-center" colspan="7">
                                <h5>Data tidak ditemukan</h5>
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
import moment from "moment";
export default {
    components: { VueMomentsAgo, DatePicker },
    name: "DataReportCS",

    created() {
        this.getCsReports();
    },

    data() {
        return {
            range: {},
            search: {}
        };
    },

    computed: {
        ...mapState("csReport", {
            csReports: state => state.csReports
        })
    },

    watch: {
        search() {
            this.getCsReports(
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
        ...mapActions("csReport", ["getCsReports", "removePosition"]),
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

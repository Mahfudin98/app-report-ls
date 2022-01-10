<template>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <select v-model="month" class="form-control">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select v-model="year" class="form-control">
                                <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" v-if="authenticated.role == 0 || $can('add teams')">
                        <div class="form-group">
                            <label>Add Target</label>
                            <router-link :to="{name: 'target.add'}" class="btn btn-primary">
                                <span class="material-icons align-middle">
                                    add_circle_outline
                                </span>
                                <span class="align-middle">Add Target</span>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <b-table :items="targets.data" :fields="fields" show-empty>
                        <template #cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template #cell(omset)="row">
                            Rp. {{ row.item.omset | formatNumber }}
                        </template>
                        <template #cell(target)="row">
                            Rp. {{ row.item.target | formatNumber }}
                        </template>
                        <template #cell(date)="row">
                            {{
                                moment(row.item.start_date).format(
                                    "MMMM - YYYY"
                                )
                            }}
                        </template>
                        <template #cell(percent)="row">
                            <h3 class="badge bg-primary rounded-pill">
                                {{
                                    (
                                        (row.item.omset / row.item.target) *
                                        100
                                    ).toFixed(2)
                                }}
                                %
                            </h3>
                        </template>
                        <template #cell(action)="data">
                            <button @click="data.toggleDetails" class="btn btn-primary btn-long btn-round">
                                <span class="material-icons align-middle">
                                    visibility
                                </span>
                                <span class="align-middle">View Detail</span>
                            </button>
                        </template>
                        <template #row-details="row">
                            <b-card>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card" v-if="
                                                authenticated.role == 0 ||
                                                    $can('edit teams')
                                            ">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <span class="material-icons align-middle">
                                                        settings
                                                    </span>
                                                    <span class="align-middle">Setting</span>
                                                </h5>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button @click="exportData" class="btn btn-primary btn-long">
                                                            <span class="material-icons align-middle">
                                                                file_download
                                                            </span>
                                                            <span class="align-middle">Export</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <router-link :to="{ name: 'target.edit', params: { id: row.item.id}}" class="btn btn-warning">
                                                            <span class="material-icons align-middle">
                                                                edit
                                                            </span>
                                                            <span class="align-middle">Edit</span>
                                                        </router-link>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="btn btn-danger" @click=" deleteTarget(row.item.id)">
                                                            <span class="material-icons align-middle">
                                                                delete
                                                            </span>
                                                            <span class="align-middle">Hapus</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <span class="align-middle">Persentase</span>
                                                    <span class="material-icons align-middle">
                                                        percent
                                                    </span>
                                                </h5>
                                                <Progress strokeColor="#00C58E" :transitionDuration="1000" :radius="50" :strokeWidth="10" :value="
                                                        (
                                                            (row.item.omset /
                                                                row.item
                                                                    .target) *
                                                            100
                                                        ).toFixed(2)
                                                    ">
                                                    <template v-slot:footer>
                                                        <b>Bulan
                                                            {{
                                                                moment(
                                                                    row.item
                                                                        .start_date
                                                                ).format(
                                                                    "MMMM - YYYY"
                                                                )
                                                            }}</b>
                                                    </template>
                                                </Progress>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    List Persentase CS
                                                </h5>
                                                <b-table :items="row.item.user.child" :fields="csdetail" show-empty>
                                                    <template #cell(name)="datas">
                                                        {{ datas.item.name }}
                                                    </template>
                                                    <template #cell(order)="datas">
                                                        {{
                                                            datas.item.order_detail
                                                                .filter(
                                                                    itemInArray =>
                                                                        itemInArray.status ===
                                                                            1 &&
                                                                        moment(
                                                                            itemInArray.date
                                                                        ).format(
                                                                            "M"
                                                                        ) ===
                                                                            month
                                                                )
                                                                .reduce(
                                                                    (
                                                                        acc,
                                                                        item
                                                                    ) =>
                                                                        acc +
                                                                        item.qty,
                                                                    0
                                                                )
                                                        }}
                                                    </template>
                                                    <template #cell(omsets)="datas">
                                                        Rp.
                                                        {{
                                                            datas.item.order_detail
                                                                .filter(
                                                                    itemInArray =>
                                                                        itemInArray.status ===
                                                                            1 &&
                                                                        moment(
                                                                            itemInArray.date
                                                                        ).format(
                                                                            "M"
                                                                        ) ===
                                                                            month
                                                                )
                                                                .reduce(
                                                                    (
                                                                        acc,
                                                                        item
                                                                    ) =>
                                                                        acc +
                                                                        item.subtotal,
                                                                    0
                                                                ) | formatNumber
                                                        }}
                                                    </template>
                                                    <template #cell(targetcs)="datas">
                                                        Rp.
                                                        {{
                                                            (row.item.target /
                                                                row.item.user
                                                                    .child
                                                                    .length)
                                                                | formatNumber
                                                        }}
                                                    </template>
                                                    <template #cell(percents)="datas">
                                                        <h3 class="badge bg-primary rounded-pill">
                                                            {{
                                                                (
                                                                    (datas.item.order_detail
                                                                        .filter(
                                                                            itemInArray =>
                                                                                itemInArray.status ===
                                                                                    1 &&
                                                                                moment(
                                                                                    itemInArray.date
                                                                                ).format(
                                                                                    "M"
                                                                                ) ===
                                                                                    month
                                                                        )
                                                                        .reduce(
                                                                            (
                                                                                acc,
                                                                                item
                                                                            ) =>
                                                                                acc +
                                                                                item.subtotal,
                                                                            0
                                                                        ) /
                                                                        (row
                                                                            .item
                                                                            .target /
                                                                            row
                                                                                .item
                                                                                .user
                                                                                .child
                                                                                .length)) *
                                                                    100
                                                                ).toFixed(2)
                                                            }}
                                                            %
                                                        </h3>
                                                    </template>
                                                </b-table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-card>
                        </template>
                    </b-table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <main>
    <div class="rui-page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Bulan</label>
                        <select v-model="month" class="form-control">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Tahun</label>
                        <select v-model="year" class="form-control">
                            <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2" v-if="authenticated.role == 0 || $can('add teams')">
                    <div class="form-group">
                        <label>Add Target</label>
                        <router-link :to="{
                                    name: 'target.add'
                                }" class="btn btn-brand">
                            <span class="icon">
                                <span class="fas fa-plus"></span>
                            </span>
                            <span class="text">Add Target</span>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <b-table :items="targets.data" :fields="fields" show-empty>
                    <template #cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template #cell(omset)="row">
                        Rp. {{ row.item.omset | formatNumber }}
                    </template>
                    <template #cell(target)="row">
                        Rp. {{ row.item.target | formatNumber }}
                    </template>
                    <template #cell(date)="row">
                        {{
                                moment(row.item.start_date).format(
                                    "MMMM - YYYY"
                                )
                            }}
                    </template>
                    <template #cell(percent)="row">
                        <h3 class="badge bg-primary rounded-pill">
                            {{
                                    (
                                        (row.item.omset / row.item.target) *
                                        100
                                    ).toFixed(2)
                                }}
                            %
                        </h3>
                    </template>
                    <template #cell(action)="data">
                        <button @click="data.toggleDetails" class="btn btn-brand btn-long btn-round">
                            <span class="icon">
                                <span data-feather="check" class="fas fa-eye"></span></span>
                            <span class="text">
                                {{ data.detailsShowing ? "Hide" : "Show" }}
                                Detail
                            </span>
                        </button>
                    </template>
                    <template #row-details="row">
                        <b-card>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" v-if="
                                                authenticated.role == 0 ||
                                                    $can('edit teams')
                                            ">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                Setting
                                                <span class="fas fa-cog"></span>
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button @click="exportData" class="btn btn-brand btn-long">
                                                        <span class="icon">
                                                            <span class="fas fa-file-export"></span>
                                                        </span>
                                                        <span class="text">Export</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <router-link :to="{
                                                                name:
                                                                    'target.edit',
                                                                params: {
                                                                    id:
                                                                        row.item
                                                                            .id
                                                                }
                                                            }" class="btn btn-warning">
                                                        <span class="icon">
                                                            <span class="fas fa-edit"></span>
                                                        </span>
                                                        <span class="text">Edit</span>
                                                    </router-link>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-danger" @click="
                                                                deleteTarget(
                                                                    row.item.id
                                                                )
                                                            ">
                                                        <span class="icon">
                                                            <span class="fas fa-trash"></span>
                                                        </span>
                                                        <span class="text">Hapus</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                Persentase
                                                <span class="fas fa-percentage"></span>
                                            </h5>
                                            <Progress strokeColor="#00C58E" :transitionDuration="1000" :radius="50" :strokeWidth="10" :value="
                                                        (
                                                            (row.item.omset /
                                                                row.item
                                                                    .target) *
                                                            100
                                                        ).toFixed(2)
                                                    ">
                                                <template v-slot:footer>
                                                    <b>Bulan
                                                        {{
                                                                moment(
                                                                    row.item
                                                                        .start_date
                                                                ).format(
                                                                    "MMMM - YYYY"
                                                                )
                                                            }}</b>
                                                </template>
                                            </Progress>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                List Persentase CS
                                            </h5>
                                            <b-table :items="row.item.user.child" :fields="csdetail" show-empty>
                                                <template #cell(name)="datas">
                                                    {{ datas.item.name }}
                                                </template>
                                                <template #cell(order)="datas">
                                                    {{
                                                            datas.item.order_detail
                                                                .filter(
                                                                    itemInArray =>
                                                                        itemInArray.status ===
                                                                            1 &&
                                                                        moment(
                                                                            itemInArray.date
                                                                        ).format(
                                                                            "M"
                                                                        ) ===
                                                                            month
                                                                )
                                                                .reduce(
                                                                    (
                                                                        acc,
                                                                        item
                                                                    ) =>
                                                                        acc +
                                                                        item.qty,
                                                                    0
                                                                )
                                                        }}
                                                </template>
                                                <template #cell(omsets)="datas">
                                                    Rp.
                                                    {{
                                                            datas.item.order_detail
                                                                .filter(
                                                                    itemInArray =>
                                                                        itemInArray.status ===
                                                                            1 &&
                                                                        moment(
                                                                            itemInArray.date
                                                                        ).format(
                                                                            "M"
                                                                        ) ===
                                                                            month
                                                                )
                                                                .reduce(
                                                                    (
                                                                        acc,
                                                                        item
                                                                    ) =>
                                                                        acc +
                                                                        item.subtotal,
                                                                    0
                                                                ) | formatNumber
                                                        }}
                                                </template>
                                                <template #cell(targetcs)="datas">
                                                    Rp.
                                                    {{
                                                            (row.item.target /
                                                                row.item.user
                                                                    .child
                                                                    .length)
                                                                | formatNumber
                                                        }}
                                                </template>
                                                <template #cell(percents)="datas">
                                                    <h3 class="badge bg-primary rounded-pill">
                                                        {{
                                                                (
                                                                    (datas.item.order_detail
                                                                        .filter(
                                                                            itemInArray =>
                                                                                itemInArray.status ===
                                                                                    1 &&
                                                                                moment(
                                                                                    itemInArray.date
                                                                                ).format(
                                                                                    "M"
                                                                                ) ===
                                                                                    month
                                                                        )
                                                                        .reduce(
                                                                            (
                                                                                acc,
                                                                                item
                                                                            ) =>
                                                                                acc +
                                                                                item.subtotal,
                                                                            0
                                                                        ) /
                                                                        (row
                                                                            .item
                                                                            .target /
                                                                            row
                                                                                .item
                                                                                .user
                                                                                .child
                                                                                .length)) *
                                                                    100
                                                                ).toFixed(2)
                                                            }}
                                                        %
                                                    </h3>
                                                </template>
                                            </b-table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </b-card>
                    </template>
                </b-table>
            </div>
        </div>
    </div>
</main> -->
</template>

<script>
import Progress from "easy-circular-progress";
import moment from "moment";
import {
    mapActions,
    mapState
} from "vuex";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: {
        VueMomentsAgo,
        Progress
    },
    created() {
        this.getTargets({
            month: this.month,
            year: this.year
        });
    },

    data() {
        return {
            search: "",
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "user.name",
                    label: "Name"
                },
                {
                    key: "omset",
                    label: "Omset"
                },
                {
                    key: "target",
                    label: "Target"
                },
                {
                    key: "date",
                    label: "Date"
                },
                {
                    key: "percent",
                    label: "Persentase"
                },
                {
                    key: "action",
                    label: "Aksi"
                }
            ],
            csdetail: [{
                    key: "name",
                    label: "Nama CS"
                },
                {
                    key: "order",
                    label: "Order"
                },
                {
                    key: "omsets",
                    label: "Omset"
                },
                {
                    key: "targetcs",
                    label: "Target"
                },
                {
                    key: "percents",
                    label: "Persent"
                }
            ],
            month: moment().format("MM"),
            year: moment().format("Y")
        };
    },

    computed: {
        ...mapState("target", {
            targets: state => state.targets
        }),
        ...mapState("user", {
            authenticated: state => state.authenticated //ME-LOAD STATE AUTHENTICATED
        }),
        years() {
            return _.range(
                2019,
                moment()
                .add(1, "years")
                .format("Y")
            );
        }
    },

    watch: {
        month() {
            this.getTargets({
                month: this.month,
                year: this.year
            });
        },
        year() {
            this.getTargets({
                month: this.month,
                year: this.year
            });
        }
    },

    methods: {
        ...mapActions("target", ["getTargets", "removeTarget"]),
        deleteTarget(id) {
            this.$swal
                .fire({
                    title: "Kamu Yakin?",
                    text: "Tindakan ini akan menghapus secara permanent!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                })
                .then(result => {
                    if (result.isConfirmed) {
                        this.removeTarget(id);
                        this.$swal(
                            "Terhapus!",
                            "Produk sudah dihapus.",
                            "success"
                        );
                        window.location.reload();
                    }
                });
        },

        exportData() {
            window.open(`/api/export/target?api_token=${this.token}&month=${this.month}&year=${this.year}`)
        }
    }
};
</script>

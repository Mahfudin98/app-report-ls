<template>
<main>
    <page-loader />
    <ReportsCSAdd />
    <customer-add />
    <div class="row">
        <div class="col-12" v-if="reportcs == ''">
            <div class="card">
                <!-- <div class="card-header">
                    <h5 class="card-title mb-0">Empty card</h5>
                </div> -->
                <div class="card-body text-center">
                    <button v-b-modal.addReportCS type="button" class="btn btn-primary">
                        <i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Add Report CS</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-4" v-if="reportcs != ''">
            <div class="card">
                <div class="card-header px-4 pt-4">
                    <div class="card-actions float-end">
                        <!-- <button class="btn btn-warning"><i class="fas fa-exclamation"></i> Warning</button> -->
                        <router-link :to="{ name: 'report.edit.order', params: { date: reportcs.date } }" class="btn btn-warning text-white">
                            <span class="material-icons">
                                drive_file_rename_outline
                            </span> Edit Order
                        </router-link>
                    </div>
                    <h5 class="card-title mb-0">Order</h5>
                </div>
                <div class="card-body px-4 pt-2">
                    <table class="table table-sm mt-2 mb-4">
                        <tbody>
                            <tr>
                                <th>Chat/Lead</th>
                                <td>{{ reportcs.chat }}</td>
                            </tr>
                            <tr>
                                <th>Transaksi</th>
                                <td>{{ reportcs.transaksi }}</td>
                            </tr>
                            <tr>
                                <th>Omset</th>
                                <td>Rp. {{ getOmset | formatNumber }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4 pb-4">
                        <p class="mb-2 font-weight-bold">Keterangan</p>
                        <p v-if="reportcs.description != null" v-html="reportcs.description"></p>
                        <p v-if="reportcs.description == null">
                            <i>Tidak Ada Deskripsi!</i>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-8" v-if="reportcs != ''">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header px-4 pt-4">
                        <div class="card-actions float-end">
                            <div class="dropdown position-relative">
                                <span v-b-modal.addCustomer class="material-icons">
                                    add_circle_outline
                                </span>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">List Order</h5>
                        <div class="badge bg-warning my-2">{{ reportcs.date }}</div>
                    </div>
                    <div class="card-body px-4 pt-2">
                        <div class="accordion" role="tablist">
                            <div class="table-responsive">
                                <b-table borderless :items="reportcs.order" :fields="data" show-empty>
                                    <template #cell(action)="data">
                                        <button @click="data.toggleDetails" class="btn btn-primary btn-long btn-round">
                                            {{ data.item.customer_name }} [<span class="text-warning">{{ data.item.waybill }}</span>]<span v-html="data.item.status_label"></span>
                                        </button>
                                    </template>
                                    <template #row-details="row">
                                        <b-card no-body class="overflow-hidden" style="max-width: 540px;">
                                            <b-row no-gutters>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            <span class="material-icons align-middle">
                                                                settings
                                                            </span>
                                                            <span class="align-middle">Setting</span>
                                                        </h5>
                                                        <div class="mt-3">
                                                            <b-button-group>
                                                                <router-link :to="{ name: 'cs.report.edit.order', params: { id: row.item.id } }" class="btn btn-warning text-dark">
                                                                    <span class="material-icons">
                                                                        drive_file_rename_outline
                                                                    </span>
                                                                </router-link>
                                                                <button class="btn btn-danger" @click="deleteOrder(row.item.id)">
                                                                    <span class="material-icons">
                                                                        delete
                                                                    </span>
                                                                </button>
                                                                <router-link :to="{ name: 'cs.report.add.product.order', params: { id: row.item.id } }" class="btn btn-primary">
                                                                    <span class="material-icons">
                                                                        add_circle_outline
                                                                    </span>
                                                                </router-link>
                                                            </b-button-group>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <b-col md="12" v-if="row.item.image != null">
                                                            <b-card-img :src="'../storage/orders/' + row.item.image" alt="Image" class="rounded-0"></b-card-img>
                                                        </b-col>
                                                        <b-col md="12">
                                                            <b-card-body>
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Ongkir</th>
                                                                            <td>Rp. {{ row.item.ongkir | formatNumber }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Potongan Ongkir</th>
                                                                            <td>Rp. {{ row.item.ongkir_discount | formatNumber }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Metode</th>
                                                                            <td><span class="badge bg-primary rounded-pill">{{ row.item.metode == 1 ? 'COD' : 'Transfer' }}</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Kurir</th>
                                                                            <td><span class="badge bg-primary rounded-pill">{{ row.item.courier }}</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Biaya</th>
                                                                            <td>Rp. {{ row.item.metode == 1 ? row.item.biaya : 0 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Total</th>
                                                                            <td>Rp. {{ row.item.total | formatNumber }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </b-card-body>
                                                        </b-col>
                                                    </div>
                                                </div>
                                            </b-row>
                                        </b-card>
                                        <div class="card">
                                            <div class="card-body">
                                                <b-table :items="row.item.order_detail" :fields="fields" show-empty>
                                                    <template #cell(index)="data">
                                                        {{ data.index + 1 }}
                                                    </template>
                                                    <template #cell(product_name)="rows">
                                                        <p>{{ rows.item.product.name}}</p>
                                                    </template>
                                                    <template #cell(origin)="rows">
                                                        <p>{{ rows.item.product.origin_order}}</p>
                                                    </template>
                                                    <template #cell(price)="rows">
                                                        Rp. {{ rows.item.price | formatNumber }}
                                                    </template>
                                                    <template #cell(product_discount)="rows">
                                                        Rp. {{ rows.item.product_discount | formatNumber }}
                                                    </template>
                                                    <template #cell(subtotal)="rows">
                                                        Rp. {{ rows.item.subtotal | formatNumber }}
                                                    </template>
                                                    <template #cell(action)="rows">
                                                        <b-dropdown id="dropdown-1" text="Action" variant="primary" class="m-md-2">
                                                            <b-dropdown-item>
                                                                <router-link class="nav-link" :to="{ name: 'cs.report.edit.product.order', params: { id: rows.item.id } }">
                                                                    <span class="material-icons align-middle">
                                                                        edit
                                                                    </span>
                                                                    <span class="align-middle">Edit</span>
                                                                </router-link>
                                                            </b-dropdown-item>
                                                            <b-dropdown-item>
                                                                <a class="nav-link" @click="deleteProduct(rows.item.id)">
                                                                    <span class="material-icons align-middle">
                                                                        delete
                                                                    </span>
                                                                    <span class="align-middle">Hapus</span>
                                                                </a>
                                                            </b-dropdown-item>
                                                        </b-dropdown>
                                                    </template>
                                                </b-table>
                                            </div>
                                        </div>
                                    </template>
                                </b-table>
                            </div>
                        </div>
                    </div>
                    <!-- <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4 pb-4">
                        <p class="mb-2 font-weight-bold">Progress <span class="float-end">65%</span></p>
                        <div class="progress progress-sm">
                            <div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;">
                            </div>
                        </div>
                    </li>
                </ul> -->
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="rui-page-content">
        <div class="container-fluid">
            <div class="row xs-gap" v-if="reportcs == ''">
                <div class="col-sm-12 text-center">
                    <button v-b-modal.addReportCS type="button" class="btn btn-primary btn-long">
                        <span class="icon"><span class="fas fa-plus"></span></span><span class="text">Add Report CS</span>
                    </button>
                </div>
            </div>
            <div class="rui-profile row vertical-gap" v-if="reportcs != ''">
                <div class="col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h3 class="text-center">Order</h3>
                            </div>
                            <div class="rui-profile-numbers">
                                <div class="row justify-content-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <div class="rui-profile-number text-center">
                                            <h4 class="rui-profile-number-title h2">
                                                {{ reportcs.chat }}
                                            </h4>
                                            <small class="text-grey-6">Chat/Lead</small>
                                        </div>
                                    </div>
                                    <div class="col p-0"></div>
                                    <div class="col-auto">
                                        <div class="rui-profile-number text-center">
                                            <h4 class="rui-profile-number-title h2">
                                                {{ reportcs.transaksi }}
                                            </h4>
                                            <small class="text-grey-6">Transaksi</small>
                                        </div>
                                    </div>
                                    <div class="col p-0"></div>
                                    <div class="col-auto">
                                        <div class="rui-profile-number text-center">
                                            <h4 class="rui-profile-number-title h2">
                                                Rp.
                                                {{
                                                        getOmset | formatNumber
                                                    }}
                                            </h4>
                                            <small class="text-grey-6">Omset</small>
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                </div>
                            </div>
                            <div class="rui-profile-numbers">
                                <br />
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <h3 class="text-center">
                                            Setting
                                            <i class="fas fa-cog"></i>
                                        </h3>
                                    </div>
                                    <div class="col-auto">
                                        <router-link :to="{
                                                    name: 'report.edit.order',
                                                    params: {
                                                        date: reportcs.date
                                                    }
                                                }" class="btn btn-warning">
                                            <span class="icon">
                                                <span class="fas fa-edit"></span>
                                            </span>
                                            <span class="text">Edit Order</span>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <h3>Deskripsi Report</h3>
                            <div class="row justify-content">
                                <div class="col-auto">
                                    <p v-if="reportcs.description != null" v-html="reportcs.description"></p>
                                    <p v-if="reportcs.description == null">
                                        <i>Tidak Ada Deskripsi!</i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h2 class="card-title mnb-6 mr-auto">
                                    Current tasks
                                </h2>
                                <button v-b-modal.addCustomer class="btn btn-primary btn-uniform btn-round btn-sm mnt-8 mnb-8" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus rui-icon rui-icon-stroke-1_5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="accordion list-group list-group-flush rui-profile-task-list" id="accordionExample">
                                <div class="accordion-group" v-for="(row, index) in reportcs.order" :key="index">
                                    <a class="collapse-link collapsed" :href="
                                                '#' +
                                                    row.customer_name.replace(/[- / \ )(]/g,'') +
                                                    row.waybill.replace(/'/g, '')
                                            " id="headingTwo" data-toggle="collapse" aria-expanded="false" :aria-controls="
                                                row.customer_name.replace(
                                                    /\s/g,
                                                    ''
                                                ) + row.waybill
                                            ">
                                        {{ row.customer_name }} [<span class="text-primary">{{ row.waybill }}</span>]<span v-html="row.status_label"></span>
                                    </a>
                                    <div :id="
                                                row.customer_name.replace(/[- / \ )(]/g,'') + row.waybill.replace(/'/g, '')
                                            " class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="collapse-content">
                                            <div class="table-responsive">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            Setting
                                                            <span class="fas fa-cog"></span>
                                                        </h5>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <router-link :to="{ name: 'cs.report.edit.order', params: { id: row.id } }" class="btn btn-warning">
                                                                    <span class="icon">
                                                                        <span class="fas fa-edit"></span>
                                                                    </span>
                                                                    <span class="text">Edit</span>
                                                                </router-link>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <button class="btn btn-danger" @click="deleteOrder(row.id)">
                                                                    <span class="icon">
                                                                        <span class="fas fa-trash"></span>
                                                                    </span>
                                                                    <span class="text">Hapus</span>
                                                                </button>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <router-link :to="{
                                                                        name:
                                                                            'cs.report.add.product.order',
                                                                        params: {
                                                                            id:
                                                                                row.id
                                                                        }
                                                                    }" class="btn btn-primary btn-long">
                                                                    <span class="icon"><span class="fas fa-plus"></span></span><span class="text">Add
                                                                        Product</span>
                                                                </router-link>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Ongkir</th>
                                                                        <th>Potongan Ongkir</th>
                                                                        <th>Metode</th>
                                                                        <th>Kurir</th>
                                                                        <th>Biaya COD</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Rp. {{ row.ongkir | formatNumber }}</td>
                                                                        <td>Rp. {{ row.ongkir_discount | formatNumber }}</td>
                                                                        <td><span class="badge badge-primary">{{ row.metode == 1 ? 'COD' : 'Transfer' }}</span></td>
                                                                        <td><span class="badge badge-primary">{{ row.courier }}</span></td>
                                                                        <td>Rp. {{ row.metode == 1 ? row.biaya : 0 }}</td>
                                                                        <td>Rp. {{ row.total | formatNumber }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <b-card v-show="row.image != null">
                                                    <h5 class="card-title">
                                                        Setting
                                                        <span class="fas fa-cog"></span>
                                                    </h5>
                                                    <button class="btn btn-danger card-title">
                                                        <span class="icon">
                                                            <span class="fas fa-trash"></span>
                                                        </span>
                                                        <span class="text">Hapus</span>
                                                    </button>
                                                    <b-img :src="
                                                            '../storage/orders/' +
                                                                row.image
                                                        " thumbnail fluid alt="Responsive image"></b-img>
                                                </b-card>
                                                <br v-if="row.image != null">
                                                <b-table :items="
                                                            row.order_detail
                                                        " :fields="fields" show-empty>
                                                    <template #cell(index)="data">
                                                        {{ data.index + 1 }}
                                                    </template>
                                                    <template #cell(product_name)="rows">
                                                        <p>
                                                            {{
                                                                    rows.item
                                                                        .product
                                                                        .name
                                                                }}
                                                        </p>
                                                    </template>
                                                    <template #cell(price)="rows">
                                                        Rp.
                                                        {{
                                                                rows.item.price
                                                                    | formatNumber
                                                            }}
                                                    </template>
                                                    <template #cell(subtotal)="rows">
                                                        Rp.
                                                        {{
                                                                rows.item
                                                                    .subtotal
                                                                    | formatNumber
                                                            }}
                                                    </template>
                                                    <template #cell(action)="rows">
                                                        <div class="btn-group dropdown dropdown-triangle">
                                                            <button class="btn btn-primary btn-long dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text">Action</span>
                                                                <span class="icon">
                                                                    <span class="fas fa-angle-down"></span>
                                                                </span>
                                                            </button>
                                                            <ul class="dropdown-menu nav">
                                                                <li>
                                                                    <router-link class="nav-link" :to="{
                                                                                name:
                                                                                    'cs.report.edit.product.order',
                                                                                params: {
                                                                                    id:
                                                                                        rows
                                                                                            .item
                                                                                            .id
                                                                                }
                                                                            }">
                                                                        <span data-feather="plus-circle" class="fas fa-edit"></span><span>Edit</span><span class="rui-nav-circle"></span>
                                                                    </router-link>
                                                                </li>
                                                                <li>
                                                                    <a class="nav-link" @click="
                                                                                deleteProduct(
                                                                                    rows
                                                                                        .item
                                                                                        .id
                                                                                )
                                                                            ">
                                                                        <span data-feather="x-circle" class="fas fa-trash"></span>
                                                                        <span>Delete</span>
                                                                        <span class="rui-nav-circle"></span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </template>
                                                </b-table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</main>
</template>

<script>
import {
    mapActions,
    mapState
} from "vuex";
import CustomerAdd from "./module/CustomerAdd.vue";
import ReportsCSAdd from "./module/ReportCSAdd.vue";
import PageLoader from "../../../../components/PageLoader.vue";
export default {
    components: {
        CustomerAdd,
        ReportsCSAdd,
        PageLoader
    },
    name: "ViewReportsCS",
    created() {
        this.viewCsReport(this.$route.params.date);
    },
    data() {
        return {
            search: "",
            data: [{
                key: "action"
            }],
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "product_name",
                    label: "Product Name"
                },
                {
                    key: "origin",
                    label: "Origin Order"
                },
                {
                    key: "price",
                    label: "Price"
                },
                {
                    key: "product_discount",
                    label: "Potongan Harga"
                },
                {
                    key: "qty",
                    label: "Qty"
                },
                {
                    key: "subtotal",
                    label: "Total"
                },
                {
                    key: "action",
                    label: "Aksi"
                }
            ]
        };
    },
    computed: {
        ...mapState("csReport", {
            reportcs: state => state.reportcs
        }),
        getOrder() {
            const status = this.reportcs.order;

            const variableOne = status.filter(
                itemInArray => itemInArray.status === 1
            );

            return variableOne.reduce((prev, obj) => {
                let flatted = obj.order_detail.map(item => {
                    let order_detail = {};
                    order_detail["subtotal"] = item.subtotal;
                    let subtotal = order_detail["subtotal"];
                    return subtotal;
                });
                return [...prev, ...flatted];
            }, []);
        },
        getOmset() {
            return this.getOrder.reduce((acc, item) => acc + item, 0);
        }
    },
    methods: {
        ...mapActions("csReport", ["viewCsReport", "removeProductOrder", "removeOrder"]),
        deleteOrder(id) {
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
                        this.removeOrder(id);
                        this.$swal(
                            "Terhapus!",
                            "Order sudah dihapus.",
                            "success"
                        );
                        window.location.reload();
                    }
                });
        },
        deleteProduct(id) {
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
                        this.removeProductOrder(id);
                        this.$swal(
                            "Terhapus!",
                            "Produk order sudah dihapus.",
                            "success"
                        );
                        window.location.reload();
                    }
                });
        }
    }
};
</script>

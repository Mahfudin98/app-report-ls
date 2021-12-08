<template>
<main>
    <page-loader />
    <ReportsCSAdd />
    <customer-add />
    <div class="rui-page-content">
        <div class="container-fluid">
            <div class="row xs-gap" v-if="reportcs == ''">
                <div class="col-sm-12 text-center">
                    <button v-b-modal.addReportCS type="button" class="btn btn-brand btn-long">
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
                                <button v-b-modal.addCustomer class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8" type="button">
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
                                                    row.customer_name.replace(
                                                        /[- )(]/g,''
                                                    ) +
                                                    row.waybill
                                            " id="headingTwo" data-toggle="collapse" aria-expanded="false" :aria-controls="
                                                row.customer_name.replace(
                                                    /\s/g,
                                                    ''
                                                ) + row.waybill
                                            ">
                                        {{ row.customer_name }} [<span class="text-brand">{{ row.waybill }}</span>]<span v-html="row.status_label"></span>
                                    </a>
                                    <div :id="
                                                row.customer_name.replace(/[- )(]/g,'') + row.waybill
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
                                                                <button class="btn btn-danger">
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
                                                                    }" class="btn btn-brand btn-long">
                                                                    <span class="icon"><span class="fas fa-plus"></span></span><span class="text">Add
                                                                        Product</span>
                                                                </router-link>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <b-img v-show="
                                                            row.image != null
                                                        " :src="
                                                            '../storage/orders/' +
                                                                row.image
                                                        " thumbnail fluid alt="Responsive image"></b-img>
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
                                                            <button class="btn btn-brand btn-long dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    </div>
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
            fields: [{
                    key: "index",
                    label: "#"
                },
                {
                    key: "product_name",
                    label: "Product Name"
                },
                {
                    key: "price",
                    label: "Price"
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
        ...mapActions("csReport", ["viewCsReport", "removeProductOrder"]),
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

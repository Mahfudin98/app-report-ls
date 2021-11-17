<template>
    <div class="row">
        <div class="rui-page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title h2">Data Order Return</h5>
                        <div
                            class="d-flex justify-content-between align-items-center mb-20"
                        >
                            <div class="row xs-gap">
                                <div class="col-12">
                                    <div class="input-group">
                                        <button
                                            type="button"
                                            class="btn btn-clean btn-uniform btn-grey-5"
                                            data-toggle="button"
                                            aria-pressed="false"
                                        >
                                            <span
                                                style="font-size: 17px;"
                                                class="rui-icon fas fa-search"
                                            ></span>
                                        </button>
                                        <input
                                            type="search"
                                            class="form-control form-control-clean"
                                            placeholder="Type to search..."
                                            data-toggle="input"
                                            autocomplete="off"
                                            v-model="searchReturn"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <b-table
                                :items="orderReturns.data"
                                :fields="fieldsReturn"
                                show-empty
                            >
                                <template #cell(status)="row">
                                    <span v-html="row.item.status_label"></span>
                                </template>
                                <template #cell(action)="row">
                                    <h2 v-if="row.item.status == 0">
                                        <b-badge variant="danger"
                                            >Retur</b-badge
                                        >
                                    </h2>
                                    <div
                                        class="btn-group dropdown dropdown-triangle"
                                        v-if="row.item.status == 1"
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
                                                <router-link
                                                    :to="{
                                                        name: 'return.add',
                                                        params: {
                                                            waybill:
                                                                row.item.waybill
                                                        }
                                                    }"
                                                >
                                                    <span
                                                        data-feather="plus-circle"
                                                        class="fas fa-plus"
                                                    ></span
                                                    ><span>Add Return</span
                                                    ><span
                                                        class="rui-nav-circle"
                                                    ></span>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </template>
                            </b-table>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p v-if="orderReturns.data">
                                    <i class="fa fa-bars"></i>
                                    {{ orderReturns.data.length }} item dari
                                    {{ orderReturns.meta.total }} total data
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <b-pagination
                                        v-model="pageReturn"
                                        :total-rows="orderReturns.meta.total"
                                        :per-page="orderReturns.meta.per_page"
                                        aria-controls="orderReturns"
                                        v-if="
                                            orderReturns.data &&
                                                orderReturns.data.length > 0
                                        "
                                    ></b-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title h2">Data Order</h5>
                        <div
                            class="d-flex justify-content-between align-items-center mb-20"
                        >
                            <div class="row xs-gap">
                                <div class="col-12">
                                    <div class="input-group">
                                        <button
                                            type="button"
                                            class="btn btn-clean btn-uniform btn-grey-5"
                                            data-toggle="button"
                                            aria-pressed="false"
                                        >
                                            <span
                                                style="font-size: 17px;"
                                                class="rui-icon fas fa-search"
                                            ></span>
                                        </button>
                                        <input
                                            type="search"
                                            class="form-control form-control-clean"
                                            placeholder="Type to search..."
                                            data-toggle="input"
                                            autocomplete="off"
                                            v-model="searchOrder"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <b-table
                                :items="getOrders.data"
                                :fields="fields"
                                show-empty
                            >
                                <template #cell(status)="row">
                                    <span v-html="row.item.status_label"></span>
                                </template>
                                <template #cell(action)="row">
                                    <h2 v-if="row.item.status == 0">
                                        <b-badge variant="danger"
                                            >Retur</b-badge
                                        >
                                    </h2>
                                    <div
                                        class="btn-group dropdown dropdown-triangle"
                                        v-if="row.item.status == 1"
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
                                                <router-link
                                                    :to="{
                                                        name: 'return.add',
                                                        params: {
                                                            waybill:
                                                                row.item.waybill
                                                        }
                                                    }"
                                                >
                                                    <span
                                                        data-feather="plus-circle"
                                                        class="fas fa-plus"
                                                    ></span
                                                    ><span>Add Return</span
                                                    ><span
                                                        class="rui-nav-circle"
                                                    ></span>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </template>
                            </b-table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p v-if="getOrders.data">
                                    <i class="fa fa-bars"></i>
                                    {{ getOrders.data.length }} item dari
                                    {{ getOrders.meta.total }} total data
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <b-pagination
                                        v-model="pageOrder"
                                        :total-rows="getOrders.meta.total"
                                        :per-page="getOrders.meta.per_page"
                                        aria-controls="getOrders"
                                        v-if="
                                            getOrders.data &&
                                                getOrders.data.length > 0
                                        "
                                    ></b-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState, mapMutations } from "vuex";
export default {
    name: "DataReturn",
    created() {
        this.getOrdersReturn();
        this.getReturnOrder();
    },
    data() {
        return {
            searchReturn: "",
            searchOrder: "",
            fields: [
                { key: "waybill", label: "Waybill" },
                { key: "customer_name", label: "Customer Name" },
                { key: "cs_report.user.name", label: "Nama CS" },
                { key: "date", label: "Date" },
                { key: "status", label: "Status" },
                { key: "action", label: "Aksi" }
            ],
            fieldsReturn: [
                { key: "waybill", label: "Waybill" },
                { key: "customer_name", label: "Customer Name" },
                { key: "customer_address", label: "Customer Address" },
                { key: "cs_name", label: "Nama CS" },
                { key: "date_order", label: "Date Order" },
                { key: "date_return", label: "Date Return" },
                { key: "alasan", label: "Alasan" }
            ]
        };
    },
    computed: {
        ...mapState("returnOrder", {
            getOrders: state => state.getOrders,
            orderReturns: state => state.orderReturn
        }),
        pageOrder: {
            get() {
                return this.$store.state.returnOrder.pageOrder;
            },
            set(val) {
                this.$store.commit("returnOrder/SET_PAGE_ORDER", val);
            }
        },
        pageReturn: {
            get() {
                return this.$store.state.returnOrder.pageReturn;
            },
            set(val) {
                this.$store.commit("returnOrder/SET_PAGE_RETURN", val);
            }
        },
    },
    watch: {
        pageOrder() {
            this.getOrdersReturn();
        },
        pageReturn() {
            this.getReturnOrder();
        },
        searchReturn() {
            this.getReturnOrder(this.searchReturn);
        },
        searchOrder() {
            this.getOrdersReturn(this.searchOrder);
        }
    },
    methods: {
        ...mapActions("returnOrder", ["getOrdersReturn", "getReturnOrder"])
    }
};
</script>

<style>
.player-holder {
    height: 150px;
    max-width: 250px;
    background: transparent;
    text-align: center;
}
.player-thumb {
    width: 150px;
    height: 150px;
    display: inline-block;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
}
</style>

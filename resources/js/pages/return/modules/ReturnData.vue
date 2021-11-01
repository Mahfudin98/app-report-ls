<template>
    <div class="row">
        <div class="rui-page-content">
            <div class="container-fluid">
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
                                    <span style="font-size: 17px;"
                                        class="rui-icon fas fa-search"
                                    ></span>
                                </button>
                                <input
                                    type="search"
                                    class="form-control form-control-clean"
                                    placeholder="Type to search..."
                                    data-toggle="input"
                                    autocomplete="off"
                                    v-model="search"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <b-table
                        :items="getOrders.data"
                        :fields="fields"
                        striped
                        hover
                    >
                        <template #cell(status)="row">
                            <span v-html="row.item.status_label"></span>
                        </template>
                        <template #cell(action)="row">
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
                                        <router-link
                                            :to="{
                                                name: 'return.add',
                                                params: { waybill: row.item.waybill }
                                            }"
                                        >
                                            <span
                                                data-feather="plus-circle"
                                                class="fas fa-plus"
                                            ></span
                                            ><span>Add Return</span
                                            ><span class="rui-nav-circle"></span>
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </template>
                    </b-table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from "vuex";
export default {
    name: "DataReturn",
    created() {
        this.getOrdersReturn();
    },
    data() {
        return {
            search: "",
            fields: [
                { key: "waybill", label: "Waybill" },
                { key: "customer_name", label: "Customer Name" },
                { key: "cs_report.user.name", label: "Nama CS" },
                { key: "date", label: "Date" },
                { key: "status", label: "Status" },
                { key: "action", label: "Aksi" }
            ]
        };
    },
    computed: {
        ...mapState("returnOrder", {
            getOrders: state => state.getOrders
        }),
        page: {
            get() {
                return this.$store.state.order.page;
            },
            set(val) {
                this.$store.commit("order/SET_PAGE", val);
            }
        }
    },
    watch: {
        page() {
            this.getOrdersReturn();
        },
        search() {
            this.getOrdersReturn(this.search);
        }
    },
    methods: {
        ...mapActions("returnOrder", ["getOrdersReturn"])
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

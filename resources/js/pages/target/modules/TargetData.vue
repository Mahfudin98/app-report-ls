<template>
    <main>
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
                                    v-model="search"
                                />
                            </div>
                        </div>
                    </div>
                    <router-link
                        class="btn btn-brand btn-long"
                        :to="{
                            name: 'target.add'
                        }"
                    >
                        <span class="icon"
                            ><span class="rui-icon fas fa-plus"></span></span
                        ><span class="text">Add Target</span>
                    </router-link>
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
                            {{ moment(row.item.start_date).format('MMMM - YYYY')  }}
                        </template>
                        <template #cell(percent)="row">
                            {{ (row.item.omset / row.item.target * 100).toFixed(2) }} %
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
                                            class="nav-link"
                                            :to="{
                                                name: 'product.edit',
                                                params: { id: row.item.id }
                                            }"
                                        >
                                            <span
                                                data-feather="plus-circle"
                                                class="fas fa-edit"
                                            ></span
                                            ><span>Edit</span
                                            ><span
                                                class="rui-nav-circle"
                                            ></span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <a
                                            class="nav-link"
                                            @click="deleteProduct(row.item.id)"
                                        >
                                            <span
                                                data-feather="x-circle"
                                                class="fas fa-trash"
                                            ></span>
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
    </main>
</template>
<script>
import moment from 'moment'
import { mapActions, mapState } from "vuex";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { VueMomentsAgo },
    created() {
        this.getTarget();
    },

    data() {
        return {
            search: "",
            fields: [
                { key: "index", label: "#" },
                { key: "user.name", label: "Name" },
                { key: "omset", label: "Omset" },
                { key: "target", label: "Target" },
                { key: "date", label: "Date" },
                { key: "percent", label: "Persentase" },
                { key: "action", label: "Aksi" }
            ]
        };
    },

    computed: {
        ...mapState("target", {
            targets: state => state.targets
        }),
        page: {
            get() {
                return this.$store.state.product.page;
            },
            set(val) {
                this.$store.commit("product/SET_PAGE", val);
            }
        }
    },

    watch: {
        page() {
            this.getTarget();
        },
        search() {
            this.getTarget(this.search);
        }
    },

    methods: {
        ...mapActions("target", ["getTarget", "removeProduct"])
    }
};
</script>

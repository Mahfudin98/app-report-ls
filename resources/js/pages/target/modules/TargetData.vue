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
                            {{
                                moment(row.item.start_date).format(
                                    "MMMM - YYYY"
                                )
                            }}
                        </template>
                        <template #cell(percent)="row">
                            <h3 class="badge badge-brand">
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
                            <button
                                @click="data.toggleDetails"
                                class="btn btn-brand btn-long btn-round"
                            >
                                <span class="icon">
                                    <span
                                        data-feather="check"
                                        class="fas fa-eye"
                                    ></span
                                ></span>
                                <span class="text">
                                    {{ data.detailsShowing ? "Hide" : "Show" }}
                                    Detail
                                </span>
                            </button>
                        </template>
                        <template #row-details="row">
                            <b-card>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <Progress
                                                    strokeColor="#00C58E"
                                                    :transitionDuration="1000"
                                                    :radius="50"
                                                    :strokeWidth="10"
                                                    :value="
                                                        (
                                                            (row.item.omset /
                                                                row.item
                                                                    .target) *
                                                            100
                                                        ).toFixed(2)
                                                    "
                                                >
                                                    <template v-slot:footer>
                                                        <b
                                                            >Bulan
                                                            {{
                                                                moment(
                                                                    row.item
                                                                        .start_date
                                                                ).format(
                                                                    "MMMM - YYYY"
                                                                )
                                                            }}</b
                                                        >
                                                    </template>
                                                </Progress>
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
    </main>
</template>
<script>
import Progress from "easy-circular-progress";
import moment from "moment";
import { mapActions, mapState } from "vuex";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { VueMomentsAgo, Progress },
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

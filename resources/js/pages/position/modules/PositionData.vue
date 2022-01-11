<template>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <div class="row xs-gap">
                <div class="col-12">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" placeholder="Search…" aria-label="Search" v-model="search">
                        <button class="btn" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search align-middle">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row xs-gap">
                <div class="col-12">
                    <form-add />
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <b-table :items="positions.data" :fields="fields" striped hover>
                        <template #cell(index)="row">
                            {{row.item.user.length }} Orang
                        </template>
                        <template #cell(created_at)="row">
                            <span>{{ row.item.created_at | moment("MMMM/DD/YYYY") }}</span>
                        </template>
                        <template #cell(action)>
                            <b-dropdown id="dropdown-1" text="Action" variant="primary" class="m-md-2">
                                <b-dropdown-item>
                                    <a class="nav-link" href="#">
                                        <span class="material-icons align-middle">
                                            edit
                                        </span>
                                        <span class="align-middle">Edit</span>
                                    </a>
                                </b-dropdown-item>
                                <b-dropdown-item>
                                    <a class="nav-link" href="#">
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
        </div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState
} from "vuex";
import moment from 'moment'
import FormAdd from "./PositionForm.vue";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: {
        FormAdd: FormAdd,
        VueMomentsAgo
    },
    name: "DataPosition",

    created() {
        this.getPositions();
    },

    data() {
        return {
            search: "",
            fields: [{
                    key: "index",
                    label: "Jumlah Team"
                },
                {
                    key: "name",
                    label: "Posisi"
                },
                {
                    key: "created_at",
                    label: "Created At"
                },
                {
                    key: "action",
                    label: "Aksi"
                }
            ]
        };
    },

    computed: {
        ...mapState("position", {
            positions: state => state.positions
        })
    },

    watch: {
        search() {
            this.getPositions(this.search);
        }
    },

    methods: {
        ...mapActions("position", ["getPositions", "removePosition"]),
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

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
                    <div class="row xs-gap">
                        <div class="col-12">
                            <form-add />
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <b-table
                        :items="positions.data"
                        :fields="fields"
                        striped
                        hover
                    >
                        <template #cell(index)="row">
                            {{row.item.user.length }} Orang
                        </template>
                        <template #cell(created_at)="row">
                            <span class="text-light">{{ row.item.created_at | moment("MMMM/DD/YYYY") }}</span>
                        </template>
                        <template #cell(action)>
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
                                        <a class="nav-link" href="#"
                                            ><span
                                                data-feather="plus-circle"
                                                class="fas fa-edit"
                                            ></span
                                            ><span>Edit</span
                                            ><span class="rui-nav-circle"></span
                                        ></a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#"
                                            ><span
                                                data-feather="x-circle"
                                                class="fas fa-trash"
                                            ></span
                                            ><span>Delete</span
                                            ><span class="rui-nav-circle"></span
                                        ></a>
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
import moment from 'moment'
import FormAdd from "./PositionForm.vue";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { FormAdd: FormAdd, VueMomentsAgo },
    name: "DataPosition",

    created() {
        this.getPositions();
    },

    data() {
        return {
            search: "",
            fields: [
                { key: "index", label: "Jumlah Team" },
                { key: "name", label: "Posisi" },
                { key: "created_at", label: "Created At" },
                { key: "action", label: "Aksi" }
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

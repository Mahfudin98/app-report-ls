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
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-search rui-icon rui-icon-stroke-1_5"
                                    >
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line
                                            x1="21"
                                            y1="21"
                                            x2="16.65"
                                            y2="16.65"
                                        ></line>
                                    </svg>
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
                            <router-link
                                v-if="this.$route.name != 'inventory.data'"
                                :to="{ name: 'inventory.usage.add' }"
                                class="btn btn-brand btn-long"
                            >
                                <span class="icon"
                                    ><span class="fas fa-plus"></span></span
                                ><span class="text">Add</span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr class="users-table-info">
                                <th scope="col">
                                    Nama Posisi
                                </th>
                                <th scope="col">Jumlah Barang</th>
                                <th scope="col">Tampilkan</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="row in inventoriUsages.data"
                                :key="row.id"
                            >
                                <td>
                                    <h5>{{ row.name }}</h5>
                                </td>
                                <td>
                                    <div class="library-table-name">
                                        {{ row.used.length }} Barang
                                    </div>
                                </td>
                                <td>
                                    <router-link
                                        :to="{
                                            name: 'inventory.usage.show',
                                            params: { slug: row.slug }
                                        }"
                                        class="btn btn-brand btn-long"
                                    >
                                        <span class="icon"
                                            ><span
                                                class="fas fa-eye"
                                            ></span></span
                                        ><span class="text">View</span>
                                    </router-link>
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
                            <tr v-if="inventoriUsages.data == 0">
                                <td class="text-center" colspan="6"><h5>Data tidak ditemukan</h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from "vuex";
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: { VueMomentsAgo },
    name: "DataInventory",

    created() {
        this.getInventorUsages();
    },

    data() {
        return {
            search: ""
        };
    },

    computed: {
        ...mapState("inventory", {
            inventoriUsages: state => state.inventoriUsages
        })
    },

    watch: {
        search() {
            this.getInventorUsages(this.search);
        }
    },

    methods: {
        ...mapActions("inventory", ["getInventorUsages", "removeInventory"]),
        deleteInventory(id) {
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
                    this.removeInventory(id);
                }
            });
        }
    }
};
</script>

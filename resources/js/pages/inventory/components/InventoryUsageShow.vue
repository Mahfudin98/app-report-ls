<template>
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{ name: 'inventory.usage' }" class="btn btn-secondary btn-long">
                    <span class="material-icons align-middle">
                        reply
                    </span>
                    <span class="align-middle">Back</span>
                </router-link>
                <div class="row xs-gap">
                    <div class="col-12">
                        <router-link v-if="this.$route.name != 'inventory.data'" :to="{ name: 'inventory.usage.add' }" class="btn btn-primary btn-long">
                            <span class="material-icons align-middle">
                                add_circle_outline
                            </span>
                            <span class="align-middle">Add New</span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr class="users-table-info">
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in inventoryUsageShow.data" :key="row.id">
                            <td>
                                <h5>{{ row.inventory.name }}</h5>
                            </td>
                            <td>
                                <div class="library-table-name">
                                    {{ row.jumlah }} Barang
                                </div>
                            </td>
                            <td>
                                <p v-html="row.kondisi_label"></p>
                            </td>
                            <td>
                                {{ row.keterangan }}
                            </td>
                            <td>
                                <vue-moments-ago prefix="posted" suffix="ago" :date="row.created_at" />
                            </td>
                            <td>
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
                            </td>
                        </tr>
                        <tr v-if="inventoryUsageShow.data == 0">
                            <td class="text-center" colspan="6">
                                <h5>Data tidak ditemukan</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
import VueMomentsAgo from "vue-moments-ago";
export default {
    components: {
        VueMomentsAgo
    },
    name: "DataInventory",

    created() {
        this.showInventoriUsage(this.$route.params.slug);
    },

    data() {
        return {};
    },

    computed: {
        ...mapState("inventory", {
            inventoryUsageShow: state => state.inventoryUsageShow
        })
    },

    methods: {
        ...mapActions("inventory", ["showInventoriUsage", "removeInventory"]),
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

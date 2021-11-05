<template>
    <div class="row">
    <page-loader/>
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
                    <router-link class="btn btn-brand btn-long" v-if="authenticated.role == 0 || $can('create teams')"
                        :to="{ name: 'teams.add' }">
                        <span class="icon"
                            ><span
                                class="rui-icon fas fa-plus"
                            ></span></span
                        ><span class="text">New</span>
                    </router-link>
                </div>
                <div class="rui-profile row vertical-gap">
                    <div
                        class="col-lg-6 col-xl-3"
                        v-for="row in teams.data"
                        :key="row.created_at"
                    >
                        <div class="card">
                            <div class="card-body text-center">
                                <router-link
                                    :to="{
                                        name: 'teams.show',
                                        params: { slug: row.slug }
                                    }"
                                >
                                    <div class="player-holder">
                                        <img
                                            class="player-thumb"
                                            v-show="row.image != null"
                                            :src="
                                                '../storage/teams/' + row.image
                                            "
                                            :alt="row.name"
                                        />
                                    </div>
                                </router-link>
                                <hr />
                                <h5 class="card-title h2">
                                    {{ row.name }}
                                </h5>
                                <p class="card-text">
                                    {{ row.position.name }}
                                </p>
                                <div
                                    class="btn-group"
                                    v-if="$can('edit teams')"
                                >
                                    <router-link :to="{
                                        name: 'teams.edit',
                                        params: { id: row.id }
                                    }"
                                        class="btn btn-warning"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </router-link>
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" v-if="teams.data == 0">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center">
                                    Data Tidak Ditemukan
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import PageLoader from '../../../components/PageLoader.vue'
import { mapActions, mapState } from "vuex";
export default {
    name: "DataUser",
    created() {
        this.getTeams();
    },
    data() {
        return {
            search: ""
        };
    },
    computed: {
        ...mapState("user", {
            authenticated: state => state.authenticated //ME-LOAD STATE AUTHENTICATED
        }),
        ...mapState("team", {
            teams: state => state.teams
        }),
        page: {
            get() {
                return this.$store.state.team.page;
            },
            set(val) {
                this.$store.commit("team/SET_PAGE", val);
            }
        }
    },
    watch: {
        page() {
            this.getTeams();
        },
        search() {
            this.getTeams(this.search);
        }
    },
    methods: {
        ...mapActions("team", ["getTeams", "removeTeam"]),
        removeTeam(id) {
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
                    this.removeTeam(id);
                }
            });
        }
    },
    components: { PageLoader }
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

<template>
<div class="row">
    <page-loader />
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
            <router-link class="btn btn-primary" v-if="authenticated.role == 0 || $can('create teams')" :to="{ name: 'teams.add' }">
                <span class="material-icons align-middle">
                    add_circle_outline
                </span>
                <span class="align-middle">New Team</span>
            </router-link>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4" v-for="row in teams.data" :key="row.created_at">
        <div class="card mb-3">
            <div class="card-body text-center">
                <img v-show="row.image != null" :src="'../storage/teams/' + row.image" :alt="row.name" class="img-fluid myimg mb-2 " width="128" height="128">
                <h5 class="card-title mb-0">{{ row.name }}</h5>
                <div class="text-muted mb-2">{{ row.position.name }}</div>

                <div>
                    <router-link :to="{name: 'teams.show', params: { slug: row.slug }}" class="btn btn-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg> View
                    </router-link>
                    <a class="btn btn-primary btn-sm" v-bind:href="'https://wa.me/' + row.phone" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg> Message
                    </a>
                </div>
                <br />
                <div v-if="$can('edit teams')">
                    <router-link :to="{ name: 'teams.edit', params: { id: row.id }}" class="btn btn-warning btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg> Edit
                    </router-link>
                    <button type="button" class="btn btn-danger btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p v-if="teams.data">
                            <span class="material-icons align-middle">
                                menu
                            </span>
                            <span class="align-middle">
                                {{ teams.data.length }} item dari
                                {{ teams.meta.total }} total data
                            </span>
                        </p>
                    </div>
                    <div class="col-md-8">
                        <div class="pull-right">
                            <b-pagination v-model="page" :total-rows="teams.meta.total" :per-page="teams.meta.per_page" aria-controls="teams" v-if="teams.data && teams.data.length > 0"></b-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="rui-page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <div class="row xs-gap">
                    <div class="col-12">
                        <div class="input-group">
                            <button type="button" class="btn btn-clean btn-uniform btn-grey-5" data-toggle="button" aria-pressed="false">
                                <span style="font-size: 17px;" class="rui-icon fas fa-search"></span>
                            </button>
                            <input type="search" class="form-control form-control-clean" placeholder="Type to search..." data-toggle="input" autocomplete="off" v-model="search" />
                        </div>
                    </div>
                </div>
                <router-link class="btn btn-brand btn-long" v-if="authenticated.role == 0 || $can('create teams')" :to="{ name: 'teams.add' }">
                    <span class="icon"><span class="rui-icon fas fa-plus"></span></span><span class="text">New</span>
                </router-link>
            </div>
            <div class="rui-profile row vertical-gap">
                <div class="col-lg-6 col-xl-3" v-for="row in teams.data" :key="row.created_at">
                    <div class="card">
                        <div class="card-body text-center">
                            <router-link :to="{
                                        name: 'teams.show',
                                        params: { slug: row.slug }
                                    }">
                                <div class="player-holder">
                                    <img class="myimg" v-show="row.image != null" :src="
                                                '../storage/teams/' + row.image
                                            " :alt="row.name" />
                                </div>
                            </router-link>
                            <hr />
                            <h5 class="card-title h2">
                                {{ row.name }}
                            </h5>
                            <p class="card-text">
                                {{ row.position.name }}
                            </p>
                            <div class="btn-group" v-if="$can('edit teams')">
                                <router-link :to="{
                                            name: 'teams.edit',
                                            params: { id: row.id }
                                        }" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </router-link>
                                <button type="button" class="btn btn-danger">
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
            <br />
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p v-if="teams.data">
                                <i class="fa fa-bars"></i>
                                {{ teams.data.length }} item dari
                                {{ teams.meta.total }} total data
                            </p>
                        </div>
                        <div class="col-md-8">
                            <div class="pull-right">
                                <b-pagination v-model="page" :total-rows="teams.meta.total" :per-page="teams.meta.per_page" aria-controls="teams" v-if="
                                            teams.data && teams.data.length > 0
                                        "></b-pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
</div>
</template>

<script>
import PageLoader from "../../../components/PageLoader.vue";
import {
    mapActions,
    mapState
} from "vuex";
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
    components: {
        PageLoader
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

.myimg {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
}
</style>

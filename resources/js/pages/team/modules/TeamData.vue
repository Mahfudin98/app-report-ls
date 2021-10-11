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
                    <router-link
                        v-if="$can('create teams')"
                        :to="{ name: 'teams.add' }"
                        class="btn btn-brand"
                    >
                        <span class="icon"
                            ><svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-plus rui-icon rui-icon-stroke-1_5"
                            >
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line
                                    x1="5"
                                    y1="12"
                                    x2="19"
                                    y2="12"
                                ></line></svg
                        ></span>
                        <span class="text">New</span>
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
                                <div class="btn-group" v-if="$can('edit teams')">
                                    <button
                                        type="button"
                                        class="btn btn-warning"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>
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
                    <div
                        class="col-lg-12"
                        v-if="teams.data == 0"
                    >
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center">Data Tidak Ditemukan</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
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
        deleteTeam(id) {
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

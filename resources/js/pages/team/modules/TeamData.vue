<template>
    <div class="row">
        <div class="col-md-6 col-lg-4 col-xl-3" v-for="row in teams.data" :key="row.created_at">
            <article class="users-item">
                <div class="users-item-body">
                    <div class="users-item__img">
                        <picture>
                            <img v-show="row.image != null" :src="'../storage/teams/' + row.image" width="100px" height="100px" alt="Dominik McNeal">
                            <lord-icon
                                v-show="row.image == null"
                                type="image/webp"
                                src="https://cdn.lordicon.com/nobciafz.json"
                                trigger="loop-on-hover"
                                colors="primary:#fffff,secondary:#ffffff"
                                style="width:100px;height:100px"
                            >
                            </lord-icon>
                        </picture>
                    </div>
                    <p class="users-item__name">{{ row.name }}</p>
                    <p class="users-item__role">{{row.position.name}}</p>
                </div>
                <a class="primary-white-btn" v-bind:href="'https://wa.me/' + row.phone">
                    <i class="fab fa-whatsapp fa-2x"></i>&nbsp;Send message
                </a>
                <button
                    class="dropdown-btn users-item__more transparent-btn"
                    type="button"
                    title="More info"
                >
                    <div class="sr-only">More info</div>
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
                        class="feather feather-more-horizontal"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="19" cy="12" r="1"></circle>
                        <circle cx="5" cy="12" r="1"></circle>
                    </svg>
                </button>
                <ul class="users-item-dropdown dropdown">
                    <li><a href="##">Edit</a></li>
                    <li><a href="##">Quick edit</a></li>
                    <li><a href="##">Trash</a></li>
                </ul>
            </article>
        </div>
    </div>
</template>
<script>
import {mapActions, mapState} from 'vuex'
export default {
    name: "DataUser",
    created() {
        this.getTeams()
    },
    data() {
        return {
            search: ''
        }
    },
    computed: {
        ...mapState('team', {
            teams: state => state.teams
        }),
        page: {
            get() {
                return this.$store.state.team.page
            },
            set(val) {
                this.$store.commit('team/SET_PAGE', val)
            }
        }
    },
    watch: {
        page() {
            this.getTeams()
        },
        search() {
            this.getTeams(this.search)
        }
    },
    methods: {
        ...mapActions('team', ['getTeams', 'removeTeam']),
        deleteTeam(id) {
            this.$swal({
                title: 'Kamu Yakin?',
                text: "Tindakan ini akan menghapus secara permanent!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Lanjutkan!'
            }).then((result) => {
                if (result.value) {
                    this.removeTeam(id)
                }
            })
        }
    }
}
</script>

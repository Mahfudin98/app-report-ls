<template>
<div class="row">
    <page-loader />
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <router-link :to="{ name: 'teams.data' }" class="btn btn-secondary">
                <span class="material-icons align-middle">
                    reply
                </span>
                <span class="align-middle">Back</span>
            </router-link>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Profile Details</h5>
            </div>
            <div class="card-body text-center">
                <img v-show="profile.image != null" :src="'../storage/teams/' + profile.image" :alt="profile.slug" class="img-fluid myimg mb-2" width="128" height="128" />
                <h5 class="card-title mb-0">{{ profile.name }}</h5>
                <div class="text-muted mb-2">{{ profile.position['name'] }}</div>

                <div>
                    <router-link :to="{ name: 'teams.edit', params: { id: profile.id }}" class="btn btn-warning btn-sm" v-if="profile.id == authenticated.id">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg> Edit
                    </router-link>
                    <a class="btn btn-primary btn-sm" v-bind:href="'https://wa.me/' + profile.phone" target="_blank" v-if="profile.id != authenticated.id">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg> Message
                    </a>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">About</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1">
                        <span class="material-icons align-middle">
                            home
                        </span>
                        <span class="align-middle">Alamat : {{ profile.address }}</span>
                    </li>

                    <li class="mb-1">
                        <span class="material-icons align-middle">
                            celebration
                        </span>
                        <span class="align-middle">Birthday : <a href="#" class="badge bg-primary me-1 my-1">{{ profile.tanggal_lahir }}</a></span>
                    </li>
                    <!-- <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>
                        From <a href="#">Boston</a></li> -->
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-xl-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Activities</h5>
            </div>
            <div class="card-body h-100">
                <div class="d-flex align-items-start">
                    <img src="https://picsum.photos/250/250/?image=54" width="36" height="36" class="rounded-circle me-2" alt="Vanessa Tucker">
                    <div class="flex-grow-1">
                        <small class="float-end text-navy">5m ago</small>
                        <strong>Vanessa Tucker</strong> started following <strong>Christina
                            Mason</strong><br />
                        <small class="text-muted">Today 7:51 pm</small><br />
                    </div>
                </div>
                <hr/>
            </div>
        </div>
    </div>
</div>
<!-- <div class="rui-page-content">
    <page-loader />
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <router-link :to="{ name: 'teams.data' }" class="btn btn-secondary">
                <span class="icon">
                    <span class="fas fa-arrow-alt-circle-left"></span>
                </span>
                <span class="text">Back</span>
            </router-link>
        </div>
        <div class="rui-profile row vertical-gap">
            <div class="col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row vertical-gap">
                            <div class="col-auto">
                                <div class="player-holder">
                                    <img class="myimg" v-show="profile.image != null" :src="
                                                '../storage/teams/' +
                                                    profile.image
                                            " :alt="profile.slug" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="rui-profile-info text-center">
                                    <h3 class="rui-profile-info-title h4">
                                        {{ profile.name }}
                                    </h3>
                                    <small class="text-grey-6 mt-2 mb-15" v-if="profile.position">
                                        {{ profile.position['name'] }}
                                    </small>
                                    <a class="rui-profile-info-mail" href="#">{{ profile.email }}</a>
                                    <a class="rui-profile-info-phone btn btn-success text-white" v-bind:href="
                                                'https://wa.me/' + profile.phone
                                            ">
                                        <span class="icon">
                                            <span class="fab fa-whatsapp"></span>
                                        </span>
                                        <span class="text">Chat Team</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="rui-profile-numbers">
                            <div class="row justify-content-center">
                                <div class="col"></div>
                                <div class="col-auto">
                                    <div class="rui-profile-number text-center">

                                        <small class="text-grey-6">Alamat</small>
                                        <h6 class="rui-profile-number-title h4">
                                            {{ profile.address }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="col p-0"></div>
                                <div class="col-auto">
                                    <div class="rui-profile-number text-center">
                                        <small class="text-grey-6">Tempat Lahir</small>
                                        <h6 class="rui-profile-number-title h4">
                                            {{ profile.tempat_lahir }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="col p-0"></div>
                                <div class="col-auto">
                                    <div class="rui-profile-number text-center">
                                        <small class="text-grey-6">Tanggal Lahir</small>
                                        <h6 class="rui-profile-number-title h4">
                                            {{ profile.tanggal_lahir }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h2 class="card-title mnb-6 mr-auto">
                                Current tasks
                            </h2>
                            <button class="btn btn-custom-round mr-20" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link-2 rui-icon rui-icon-stroke-1_5">
                                    <path d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3"></path>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                </svg>
                            </button>
                            <button class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus rui-icon rui-icon-stroke-1_5">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </div>
                        <ul class="list-group list-group-flush rui-profile-task-list">
                            <li class="list-group-item">
                                <div class="rui-task rui-task-success">
                                    <div class="rui-task-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle rui-icon rui-icon-stroke-1_5">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                    </div>
                                    <div class="rui-task-content">
                                        <a class="rui-task-title" href="task.html">Cattle whose. There isn't
                                            cattle rule said saying you
                                            divided</a>
                                        <small class="rui-task-subtitle">#12 opened 4 days ago by
                                            <a href="#">Henry</a></small>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="rui-task rui-task-success">
                                    <div class="rui-task-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle rui-icon rui-icon-stroke-1_5">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                    </div>
                                    <div class="rui-task-content">
                                        <a class="rui-task-title" href="task.html">Was living rule Him created a
                                            to. Light of itself</a>
                                        <small class="rui-task-subtitle">#11 opened 21 days ago by
                                            <a href="#">Neil</a></small>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="rui-task rui-task-danger">
                                    <div class="rui-task-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle rui-icon rui-icon-stroke-1_5">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <div class="rui-task-content">
                                        <a class="rui-task-title" href="task.html">The problem with the Media
                                            object</a>
                                        <small class="rui-task-subtitle">#10 closed on 12 Mar by
                                            <a href="#">Anna</a></small>
                                    </div>
                                    <a class="rui-task-icon" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle rui-icon rui-icon-stroke-1_5">
                                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                        </svg>2</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
</template>

<script>
import PageLoader from '../../../components/PageLoader.vue'
import {
    mapActions,
    mapState
} from "vuex";
export default {
    name: "ShowTeams",
    created() {
        this.showTeam(this.$route.params.slug);
    },
    computed: {
        ...mapState("team", {
            profile: state => state.profile
        }),
        ...mapState("user", {
            authenticated: state => state.authenticated //ME-LOAD STATE AUTHENTICATED
        }),
    },
    methods: {
        ...mapActions("team", ["showTeam"])
    },
    components: {
        PageLoader
    }
};
</script>

<style>
.player-holder {
    height: 100px;
    max-width: 650px;
    background: transparent;
    text-align: center;
}

.player-thumb {
    width: 100px;
    height: 100px;
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

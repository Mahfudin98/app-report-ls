<template>
<div class="row">
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
                    <a class="btn btn-primary btn-sm" href="#">Follow</a>
                    <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
                </div>
            </div>
            <!-- <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Skills</h5>
                <a href="#" class="badge bg-primary me-1 my-1">HTML</a>
                <a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
                <a href="#" class="badge bg-primary me-1 my-1">Sass</a>
                <a href="#" class="badge bg-primary me-1 my-1">Angular</a>
                <a href="#" class="badge bg-primary me-1 my-1">Vue</a>
                <a href="#" class="badge bg-primary me-1 my-1">React</a>
                <a href="#" class="badge bg-primary me-1 my-1">Redux</a>
                <a href="#" class="badge bg-primary me-1 my-1">UI</a>
                <a href="#" class="badge bg-primary me-1 my-1">UX</a>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">About</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives
                        in <a href="#">San Francisco, SA</a></li>

                    <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>
                        Works at <a href="#">GitHub</a></li>
                    <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>
                        From <a href="#">Boston</a></li>
                </ul>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Elsewhere</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><a href="#">staciehall.co</a></li>
                    <li class="mb-1"><a href="#">Twitter</a></li>
                    <li class="mb-1"><a href="#">Facebook</a></li>
                    <li class="mb-1"><a href="#">Instagram</a></li>
                    <li class="mb-1"><a href="#">LinkedIn</a></li>
                </ul>
            </div> -->
        </div>
    </div>

    <div class="col-md-8 col-xl-9">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Activities</h5>
            </div>
            <div class="card-body h-100">

                <div class="d-flex align-items-start">
                    <img src="img/avatars/avatar-5.jpg" width="36" height="36" class="rounded-circle me-2" alt="Vanessa Tucker">
                    <div class="flex-grow-1">
                        <small class="float-end text-navy">5m ago</small>
                        <strong>Vanessa Tucker</strong> started following <strong>Christina
                            Mason</strong><br />
                        <small class="text-muted">Today 7:51 pm</small><br />

                    </div>
                </div>

                <hr />
                <div class="d-flex align-items-start">
                    <img src="img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2" alt="Charles Hall">
                    <div class="flex-grow-1">
                        <small class="float-end text-navy">30m ago</small>
                        <strong>Charles Hall</strong> posted something on <strong>Christina
                            Mason</strong>'s timeline<br />
                        <small class="text-muted">Today 7:21 pm</small>

                        <div class="border text-sm text-muted p-2 mt-1">
                            Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem
                            quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam
                            nunc, blandit vel, luctus
                            pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt
                            tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis
                            ante.
                        </div>

                        <a href="#" class="btn btn-sm btn-danger mt-1"><i class="feather-sm" data-feather="heart"></i> Like</a>
                    </div>
                </div>

                <hr />
                <div class="d-flex align-items-start">
                    <img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2" alt="Christina Mason">
                    <div class="flex-grow-1">
                        <small class="float-end text-navy">1h ago</small>
                        <strong>Christina Mason</strong> posted a new blog<br />

                        <small class="text-muted">Today 6:35 pm</small>
                    </div>
                </div>

                <hr />
                <div class="d-flex align-items-start">
                    <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="William Harris">
                    <div class="flex-grow-1">
                        <small class="float-end text-navy">3h ago</small>
                        <strong>William Harris</strong> posted two photos on <strong>Christina
                            Mason</strong>'s timeline<br />
                        <small class="text-muted">Today 5:12 pm</small>

                        <div class="row g-0 mt-1">
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                <img src="img/photos/unsplash-1.jpg" class="img-fluid pe-2" alt="Unsplash">
                            </div>
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                <img src="img/photos/unsplash-2.jpg" class="img-fluid pe-2" alt="Unsplash">
                            </div>
                        </div>

                        <a href="#" class="btn btn-sm btn-danger mt-1"><i class="feather-sm" data-feather="heart"></i> Like</a>
                    </div>
                </div>

                <hr />
                <div class="d-flex align-items-start">
                    <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="William Harris">
                    <div class="flex-grow-1">
                        <small class="float-end text-navy">1d ago</small>
                        <strong>William Harris</strong> started following <strong>Christina
                            Mason</strong><br />
                        <small class="text-muted">Yesterday 3:12 pm</small>

                        <div class="d-flex align-items-start mt-1">
                            <a class="pe-3" href="#">
                                <img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2" alt="Christina Mason">
                            </a>
                            <div class="flex-grow-1">
                                <div class="border text-sm text-muted p-2 mt-1">
                                    Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id,
                                    lorem. Maecenas nec odio et ante tincidunt tempus.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />
                <div class="d-flex align-items-start">
                    <img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2" alt="Christina Mason">
                    <div class="flex-grow-1">
                        <small class="float-end text-navy">1d ago</small>
                        <strong>Christina Mason</strong> posted a new blog<br />
                        <small class="text-muted">Yesterday 2:43 pm</small>
                    </div>
                </div>

                <hr />
                <div class="d-flex align-items-start">
                    <img src="img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2" alt="Charles Hall">
                    <div class="flex-grow-1">
                        <small class="float-end text-navy">1d ago</small>
                        <strong>Charles Hall</strong> started following <strong>Christina
                            Mason</strong><br />
                        <small class="text-muted">Yesterdag 1:51 pm</small>
                    </div>
                </div>

                <hr />
                <div class="d-grid">
                    <a href="#" class="btn btn-primary">Load more</a>
                </div>
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
        })
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

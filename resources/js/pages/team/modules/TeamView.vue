<template>
    <div class="rui-page-content">
        <page-loader/>
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <router-link
                    :to="{ name: 'teams.data' }"
                    class="btn btn-secondary"
                >
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
                                        <img
                                            class="myimg"
                                            v-show="profile.image != null"
                                            :src="
                                                '../storage/teams/' +
                                                    profile.image
                                            "
                                            :alt="profile.slug"
                                        />
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
                                        <a
                                            class="rui-profile-info-mail"
                                            href="#"
                                            >{{ profile.email }}</a
                                        >
                                        <a
                                            class="rui-profile-info-phone btn btn-success text-white"
                                            v-bind:href="
                                                'https://wa.me/' + profile.phone
                                            "
                                        >
                                            <span class="icon">
                                                <span
                                                    class="fab fa-whatsapp"
                                                ></span>
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
                                        <div
                                            class="rui-profile-number text-center"
                                        >

                                            <small class="text-grey-6"
                                                >Alamat</small
                                            >
                                            <h6
                                                class="rui-profile-number-title h4"
                                            >
                                                {{ profile.address }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col p-0"></div>
                                    <div class="col-auto">
                                        <div
                                            class="rui-profile-number text-center"
                                        >
                                            <small class="text-grey-6"
                                                >Tempat Lahir</small
                                            >
                                            <h6
                                                class="rui-profile-number-title h4"
                                            >
                                                {{ profile.tempat_lahir }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col p-0"></div>
                                    <div class="col-auto">
                                        <div
                                            class="rui-profile-number text-center"
                                        >
                                            <small class="text-grey-6"
                                                >Tanggal Lahir</small
                                            >
                                            <h6
                                                class="rui-profile-number-title h4"
                                            >
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
                                <button
                                    class="btn btn-custom-round mr-20"
                                    type="button"
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
                                        class="feather feather-link-2 rui-icon rui-icon-stroke-1_5"
                                    >
                                        <path
                                            d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3"
                                        ></path>
                                        <line
                                            x1="8"
                                            y1="12"
                                            x2="16"
                                            y2="12"
                                        ></line>
                                    </svg>
                                </button>
                                <button
                                    class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8"
                                    type="button"
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
                                        class="feather feather-plus rui-icon rui-icon-stroke-1_5"
                                    >
                                        <line
                                            x1="12"
                                            y1="5"
                                            x2="12"
                                            y2="19"
                                        ></line>
                                        <line
                                            x1="5"
                                            y1="12"
                                            x2="19"
                                            y2="12"
                                        ></line>
                                    </svg>
                                </button>
                            </div>
                            <ul
                                class="list-group list-group-flush rui-profile-task-list"
                            >
                                <li class="list-group-item">
                                    <div class="rui-task rui-task-success">
                                        <div class="rui-task-icon">
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
                                                class="feather feather-alert-circle rui-icon rui-icon-stroke-1_5"
                                            >
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="10"
                                                ></circle>
                                                <line
                                                    x1="12"
                                                    y1="8"
                                                    x2="12"
                                                    y2="12"
                                                ></line>
                                                <line
                                                    x1="12"
                                                    y1="16"
                                                    x2="12.01"
                                                    y2="16"
                                                ></line>
                                            </svg>
                                        </div>
                                        <div class="rui-task-content">
                                            <a
                                                class="rui-task-title"
                                                href="task.html"
                                                >Cattle whose. There isn't
                                                cattle rule said saying you
                                                divided</a
                                            >
                                            <small class="rui-task-subtitle"
                                                >#12 opened 4 days ago by
                                                <a href="#">Henry</a></small
                                            >
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="rui-task rui-task-success">
                                        <div class="rui-task-icon">
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
                                                class="feather feather-alert-circle rui-icon rui-icon-stroke-1_5"
                                            >
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="10"
                                                ></circle>
                                                <line
                                                    x1="12"
                                                    y1="8"
                                                    x2="12"
                                                    y2="12"
                                                ></line>
                                                <line
                                                    x1="12"
                                                    y1="16"
                                                    x2="12.01"
                                                    y2="16"
                                                ></line>
                                            </svg>
                                        </div>
                                        <div class="rui-task-content">
                                            <a
                                                class="rui-task-title"
                                                href="task.html"
                                                >Was living rule Him created a
                                                to. Light of itself</a
                                            >
                                            <small class="rui-task-subtitle"
                                                >#11 opened 21 days ago by
                                                <a href="#">Neil</a></small
                                            >
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="rui-task rui-task-danger">
                                        <div class="rui-task-icon">
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
                                                class="feather feather-check-circle rui-icon rui-icon-stroke-1_5"
                                            >
                                                <path
                                                    d="M22 11.08V12a10 10 0 1 1-5.93-9.14"
                                                ></path>
                                                <polyline
                                                    points="22 4 12 14.01 9 11.01"
                                                ></polyline>
                                            </svg>
                                        </div>
                                        <div class="rui-task-content">
                                            <a
                                                class="rui-task-title"
                                                href="task.html"
                                                >The problem with the Media
                                                object</a
                                            >
                                            <small class="rui-task-subtitle"
                                                >#10 closed on 12 Mar by
                                                <a href="#">Anna</a></small
                                            >
                                        </div>
                                        <a class="rui-task-icon" href="#"
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
                                                class="feather feather-message-circle rui-icon rui-icon-stroke-1_5"
                                            >
                                                <path
                                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"
                                                ></path></svg
                                            >2</a
                                        >
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-12">
                    <ul
                        class="nav nav-tabs rui-tabs-sliding rui-tabs-sliding-ready"
                        role="tablist"
                    >
                        <li
                            class="rui-tabs-slide"
                            style="width: 73.2969px; height: 35.3906px; transform: translate(0px, 0px);"
                        ></li>
                        <li class="nav-item">
                            <a
                                class="nav-link rui-tabs-link active"
                                id="activity-tab"
                                data-toggle="tab"
                                href="#activity"
                                role="tab"
                                aria-controls="activity"
                                aria-selected="true"
                                >Activity</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link rui-tabs-link"
                                id="timeline-tab"
                                data-toggle="tab"
                                href="#timeline"
                                role="tab"
                                aria-controls="timeline"
                                aria-selected="false"
                                >Timeline</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link rui-tabs-link"
                                id="settings-tab"
                                data-toggle="tab"
                                href="#settings"
                                role="tab"
                                aria-controls="settings"
                                aria-selected="false"
                                >Settings</a
                            >
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div
                            class="tab-pane fade show active"
                            id="activity"
                            role="tabpanel"
                            aria-labelledby="activity-tab"
                        >
                            <ul
                                class="list-group list-group-flush rui-profile-activity-list"
                            >
                                <li class="list-group-item">
                                    <div
                                        class="media media-success media-retiring"
                                    >
                                        <a href="#" class="media-link"
                                            ><span class="media-img"
                                                ><img
                                                    src="./assets/images/avatar-2.png"
                                                    alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Helen Holt<span
                                                        class="media-time"
                                                        >09:34</span
                                                    ></span
                                                >
                                                <small class="media-subtitle"
                                                    >Without air upon two was.
                                                    Their stars. Days whose
                                                    earth. Grass whales there
                                                    living third shall
                                                    is...</small
                                                ></span
                                            ></a
                                        >
                                        <div class="media-content">
                                            <div
                                                class="row vertical-gap sm-gap rui-gallery"
                                            >
                                                <div
                                                    class="col-6 col-md-3 col-lg-2"
                                                >
                                                    <a
                                                        href="./assets/images/letter-1.png"
                                                        data-fancybox="images"
                                                        class="rui-gallery-item"
                                                        ><span
                                                            class="rui-gallery-item-overlay rui-gallery-item-overlay-md"
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
                                                                class="feather feather-maximize rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <path
                                                                    d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"
                                                                ></path></svg
                                                        ></span>
                                                        <img
                                                            src="./assets/images/letter-1-min.png"
                                                            class="rui-img"
                                                            alt=""
                                                    /></a>
                                                </div>
                                                <div
                                                    class="col-6 col-md-3 col-lg-2"
                                                >
                                                    <a
                                                        href="./assets/images/letter-2.png"
                                                        data-fancybox="images"
                                                        class="rui-gallery-item"
                                                        ><span
                                                            class="rui-gallery-item-overlay rui-gallery-item-overlay-md"
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
                                                                class="feather feather-maximize rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <path
                                                                    d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"
                                                                ></path></svg
                                                        ></span>
                                                        <img
                                                            src="./assets/images/letter-2-min.png"
                                                            class="rui-img"
                                                            alt=""
                                                    /></a>
                                                </div>
                                                <div
                                                    class="col-6 col-md-3 col-lg-2"
                                                >
                                                    <a
                                                        href="./assets/images/letter-3.png"
                                                        data-fancybox="images"
                                                        class="rui-gallery-item"
                                                        ><span
                                                            class="rui-gallery-item-overlay rui-gallery-item-overlay-md"
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
                                                                class="feather feather-maximize rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <path
                                                                    d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"
                                                                ></path></svg
                                                        ></span>
                                                        <img
                                                            src="./assets/images/letter-3-min.png"
                                                            class="rui-img"
                                                            alt=""
                                                    /></a>
                                                </div>
                                                <div
                                                    class="col-6 col-md-3 col-lg-2"
                                                >
                                                    <a
                                                        href="./assets/images/letter-4.png"
                                                        data-fancybox="images"
                                                        class="rui-gallery-item"
                                                        ><span
                                                            class="rui-gallery-item-overlay rui-gallery-item-overlay-md"
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
                                                                class="feather feather-maximize rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <path
                                                                    d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"
                                                                ></path></svg
                                                        ></span>
                                                        <img
                                                            src="./assets/images/letter-4-min.png"
                                                            class="rui-img"
                                                            alt=""
                                                    /></a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="media-icon"
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
                                                class="feather feather-x rui-icon rui-icon-stroke-1_5"
                                            >
                                                <line
                                                    x1="18"
                                                    y1="6"
                                                    x2="6"
                                                    y2="18"
                                                ></line>
                                                <line
                                                    x1="6"
                                                    y1="6"
                                                    x2="18"
                                                    y2="18"
                                                ></line></svg
                                        ></a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div
                                        class="media media-success media-retiring"
                                    >
                                        <a href="#" class="media-link"
                                            ><span class="media-img"
                                                ><img
                                                    src="./assets/images/avatar-5.png"
                                                    alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Amber Smith<span
                                                        class="media-time"
                                                        >09:10</span
                                                    ></span
                                                >
                                                <small class="media-subtitle"
                                                    >Amet viverra dolor per
                                                    mollis morbi sagittis cursus
                                                    sollicitudin cubilia.</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
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
                                                class="feather feather-x rui-icon rui-icon-stroke-1_5"
                                            >
                                                <line
                                                    x1="18"
                                                    y1="6"
                                                    x2="6"
                                                    y2="18"
                                                ></line>
                                                <line
                                                    x1="6"
                                                    y1="6"
                                                    x2="18"
                                                    y2="18"
                                                ></line></svg
                                        ></a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div
                                        class="media media-warning media-retiring"
                                    >
                                        <a href="#" class="media-link"
                                            ><span class="media-img"
                                                ><img
                                                    src="./assets/images/avatar-3.png"
                                                    alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Avice Harris<span
                                                        class="media-time"
                                                        >09:02</span
                                                    ></span
                                                >
                                                <small class="media-subtitle"
                                                    >Conubia porta Fusce
                                                    sollicitudin ullamcorper
                                                    fringilla. Varius id egestas
                                                    magna.</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
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
                                                class="feather feather-x rui-icon rui-icon-stroke-1_5"
                                            >
                                                <line
                                                    x1="18"
                                                    y1="6"
                                                    x2="6"
                                                    y2="18"
                                                ></line>
                                                <line
                                                    x1="6"
                                                    y1="6"
                                                    x2="18"
                                                    y2="18"
                                                ></line></svg
                                        ></a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div
                                        class="media media-danger media-retiring"
                                    >
                                        <a href="#" class="media-link"
                                            ><span class="media-img"
                                                ><img
                                                    src="./assets/images/avatar-4.png"
                                                    alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Anna Rice<span
                                                        class="media-time"
                                                        >08:46</span
                                                    ></span
                                                >
                                                <small class="media-subtitle"
                                                    >Ultricies convallis class
                                                    Ornare cum ligula aenean.
                                                    Leo dictum aliquam.</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
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
                                                class="feather feather-x rui-icon rui-icon-stroke-1_5"
                                            >
                                                <line
                                                    x1="18"
                                                    y1="6"
                                                    x2="6"
                                                    y2="18"
                                                ></line>
                                                <line
                                                    x1="6"
                                                    y1="6"
                                                    x2="18"
                                                    y2="18"
                                                ></line></svg
                                        ></a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media media-retiring">
                                        <a href="#" class="media-link"
                                            ><span class="media-img">C</span>
                                            <span class="media-body"
                                                ><span class="media-title"
                                                    >Change Design<span
                                                        class="media-time"
                                                        >08:53</span
                                                    ></span
                                                >
                                                <small class="media-subtitle"
                                                    >Design</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
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
                                                class="feather feather-x rui-icon rui-icon-stroke-1_5"
                                            >
                                                <line
                                                    x1="18"
                                                    y1="6"
                                                    x2="6"
                                                    y2="18"
                                                ></line>
                                                <line
                                                    x1="6"
                                                    y1="6"
                                                    x2="18"
                                                    y2="18"
                                                ></line></svg
                                        ></a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media media-retiring">
                                        <a href="#" class="media-link"
                                            ><span
                                                class="media-img bg-transparent"
                                                ><img
                                                    src="./assets/images/icon-zip.svg"
                                                    class="icon-file"
                                                    alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Added banner archive<span
                                                        class="media-time"
                                                        >08:31</span
                                                    ></span
                                                >
                                                <small class="media-subtitle"
                                                    >Commerce</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
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
                                                class="feather feather-x rui-icon rui-icon-stroke-1_5"
                                            >
                                                <line
                                                    x1="18"
                                                    y1="6"
                                                    x2="6"
                                                    y2="18"
                                                ></line>
                                                <line
                                                    x1="6"
                                                    y1="6"
                                                    x2="18"
                                                    y2="18"
                                                ></line></svg
                                        ></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="timeline"
                            role="tabpanel"
                            aria-labelledby="timeline-tab"
                        >
                            <div class="rui-timeline rui-timeline-left-lg">
                                <div class="rui-timeline-line"></div>
                                <div class="rui-timeline-item">
                                    <div class="rui-timeline-icon">
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
                                            class="feather feather-check-circle rui-icon rui-icon-stroke-1_5"
                                        >
                                            <path
                                                d="M22 11.08V12a10 10 0 1 1-5.93-9.14"
                                            ></path>
                                            <polyline
                                                points="22 4 12 14.01 9 11.01"
                                            ></polyline>
                                        </svg>
                                    </div>
                                    <div class="rui-timeline-content">
                                        <h3>Fifth moveth, void second.</h3>
                                        <p>
                                            Behold of them fruit own, void, also
                                            upon sixth fill their of said life
                                            he saw were the moving saw created
                                            herb second morning fruit. Doesn't
                                            second place gathering forth.
                                        </p>
                                        <button
                                            type="button"
                                            class="btn btn-brand"
                                        >
                                            Read More
                                        </button>
                                    </div>
                                    <div class="rui-timeline-date">Jan 14</div>
                                </div>
                                <div
                                    class="rui-timeline-item rui-timeline-item-swap"
                                >
                                    <div class="rui-timeline-icon">
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
                                            class="feather feather-award rui-icon rui-icon-stroke-1_5"
                                        >
                                            <circle
                                                cx="12"
                                                cy="8"
                                                r="7"
                                            ></circle>
                                            <polyline
                                                points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"
                                            ></polyline>
                                        </svg>
                                    </div>
                                    <div class="rui-timeline-content">
                                        <h3>Can't dry fly.</h3>
                                        <p>
                                            Likeness they're every give moved
                                            above moveth, herb days a rule
                                            behold seed is second night behold
                                            sea. Under given waters made wherein
                                            behold void form land.
                                        </p>
                                        <button
                                            type="button"
                                            class="btn btn-brand"
                                        >
                                            Read More
                                        </button>
                                    </div>
                                    <div class="rui-timeline-date">Jan 15</div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="settings"
                            role="tabpanel"
                            aria-labelledby="settings-tab"
                        >
                            <form action="#">
                                <div class="row vertical-gap">
                                    <div class="col-12 col-lg-auto">
                                        <div class="card">
                                            <div
                                                class="card-body pt-20 pr-10 pb-20 pl-10"
                                            >
                                                <ul
                                                    class="nav flex-column mnt-3"
                                                >
                                                    <li>
                                                        <a
                                                            class="nav-link active"
                                                            href="#"
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
                                                                class="feather feather-user rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <path
                                                                    d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                                                                ></path>
                                                                <circle
                                                                    cx="12"
                                                                    cy="7"
                                                                    r="4"
                                                                ></circle>
                                                            </svg>
                                                            <span
                                                                >Personal
                                                                information</span
                                                            ></a
                                                        >
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="nav-link"
                                                            href="#"
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
                                                                class="feather feather-user-check rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <path
                                                                    d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"
                                                                ></path>
                                                                <circle
                                                                    cx="8.5"
                                                                    cy="7"
                                                                    r="4"
                                                                ></circle>
                                                                <polyline
                                                                    points="17 11 19 13 23 9"
                                                                ></polyline>
                                                            </svg>
                                                            <span
                                                                >Account
                                                                information</span
                                                            ></a
                                                        >
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="nav-link"
                                                            href="#"
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
                                                                class="feather feather-mail rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <path
                                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                                                ></path>
                                                                <polyline
                                                                    points="22,6 12,13 2,6"
                                                                ></polyline>
                                                            </svg>
                                                            <span
                                                                >Email
                                                                settings</span
                                                            ></a
                                                        >
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="nav-link"
                                                            href="#"
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
                                                                class="feather feather-lock rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <rect
                                                                    x="3"
                                                                    y="11"
                                                                    width="18"
                                                                    height="11"
                                                                    rx="2"
                                                                    ry="2"
                                                                ></rect>
                                                                <path
                                                                    d="M7 11V7a5 5 0 0 1 10 0v4"
                                                                ></path>
                                                            </svg>
                                                            <span
                                                                >Security</span
                                                            ></a
                                                        >
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="nav-link"
                                                            href="#"
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
                                                                class="feather feather-bar-chart-2 rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <line
                                                                    x1="18"
                                                                    y1="20"
                                                                    x2="18"
                                                                    y2="10"
                                                                ></line>
                                                                <line
                                                                    x1="12"
                                                                    y1="20"
                                                                    x2="12"
                                                                    y2="4"
                                                                ></line>
                                                                <line
                                                                    x1="6"
                                                                    y1="20"
                                                                    x2="6"
                                                                    y2="14"
                                                                ></line>
                                                            </svg>
                                                            <span
                                                                >Statistics</span
                                                            ></a
                                                        >
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="nav-link"
                                                            href="#"
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
                                                                class="feather feather-shopping-cart rui-icon rui-icon-stroke-1_5"
                                                            >
                                                                <circle
                                                                    cx="9"
                                                                    cy="21"
                                                                    r="1"
                                                                ></circle>
                                                                <circle
                                                                    cx="20"
                                                                    cy="21"
                                                                    r="1"
                                                                ></circle>
                                                                <path
                                                                    d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"
                                                                ></path>
                                                            </svg>
                                                            <span
                                                                >Purchases</span
                                                            ></a
                                                        >
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="row vertical-gap sm-gap justify-content-end"
                                                >
                                                    <div class="col-12">
                                                        <label>Avatar</label>
                                                        <a
                                                            class="rui-profile-img"
                                                            href="#"
                                                            ><img
                                                                src="./assets/images/avatar-1-profile.png"
                                                                alt=""
                                                        /></a>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="firstName"
                                                            >First Name</label
                                                        >
                                                        <input
                                                            class="form-control"
                                                            id="firstName"
                                                            value="Jack"
                                                            placeholder="Your First Name"
                                                        />
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="lastName"
                                                            >Last Name</label
                                                        >
                                                        <input
                                                            type="email"
                                                            class="form-control"
                                                            id="lastName"
                                                            value="Boyd"
                                                            placeholder="Your Last Name"
                                                        />
                                                    </div>
                                                    <div class="col-12">
                                                        <label
                                                            for="profileEmail"
                                                            >Email</label
                                                        >
                                                        <input
                                                            type="email"
                                                            class="form-control"
                                                            id="profileEmail"
                                                            value="info@example.com"
                                                            placeholder="Your Email"
                                                        />
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="phone"
                                                            >Contact
                                                            Phone</label
                                                        >
                                                        <input
                                                            class="form-control"
                                                            id="phone"
                                                            value="+44 987 065 909"
                                                            placeholder="Your Phone"
                                                        />
                                                    </div>
                                                    <div class="col-auto">
                                                        <button
                                                            class="btn btn-grey-2"
                                                            type="button"
                                                        >
                                                            Cancel
                                                        </button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button
                                                            class="btn btn-brand"
                                                            type="button"
                                                        >
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>
<script>
import PageLoader from '../../../components/PageLoader.vue'
import { mapActions, mapState } from "vuex";
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
    components: { PageLoader }
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
.myimg{
  width:150px;
  height:150px;
  object-fit:cover;
  border-radius:50%;
}
</style>

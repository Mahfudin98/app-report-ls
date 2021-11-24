<template>
    <main>
        <nav class="rui-navbar rui-navbar-top rui-navbar-sticky">
            <div class="rui-navbar-brand">
                <a href="dashboard.html" class="rui-navbar-logo"
                    ><img
                        :src="'/images/logo.svg'"
                        :data-src-night="'/images/logo_putih.png'"
                        :data-src-day="'/images/logo_hitam.png'"
                        alt="logo"
                        width="45"
                    /> </a
                ><button class="yay-toggle rui-yaybar-toggle" type="button">
                    <span></span>
                </button>
            </div>
            <div class="container-fluid">
                <div class="rui-navbar-content">
                    <ul class="nav">
                        <li
                            class="dropdown dropdown-hover dropdown-keep-open dropdown-triangle"
                        ></li>
                    </ul>
                    <ul class="nav rui-navbar-right">
                        <li
                            class="dropdown dropdown-hover dropdown-triangle dropdown-keep-open"
                        >
                            <b-link id="notifikasi" variant="primary" href="#">
                                <span class="btn btn-custom-round"
                                    ><span
                                        class="fas fa-bell"
                                        style="font-size: 15px;"
                                    ></span>
                                    <span class="badge badge-circle badge-brand"
                                        >3</span
                                    ></span
                                >
                                <b-popover
                                    target="notifikasi"
                                    placement="bottom"
                                    triggers="hover focus"
                                >
                                    <template #title>
                                        <div class="d-flex align-items-center">
                                            <h2 class="h4 mb-0 mr-auto">
                                                Notifications
                                            </h2>
                                            <a
                                                class="btn btn-custom-round"
                                                href="profile.html"
                                                ><span
                                                    class="rui-icon fas fa-link"
                                                ></span
                                            ></a>
                                        </div>
                                    </template>
                                    <div
                                        class="media media-success media-filled mnl-30 mnr-30"
                                    >
                                        <a
                                            href="profile.html"
                                            class="media-link"
                                            ><span class="media-img"
                                                ><img src="" alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Amber Smith</span
                                                >
                                                <small class="media-subtitle"
                                                    >Bring abundantly creature
                                                    great...</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
                                            ><span
                                                data-feather="x"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span
                                        ></a>
                                    </div>

                                    <div
                                        class="media media-filled mnl-30 mnr-30"
                                    >
                                        <a
                                            href="profile.html"
                                            class="media-link"
                                            ><span class="media-img">C</span>
                                            <span class="media-body"
                                                ><span class="media-title"
                                                    >Change Design</span
                                                >
                                                <small class="media-subtitle"
                                                    >Design</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
                                            ><span
                                                data-feather="x"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span
                                        ></a>
                                    </div>

                                    <div
                                        class="media media-filled mnl-30 mnr-30"
                                    >
                                        <a
                                            href="profile.html"
                                            class="media-link"
                                            ><span
                                                class="media-img bg-transparent"
                                                ><img
                                                    src=""
                                                    class="icon-file"
                                                    alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Added banner archive</span
                                                >
                                                <small class="media-subtitle"
                                                    >Commerce</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
                                            ><span
                                                data-feather="x"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span
                                        ></a>
                                    </div>
                                </b-popover>
                            </b-link>
                        </li>
                        <li
                            class="dropdown dropdown-hover dropdown-triangle dropdown-keep-open"
                        >
                            <b-link
                                id="popover-1-bottom"
                                variant="primary"
                                href="#"
                            >
                                <img
                                    v-if="authenticated.image != null"
                                    class="myprofile"
                                    :src="
                                        '../storage/teams/' +
                                            authenticated.image
                                    "
                                    :alt="authenticated.name"
                                />
                                <b-img
                                    v-if="authenticated.image == null"
                                    v-bind="mainProps"
                                    rounded="circle"
                                    src="https://picsum.photos/250/250/?image=54"
                                    :alt="authenticated.name"
                                ></b-img>
                                <b-popover
                                    target="popover-1-bottom"
                                    placement="bottom"
                                    triggers="hover focus"
                                >
                                    <template #title>
                                        <router-link
                                            :to="{
                                                name: 'teams.show',
                                                params: {
                                                    slug: authenticated.slug
                                                }
                                            }"
                                        >
                                            {{ authenticated.name }}
                                        </router-link>
                                    </template>
                                    <b-link href="#" @click="logoutPost">
                                        <span
                                            class="fas fa-sign-out-alt"
                                        ></span>
                                        Log Out
                                    </b-link>
                                </b-popover>
                            </b-link>
                        </li>
                        <li
                            class="dropdown dropdown-hover dropdown-triangle dropdown-keep-open"
                        >
                            <b-link id="setting" variant="primary" href="#">
                                <span class="fas fa-ellipsis-v"></span>
                                <b-popover
                                    target="setting"
                                    placement="bottom"
                                    triggers="hover focus"
                                >
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-nightmode-toggle"
                                            id="toggleNightMode"
                                            checked
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleNightMode"
                                        >
                                            Night Mode
                                            <span class="fas fa-moon"></span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-spotlightmode-toggle"
                                            id="toggleSpotlightMode"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleSpotlightMode"
                                            ><span
                                                data-feather="square"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Spotlight Mode</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-sectionLines-toggle"
                                            id="toggleSectionLines"
                                            checked
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleSectionLines"
                                            ><span
                                                data-feather="layout"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Show section lines</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                    <div>Sidebar</div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-darkSidebar-toggle"
                                            id="toggleDarkSidebar"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleDarkSidebar"
                                            ><span
                                                data-feather="sidebar"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Dark</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-staticSidebar-toggle"
                                            id="toggleStaticSidebar"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleStaticSidebar"
                                            ><span
                                                data-feather="sidebar"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Static</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                    <div>Navbar</div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-darkNavbar-toggle"
                                            id="toggleDarkNavbar"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleDarkNavbar"
                                            ><span
                                                data-feather="menu"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Dark</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                </b-popover>
                            </b-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="rui-navbar rui-navbar-mobile">
            <div class="rui-navbar-head">
                <button
                    class="rui-yaybar-toggle rui-yaybar-toggle-inverse yay-toggle"
                    type="button"
                    aria-label="Toggle side navigation"
                >
                    <span></span>
                </button>
                <router-link
                    class="rui-navbar-logo mr-auto"
                    :to="{ name: 'home' }"
                >
                    <img
                        :src="'/images/logo.svg'"
                        :data-src-night="'/images/logo_putih.png'"
                        :data-src-day="'/images/logo_hitam.png'"
                        alt="logo"
                        width="45"
                /></router-link>

                <div class="dropdown dropdown-triangle">
                    <b-link id="profile-mobile" variant="primary" href="#">
                        <img
                            v-if="authenticated.image != null"
                            class="myprofile"
                            :src="'../storage/teams/' + authenticated.image"
                            :alt="authenticated.name"
                        />
                        <b-img
                            v-if="authenticated.image == null"
                            v-bind="mainProps"
                            rounded="circle"
                            src="https://picsum.photos/250/250/?image=54"
                            :alt="authenticated.name"
                        ></b-img>
                        <b-popover
                            target="profile-mobile"
                            placement="bottom"
                            triggers="hover focus"
                        >
                            <template #title>
                                <router-link
                                    :to="{
                                        name: 'teams.show',
                                        params: {
                                            slug: authenticated.slug
                                        }
                                    }"
                                >
                                    {{ authenticated.name }}
                                </router-link>
                            </template>
                            <b-link href="#" @click="logoutPost">
                                <span class="fas fa-sign-out-alt"></span>
                                Log Out
                            </b-link>
                        </b-popover>
                    </b-link>
                </div>
                <button
                    class="navbar-toggler rui-navbar-toggle"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarMobile"
                    aria-controls="navbarMobile"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span></span>
                </button>
            </div>
            <div
                class="collapse navbar-collapse rui-navbar-collapse"
                id="navbarMobile"
            >
                <div class="rui-navbar-content">
                    <ul class="nav">
                        <li class="dropdown dropdown-keep-open">
                            <b-link
                                id="notifikasi-mobile"
                                variant="primary"
                                href="#"
                            >
                                <span
                                    data-feather="bell"
                                    class="rui-icon rui-icon-stroke-1_5"
                                ></span>
                                <span>Notifications</span>
                                <span class="badge badge-circle badge-brand"
                                    >3</span
                                >
                                <span class="rui-dropdown-circle"></span>
                                <b-popover
                                    target="notifikasi-mobile"
                                    placement="bottom"
                                    triggers="hover focus"
                                >
                                    <template #title>
                                        <div class="d-flex align-items-center">
                                            <h2 class="h4 mb-0 mr-auto">
                                                Notifications
                                            </h2>
                                            <a
                                                class="btn btn-custom-round"
                                                href="profile.html"
                                                ><span
                                                    class="rui-icon fas fa-link"
                                                ></span
                                            ></a>
                                        </div>
                                    </template>
                                    <div
                                        class="media media-success media-filled mnl-30 mnr-30"
                                    >
                                        <a
                                            href="profile.html"
                                            class="media-link"
                                            ><span class="media-img"
                                                ><img src="" alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Amber Smith</span
                                                >
                                                <small class="media-subtitle"
                                                    >Bring abundantly creature
                                                    great...</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
                                            ><span
                                                data-feather="x"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span
                                        ></a>
                                    </div>

                                    <div
                                        class="media media-filled mnl-30 mnr-30"
                                    >
                                        <a
                                            href="profile.html"
                                            class="media-link"
                                            ><span class="media-img">C</span>
                                            <span class="media-body"
                                                ><span class="media-title"
                                                    >Change Design</span
                                                >
                                                <small class="media-subtitle"
                                                    >Design</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
                                            ><span
                                                data-feather="x"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span
                                        ></a>
                                    </div>

                                    <div
                                        class="media media-filled mnl-30 mnr-30"
                                    >
                                        <a
                                            href="profile.html"
                                            class="media-link"
                                            ><span
                                                class="media-img bg-transparent"
                                                ><img
                                                    src=""
                                                    class="icon-file"
                                                    alt=""/></span
                                            ><span class="media-body"
                                                ><span class="media-title"
                                                    >Added banner archive</span
                                                >
                                                <small class="media-subtitle"
                                                    >Commerce</small
                                                >
                                            </span></a
                                        ><a href="#" class="media-icon"
                                            ><span
                                                data-feather="x"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span
                                        ></a>
                                    </div>
                                </b-popover>
                            </b-link>
                        </li>
                        <li class="dropdown dropdown-keep-open">
                            <b-link
                                id="setting-mobile"
                                variant="primary"
                                href="#"
                            >
                                <span class="fas fa-ellipsis-v"></span>
                                <span>More</span>
                                <span class="rui-dropdown-circle"></span>
                                <b-popover
                                    target="setting-mobile"
                                    placement="bottom"
                                    triggers="hover focus"
                                >
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-nightmode-toggle"
                                            id="toggleNightMode"
                                            checked
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleNightMode"
                                        >
                                            Night Mode
                                            <span class="fas fa-moon"></span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-spotlightmode-toggle"
                                            id="toggleSpotlightMode"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleSpotlightMode"
                                            ><span
                                                data-feather="square"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Spotlight Mode</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-sectionLines-toggle"
                                            id="toggleSectionLines"
                                            checked
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleSectionLines"
                                            ><span
                                                data-feather="layout"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Show section lines</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                    <div>Sidebar</div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-darkSidebar-toggle"
                                            id="toggleDarkSidebar"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleDarkSidebar"
                                            ><span
                                                data-feather="sidebar"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Dark</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-staticSidebar-toggle"
                                            id="toggleStaticSidebar"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleStaticSidebar"
                                            ><span
                                                data-feather="sidebar"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Static</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                    <div>Navbar</div>
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input rui-darkNavbar-toggle"
                                            id="toggleDarkNavbar"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="toggleDarkNavbar"
                                            ><span
                                                data-feather="menu"
                                                class="rui-icon rui-icon-stroke-1_5"
                                            ></span>
                                            <span>Dark</span>
                                            <span
                                                class="rui-dropdown-circle"
                                            ></span
                                        ></label>
                                    </div>
                                </b-popover>
                            </b-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "NavBar",
    data() {
        return {
            mainProps: { width: 40, height: 40, class: "m1" }
        };
    },
    computed: {
        ...mapState("user", {
            authenticated: state => state.authenticated
        })
    },
    methods: {
        ...mapActions("auth", ["logout"]),
        logoutPost() {
            this.logout().then(() => {
                this.$store.state.token = localStorage.getItem("token");
                this.$router.push("/login");
            });
        }
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
.myprofile {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 50%;
}
</style>

<template>
    <div class="yaybar yay-hide-to-small yay-shrink yay-gestures rui-yaybar">
        <div class="yay-wrap-menu">
            <div class="yaybar-wrap">
                <ul>
                    <li
                        :class="
                            this.$route.name == 'home' ? 'yay-item-active' : ''
                        "
                    >
                        <router-link :to="{ name: 'home' }">
                            <span class="yay-icon">
                                <span
                                    data-feather="home"
                                    class="rui-icon fas fa-home"
                                ></span>
                            </span>
                            <span>Dashboard</span>
                            <span class="rui-yaybar-circle"></span>
                        </router-link>
                    </li>
                    <!-- report -->
                    <li :class="this.$route.name == 'cs.report.data' || 'adv.report.data' || 'report.data.date' ? 'yay-item-active yay-submenu-open' : ''">
                        <a href="#" class="yay-sub-toggle">
                            <span class="yay-icon">
                                <span
                                    data-feather="layers"
                                    class="rui-icon fas fa-layer-group"
                                ></span>
                            </span>
                            <span>Report</span>
                            <span class="rui-yaybar-circle"></span>
                            <span class="yay-icon-collapse">
                                <span
                                    class="fas fa-chevron-circle-right"
                                ></span>
                            </span>
                        </a>
                        <ul class="yay-submenu dropdown-triangle">
                            <li v-if="$can('read reports cs')" :class="this.$route.name == 'cs.report.data' || 'report.data.date' ? 'yay-item-active' : ''">
                                <router-link :to="{ name: 'cs.report.data' }"
                                    >Report CS</router-link
                                >
                            </li>
                            <li v-if="$can('read reports adv')" :class="this.$route.name == 'adv.report.data' ? 'yay-item-active' : ''">
                                <router-link :to="{ name: 'adv.report.data' }"
                                    >Report ADV</router-link
                                >
                            </li>
                        </ul>
                    </li>
                    <!-- project -->
                    <li
                        v-if="$can('read projects')"
                        :class="
                            this.$route.name == 'project.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'project.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span
                                    data-feather="git"
                                    class="rui-icon fab fa-git-alt"
                                ></span>
                            </span>
                            <span>Project Management</span>
                            <span class="rui-yaybar-circle"></span>
                        </router-link>
                    </li>
                    <!-- content -->
                    <li
                        v-if="$can('read contents')"
                        :class="
                            this.$route.name == 'content.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'content.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span class="fas fa-film"></span>
                            </span>
                            <span>Conent</span>
                        </router-link>
                    </li>
                    <!-- stock -->
                    <li
                        v-if="$can('read stocks')"
                        :class="
                            this.$route.name == 'stock.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'stock.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span class="fas fa-people-carry"></span>
                            </span>
                            <span>Stock</span>
                        </router-link>
                    </li>
                    <li class="yay-label">Super Admin</li>
                    <!-- teams -->
                    <li
                        v-if="$can('read teams')"
                        :class="
                            this.$route.name == 'teams.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'teams.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span
                                    data-feather="home"
                                    class="rui-icon fas fa-users"
                                ></span>
                            </span>
                            <span>Team</span>
                            <span class="rui-yaybar-circle"></span>
                        </router-link>
                    </li>
                    <!-- inventory -->
                    <li
                        v-if="$can('read inventories')"
                        :class="
                            this.$route.name == 'inventory.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'inventory.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span class="fab fa-codepen"></span>
                            </span>
                            <span>Inventories</span>
                        </router-link>
                    </li>
                    <!-- position -->
                    <li
                        v-if="$can('read positions')"
                        :class="
                            this.$route.name == 'position.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'position.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span class="fas fa-vote-yea"></span>
                            </span>
                            <span>Positions</span>
                        </router-link>
                    </li>
                    <!-- product -->
                    <li
                        v-if="$can('read products')"
                        :class="
                            this.$route.name == 'product.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'product.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span class="fas fa-box"></span>
                            </span>
                            <span>Product</span>
                        </router-link>
                    </li>
                    <!-- permissions -->
                    <li
                        v-if="authenticated.role == 0"
                        :class="
                            this.$route.name == 'role.permissions'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'role.permissions' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span class="fas fa-users-cog"></span>
                            </span>
                            <span>Settings</span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="rui-yaybar-icons">
            <div class="row no-gutters justify-content-around">
                <div class="col-auto">
                    <a class="btn btn-custom-round" href="#"
                        ><span data-feather="settings" class="rui-icon"></span
                    ></a>
                </div>
                <div class="col-auto">
                    <a class="btn btn-custom-round" href="#"
                        ><span data-feather="bell" class="rui-icon"></span
                    ></a>
                </div>
                <div class="col-auto d-flex">
                    <div
                        class="dropdown dropdown-hover dropdown-triangle dropdown-keep-open dropup"
                    >
                        <a
                            class="btn btn-custom-round dropdown-item"
                            href="#"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-offset="-30"
                            ><span
                                data-feather="plus-circle"
                                class="rui-icon rui-icon-stroke-1_5"
                            ></span
                        ></a>
                        <ul class="dropdown-menu nav">
                            <li>
                                <a href="#" class="nav-link"
                                    ><span
                                        data-feather="plus-circle"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span>
                                    <span>Create new Post</span>
                                    <span class="rui-nav-circle"></span
                                ></a>
                            </li>
                            <li>
                                <a href="#" class="nav-link"
                                    ><span
                                        data-feather="book"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span>
                                    <span>Project</span>
                                    <span class="rui-nav-circle"></span
                                ></a>
                            </li>
                            <li>
                                <a href="#" class="nav-link"
                                    ><span
                                        data-feather="message-circle"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span>
                                    <span>Message</span>
                                    <span class="rui-nav-circle"></span
                                ></a>
                            </li>
                            <li>
                                <a href="#" class="nav-link"
                                    ><span
                                        data-feather="mail"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span>
                                    <span>Mail</span>
                                    <span class="rui-nav-circle"></span
                                ></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <a class="btn btn-custom-round" href="#"
                        ><span
                            data-feather="clock"
                            class="rui-icon rui-icon-stroke-1_5"
                        ></span
                    ></a>
                </div>
                <div class="col-auto">
                    <a class="btn btn-custom-round" href="#"
                        ><span
                            data-feather="heart"
                            class="rui-icon rui-icon-stroke-1_5"
                        ></span
                    ></a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState("user", {
            authenticated: state => state.authenticated //ME-LOAD STATE AUTHENTICATED
        })
    },
    methods: {
        //KETIKA TOMBOL LOGOUT DITEKAN, FUNGSI INI DIJALANKAN
        logout() {
            return new Promise((resolve, reject) => {
                localStorage.removeItem("token"); //MENGHAPUS TOKEN DARI LOCALSTORAGE
                resolve();
            }).then(() => {
                //MEMPERBAHARUI STATE TOKEN
                this.$store.state.token = localStorage.getItem("token");
                this.$router.push("/login"); //REDIRECT KE PAGE LOGIN
            });
        }
    }
};
</script>

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
                    <li
                        :class="
                            this.$route.name == 'cs.report.data' ||
                            this.$route.name == 'adv.report.data' ||
                            this.$route.name == 'report.data.date'
                                ? 'yay-item-active yay-submenu-open'
                                : 'yay-submenu-close'
                        "
                    >
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
                            <li
                                v-if="$can('read reports cs')"
                                :class="
                                    this.$route.name == 'cs.report.data' ||
                                    this.$route.name == 'report.data.date'
                                        ? 'yay-item-active'
                                        : ''
                                "
                            >
                                <router-link :to="{ name: 'cs.report.data' }"
                                    >Report CS</router-link
                                >
                            </li>
                            <li
                                v-if="$can('read reports adv')"
                                :class="
                                    this.$route.name == 'adv.report.data'
                                        ? 'yay-item-active'
                                        : ''
                                "
                            >
                                <router-link :to="{ name: 'adv.report.data' }"
                                    >Report ADV</router-link
                                >
                            </li>
                        </ul>
                    </li>
                    <!-- return -->
                    <li
                        v-if="$can('read reports returns')"
                        :class="
                            this.$route.name == 'return.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'return.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span
                                    data-feather="git"
                                    class="rui-icon fas fa-exchange-alt"
                                ></span>
                            </span>
                            <span>Report Return</span>
                            <span class="rui-yaybar-circle"></span>
                        </router-link>
                    </li>
                    <!-- project -->
                    <!--disabled dulu-->
                    <!--
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
                                    class="rui-icon fas fa-chart-area"
                                ></span>
                            </span>
                            <span>Web Statistik</span>
                            <span class="rui-yaybar-circle"></span>
                        </router-link>
                    </li>
                    -->
                    <!-- content -->
                    <!--disabled dulu-->
                    <!--
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
                    -->
                    <!-- stock -->
                    <!--disabled dulu-->
                    <!--
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
                    -->
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
                    <!-- customer data -->
                    <li
                        v-if="$can('read inventories')"
                        :class="
                            this.$route.name == 'customer.data'
                                ? 'yay-item-active'
                                : ''
                        "
                    >
                        <router-link
                            :to="{ name: 'customer.data' }"
                            class="active"
                        >
                            <span class="yay-icon">
                                <span class="fas fa-user-shield"></span>
                            </span>
                            <span>Data Customer</span>
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
                        v-if="authenticated.role == 0 || $can('create teams')"
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

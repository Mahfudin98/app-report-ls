<template>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <router-link class="sidebar-brand" :to="{ name: 'home' }">
                <img
                    class="img-fluid"
                    :src="'/images/logo.png'"
                    width="100"
                    height="100"
                    alt="logo"
                />
            </router-link>
            <!-- <a class="sidebar-brand" href="index.html">
            <img class="img-fluid" :src="'/images/logo.png'" width="100" height="100" alt="logo">
            <span class="align-middle">AdminKit</span>
        </a> -->

            <ul class="sidebar-nav">
                <li
                    :class="
                        this.$route.name == 'home'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link class="sidebar-link" :to="{ name: 'home' }">
                        <i class="material-icons align-middle">home</i>
                        <span class="align-middle">Dashboard</span>
                    </router-link>
                </li>
                <!--Analisis Product-->
                <li
                    :class="
                        this.$route.name == 'product.chart'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'product.chart' }"
                    >
                        <i class="material-icons align-middle">trending_up</i>
                        <span class="align-middle">Product Analisis</span>
                    </router-link>
                </li>
                <!-- report -->
                <li
                    v-if="$can('read reports cs') || $can('read reports adv')"
                    :class="
                        this.$route.name == 'cs.report.data' ||
                        this.$route.name == 'adv.report.data' ||
                        this.$route.name == 'report.data.date'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <a v-b-toggle="'collapse-2'" class="sidebar-link">
                        <i class="material-icons align-middle">layers</i>
                        <span class="align-middle">Report</span>
                    </a>
                    <!-- <b-button v-b-toggle="'collapse-2'" class="m-1">Toggle Collapse</b-button> -->
                    <b-collapse id="collapse-2">
                        <ul
                            id="dashboards"
                            class="sidebar-dropdown list-unstyled collapse show"
                            data-bs-parent="#sidebar"
                        >
                            <li
                                v-if="$can('read reports cs')"
                                :class="
                                    this.$route.name == 'cs.report.data' ||
                                    this.$route.name == 'report.data.date'
                                        ? 'sidebar-item active'
                                        : 'sidebar-item'
                                "
                            >
                                <router-link
                                    class="sidebar-link"
                                    :to="{ name: 'cs.report.data' }"
                                    >Report CS</router-link
                                >
                            </li>
                            <li
                                v-if="authenticated.position_id == 12"
                                :class="
                                    this.$route.name == 'all.cs.report.data'
                                        ? 'sidebar-item active'
                                        : 'sidebar-item'
                                "
                            >
                                <router-link
                                    class="sidebar-link"
                                    :to="{ name: 'all.cs.report.data' }"
                                    >All Report CS</router-link
                                >
                            </li>
                            <li
                                v-if="$can('read reports adv')"
                                :class="
                                    this.$route.name == 'adv.report.data'
                                        ? 'sidebar-item active'
                                        : 'sidebar-item'
                                "
                            >
                                <router-link
                                    class="sidebar-link"
                                    :to="{ name: 'adv.report.data' }"
                                    >Report ADV</router-link
                                >
                            </li>
                        </ul>
                    </b-collapse>
                </li>
                <!-- return -->
                <li
                    v-if="$can('read reports returns')"
                    :class="
                        this.$route.name == 'return.data'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'return.data' }"
                    >
                        <i class="material-icons align-middle">trending_down</i>
                        <span class="align-middle">Report Return</span>
                    </router-link>
                </li>
                <!-- target -->
                <li
                    v-if="authenticated.role == 0 || $can('read teams')"
                    :class="
                        this.$route.name == 'target.data'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'target.data' }"
                    >
                        <i class="material-icons align-middle">track_changes</i>
                        <span class="align-middle">Target</span>
                    </router-link>
                </li>
                <!-- web static -->
                <li
                    v-if="$can('read projects')"
                    :class="
                        this.$route.name == 'project.data'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'project.data' }"
                    >
                        <i class="material-icons align-middle">insights</i>
                        <span class="align-middle">Web Statistik</span>
                    </router-link>
                </li>
                <!-- content -->
                <!--disabled dulu-->
                <!--
                    <li
                        v-if="$can('read contents')"
                        :class="
                            this.$route.name == 'content.data'
                                ? 'sidebar-item active'
                                : 'sidebar-item'
                        "
                    >
                        <router-link class="sidebar-link"
                            :to="{ name: 'content.data' }"

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
                                ? 'sidebar-item active'
                                : 'sidebar-item'
                        "
                    >
                        <router-link class="sidebar-link"
                            :to="{ name: 'stock.data' }"

                        >
                            <span class="yay-icon">
                                <span class="fas fa-people-carry"></span>
                            </span>
                            <span>Stock</span>
                        </router-link>
                    </li>
                    -->
                <li class="sidebar-header">
                    Super Admin
                </li>
                <!-- teams -->
                <li
                    v-if="$can('read teams')"
                    :class="
                        this.$route.name == 'teams.data'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'teams.data' }"
                    >
                        <i class="material-icons align-middle">people</i>
                        <span class="align-middle">Team</span>
                    </router-link>
                </li>
                <!-- inventory -->
                <li
                    v-if="$can('read inventories')"
                    :class="
                        this.$route.name == 'inventory.data'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'inventory.data' }"
                    >
                        <i class="material-icons align-middle">inventory_2</i>
                        <span class="align-middle">Inventories</span>
                    </router-link>
                </li>
                <!-- customer data -->
                <li
                    v-if="$can('read inventories')"
                    :class="
                        this.$route.name == 'customer.data'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'customer.data' }"
                    >
                        <i class="material-icons align-middle">support_agent</i>
                        <span class="align-middle">Data Customer</span>
                    </router-link>
                </li>
                <!-- position -->
                <li
                    v-if="$can('read positions')"
                    :class="
                        this.$route.name == 'position.data'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'position.data' }"
                    >
                        <i class="material-icons align-middle"
                            >picture_in_picture</i
                        >
                        <span class="align-middle">Position</span>
                    </router-link>
                </li>
                <!-- product -->
                <li
                    v-if="$can('read products')"
                    :class="
                        this.$route.name == 'product.data'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'product.data' }"
                    >
                        <i class="material-icons align-middle"
                            >production_quantity_limits</i
                        >
                        <span class="align-middle">Product</span>
                    </router-link>
                </li>
                <!-- permissions -->
                <li
                    v-if="authenticated.role == 0 || $can('create teams')"
                    :class="
                        this.$route.name == 'role.permissions'
                            ? 'sidebar-item active'
                            : 'sidebar-item'
                    "
                >
                    <router-link
                        class="sidebar-link"
                        :to="{ name: 'role.permissions' }"
                    >
                        <i class="material-icons align-middle">engineering</i>
                        <span class="align-middle">Settings</span>
                    </router-link>
                </li>
            </ul>

            <!-- <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                </div>
            </div>
        </div> -->
        </div>
    </nav>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "SideBar",
    data() {
        return {
            visible: true
        };
    },
    computed: {
        ...mapState("user", {
            authenticated: state => state.authenticated
        })
    }
};
</script>

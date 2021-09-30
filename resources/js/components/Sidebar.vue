<template>
    <aside class="sidebar">
        <div class="sidebar-start">
            <div class="sidebar-head">
                <router-link :to="{ name: 'home' }" class="logo-wrapper">
                    <span class="sr-only">Home</span>
                    <span class="icon logo" aria-hidden="true"></span>
                    <div class="logo-text">
                        <span class="logo-title">Elegant</span>
                        <span class="logo-subtitle">Dashboard</span>
                    </div>
                </router-link>
                <button
                    class="sidebar-toggle transparent-btn"
                    title="Menu"
                    type="button"
                >
                    <span class="sr-only">Toggle menu</span>
                    <span class="icon menu-toggle" aria-hidden="true"></span>
                </button>
            </div>
            <div class="sidebar-body">
                <ul class="sidebar-body-menu">
                    <!-- dashboard -->
                    <li>
                        <router-link :to="{ name: 'home' }" class="active">
                            <lord-icon
                                src="https://cdn.lordicon.com/gmzxduhd.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            >
                            </lord-icon>
                            Dashboard
                        </router-link>
                    </li>
                    <!-- report -->
                    <li>
                        <a class="show-cat-btn" href="##">
                            <lord-icon
                                src="https://cdn.lordicon.com/nocovwne.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            >
                            </lord-icon>
                            Report
                            <span
                                class="category__btn transparent-btn"
                                title="Open list"
                            >
                                <span class="sr-only">Open list</span>
                                <span
                                    class="icon arrow-down"
                                    aria-hidden="true"
                                ></span>
                            </span>
                        </a>
                        <ul class="cat-sub-menu">
                            <li>
                                <router-link :to="{ name: 'cs.report.data' }">Report CS</router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'adv.report.data' }">Report ADV</router-link>
                            </li>
                        </ul>
                    </li>
                    <!-- project -->
                    <li>
                        <router-link
                            :to="{ name: 'project.data' }"
                            class="active"
                        >
                            <lord-icon
                                src="https://cdn.lordicon.com/jvucoldz.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            >
                            </lord-icon>
                            Project
                        </router-link>
                    </li>
                    <!-- content -->
                    <li>
                        <router-link
                            :to="{ name: 'content.data' }"
                            class="active"
                        >
                            <lord-icon
                                src="https://cdn.lordicon.com/tdxypxgp.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            >
                            </lord-icon>
                            Content
                        </router-link>
                    </li>
                    <!-- stock -->
                    <li>
                        <router-link
                            :to="{ name: 'stock.data' }"
                            class="active"
                        >
                            <lord-icon
                                src="https://cdn.lordicon.com/iyqamhwd.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            >
                            </lord-icon>
                            Stock
                        </router-link>
                    </li>
                </ul>
                <span class="system-menu__title">superadmin</span>
                <ul class="sidebar-body-menu">
                    <!-- teams -->
                    <li>
                        <router-link
                            :to="{ name: 'teams.data' }"
                            class="active"
                        >
                            <lord-icon
                                src="https://cdn.lordicon.com/uukerzzv.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            ></lord-icon>
                            Team
                        </router-link>
                    </li>
                    <!-- position -->
                    <li>
                        <router-link
                            :to="{ name: 'position.data' }"
                            class="active"
                        >
                            <lord-icon
                                src="https://cdn.lordicon.com/soseozvi.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            >
                            </lord-icon>
                            Position
                        </router-link>
                    </li>
                    <!-- product -->
                    <li>
                        <router-link
                            :to="{ name: 'product.data' }"
                            class="active"
                        >
                            <lord-icon
                                src="https://cdn.lordicon.com/wfroncyf.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            >
                            </lord-icon>
                            Product
                        </router-link>
                    </li>
                    <!-- permissions -->
                    <li>
                        <router-link
                            :to="{ name: 'role.permissions' }"
                            class="active"
                        >
                            <lord-icon
                                src="https://cdn.lordicon.com/sbiheqdr.json"
                                trigger="loop-on-hover"
                                colors="primary:#ffffff,secondary:#fad1e6"
                                style="width:30px;height:30px"
                            >
                            </lord-icon>
                            Settings
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer">
            <a href="https://www.instagram.com/mahfudin_nawawi/" class="sidebar-user">
                <span class="sidebar-user-img">
                    <lord-icon
                        src="https://cdn.lordicon.com/nobciafz.json"
                        trigger="loop-on-hover"
                        colors="primary:#121331,secondary:#08a88a"
                        style="width:50px;height:50px"
                    >
                    </lord-icon>
                </span>
                <div class="sidebar-user-info">
                    <span class="sidebar-user__title">{{ authenticated.name }}</span>
                    <span class="sidebar-user__subtitle" v-if="authenticated.position_id != null">{{ authenticated.position }}</span>
                </div>
            </a>
        </div>
    </aside>
</template>
<script>
import { mapState, mapActions } from 'vuex'
export default {
    name: "SideBar",
    computed: {
        ...mapState('user', {
            authenticated: state => state.authenticated
        }),
    }
}
</script>

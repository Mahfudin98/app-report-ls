<template>
    <main>
        <!-- <div class="layer"></div> -->
        <main class="d-flex w-100" v-if="!isAuth">
            <!-- ! Main Login -->
            <router-view v-if="!isAuth"></router-view>
        </main>
        <!-- ! Body -->
        <!-- <a class="skip-link sr-only" href="#skip-target" v-if="isAuth">Skip to content</a> -->
        <div class="wrapper" v-if="isAuth">
            <!-- ! Sidebar -->
            <Sidebar v-if="isAuth"/>
            <div class="main" v-if="isAuth">
                <!-- ! Main nav -->
                <Navbar v-if="isAuth"/>
                <!-- ! Main -->
                <router-view v-if="isAuth"></router-view>
                <!-- ! Footer -->
                <Footer v-if="isAuth"/>
            </div>
        </div>
    </main>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import Sidebar from "./components/Sidebar.vue";
import Navbar from "./components/Navbar.vue";
import Footer from "./components/Footer.vue";
export default {
    computed: {
        ...mapState(["token"]),
        ...mapGetters(["isAuth"])
    },
    components: {
        Sidebar: Sidebar,
        Navbar: Navbar,
        Footer: Footer
    }
};
</script>

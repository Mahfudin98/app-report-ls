<template>
    <main>
        <!-- <div class="rui-page-preloader" role="status">
            <div class="rui-page-preloader-inner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div> -->
        <div class="rui-main" v-if="!isAuth">
            <router-view></router-view>
        </div>
        <left-sidebar v-if="isAuth"/>
        <div class="rui-yaybar-bg" v-if="isAuth"></div>
        <new-navbar v-if="isAuth"/>
        <div class="rui-navbar-bg" v-if="isAuth"></div>
        <div class="rui-page content-wrap" v-if="isAuth">
            <router-view></router-view>
            <new-footer/>
        </div>
    </main>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import LeftSidebar from "./components/LeftSidebar.vue";
import NewNavbar from "./components/NewNavbar.vue";
import NewFooter from "./components/NewFooter.vue";
import RightSidebar from "./components/RightSidebar.vue";
export default {
    computed: {
        ...mapState(["token"]),
        ...mapGetters(["isAuth"])
    },
    components: {
        LeftSidebar: LeftSidebar,
        NewNavbar: NewNavbar,
        NewFooter: NewFooter,
        RightSidebar: RightSidebar
    }
};
</script>

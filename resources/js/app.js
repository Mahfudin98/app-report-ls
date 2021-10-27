/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;
import App from "./App.vue";
import New from "./New.vue";
import router from './router.js'
import store from './store.js'

// import plugin sweet alert & bootstrap vue
import { BootstrapVue } from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/src/sweetalert2.scss'
import Permissions from './mixins/permission.js'


// import "vue2-daterange-picker/dist/vue2-daterange-picker.css";
// import DateRangePicker from "vue2-daterange-picker";


Vue.mixin(Permissions)

Vue.use(VueSweetalert2);
Vue.use(BootstrapVue)

var numeral = require("numeral");

Vue.filter("formatNumber", function (value) {
    return numeral(value).format("0,0");
});

import { mapActions, mapGetters } from 'vuex'

const app = new Vue({
    router,
    store,
    el: "#app",
    components: {
        New
    },
    computed: {
        ...mapGetters(['isAuth'])
    },
    methods: {
        ...mapActions('user', ['getUserLogin'])
    },
    created() {
        if (this.isAuth) {
            this.getUserLogin()
        }
    }
});

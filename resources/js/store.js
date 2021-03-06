import Vue from 'vue'
import Vuex from 'vuex'

import auth from './stores/auth.js'
import position from './stores/position.js'
import product from './stores/product.js'
import team from './stores/team.js'
import user from './stores/user.js'
import csReport from './stores/csReport.js'
import dashboard from './stores/dashboard.js'
import advReport from './stores/advReport.js'
import order from './stores/order.js'
import inventory from './stores/inventory.js'
import returnOrder from './stores/returnOrder.js'
import target from './stores/target.js'
import ongkir from './stores/ongkir.js'
import reportWeb from './stores/reportWeb.js'
Vue.use(Vuex)

const store = new Vuex.Store({

    modules: {
        auth,
        position,
        product,
        team,
        user,
        csReport,
        advReport,
        dashboard,
        order,
        inventory,
        returnOrder,
        target,
        ongkir,
        reportWeb
    },

    state: {

        token: localStorage.getItem('token'),
        errors: []
    },
    getters: {
        isAuth: state => {
            return state.token != "null" && state.token != null
        }
    },
    mutations: {

        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        CLEAR_ERRORS(state) {
            state.errors = []
        }
    }
})

export default store

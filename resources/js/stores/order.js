import $axios from '../api'

const state = () => ({
    orders: [],
    leads: [],
    getOrders: []
})

const mutations = {
    ASSIGN_ORDER_DATA(state, payload){
        state.orders = payload
    },
    ASSIGN_LEAD_DATA(state, payload){
        state.leads = payload
    },
    ASSIGN_DATA_GET_ORDER(state, payload){
        state.getOrders = payload
    }
}

const actions = {
    getOrders({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/order?date=${search}`)
            .then((response) => {
                commit('ASSIGN_ORDER_DATA', response.data)
                resolve(response.data)
            })
        })
        .catch((error)=>{
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, {root:true})
            }
        })
    },
    getLeads({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/lead-masuk?date=${search}`)
            .then((response) => {
                commit('ASSIGN_LEAD_DATA', response.data)
                resolve(response.data)
            })
        })
        .catch((error)=>{
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, {root:true})
            }
        })
    },
    getOrdersReturn({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/get-order?q=${search}`)
            .then((response) => {
                commit('ASSIGN_DATA_GET_ORDER', response.data)
                resolve(response.data)
            })
        })
        .catch((error)=>{
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, {root:true})
            }
        })
    },
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}

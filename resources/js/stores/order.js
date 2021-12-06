import $axios from '../api'

const state = () => ({
    orders: [],
    leads: [],
    omsetsAdv: [],
    orderProduct: ''
})

const mutations = {
    ASSIGN_ORDER_DATA(state, payload){
        state.orders = payload
    },
    ASSIGN_LEAD_DATA(state, payload){
        state.leads = payload
    },
    ASSIGN_OMSET_ADV(state, payload){
        state.omsetsAdv = payload
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

    getOmsets({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/adv-omset?date=${search}`)
            .then((response) => {
                commit('ASSIGN_OMSET_ADV', response.data)
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

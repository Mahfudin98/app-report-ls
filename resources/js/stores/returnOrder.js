import $axios from '../api'

const state = () => ({
    orderDetail : [],
    getOrders: []
})

const mutations = {
    ASSIGN_ORDER(state, payload) {
        state.orderDetail = payload
    },
    ASSIGN_DATA_GET_ORDER(state, payload){
        state.getOrders = payload
    }
}

const actions = {
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
    showOrder({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/order-detail/${payload}`)
            .then((response) => {
                commit('ASSIGN_ORDER',response.data)
                resolve(response.data)
            })
        })
        .catch((error) => {
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, { root: true })
            }
        })
    },
    submitReturn({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/return-post`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                dispatch('getOrdersReturn').then(() => {
                    resolve(response.data)
                })
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    },
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}

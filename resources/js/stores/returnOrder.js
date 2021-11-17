import $axios from '../api'

const state = () => ({
    orderDetail : [],
    getOrders: [],
    orderReturn: [],
    pageOrder: 1,
    pageReturn: 1,
})

const mutations = {
    ASSIGN_ORDER(state, payload) {
        state.orderDetail = payload
    },
    ASSIGN_DATA_GET_ORDER(state, payload){
        state.getOrders = payload
    },
    ASSIGN_DATA_ORDER_RETURN(state, payload){
        state.orderReturn = payload
    },
    SET_PAGE_ORDER(state, payload) {
        state.pageOrder = payload
    },
    SET_PAGE_RETURN(state, payload) {
        state.pageReturn = payload
    },
}

const actions = {
    getOrdersReturn({commit, state}, payload){
        let searchOrder = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/get-order?page=${state.pageOrder}&q=${searchOrder}`)
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
    getReturnOrder({commit, state}, payload){
        let searchReturn = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/get-return?page=${state.pageReturn}&q=${searchReturn}`)
            .then((response) => {
                commit('ASSIGN_DATA_ORDER_RETURN', response.data)
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

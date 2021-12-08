import $axios from '../api'

const state = () => ({
    csReports: [],
    page: 1,
    id: '',
    date: '',
    reportcs: [],
    orderProduct: '',
    editOrderProduct: '',
    listCS: [],
    listAllCS: [],
    viewOrder: [],
    editOrder: [],
})

const mutations = {
    ASSIGN_DATA(state, payload){
        state.csReports = payload
    },

    SET_PAGE(state, payload) {
        state.page = payload
    },

    SET_ID_UPDATE(state, payload) {
        state.id = payload
    },

    SET_DATE_UPDATE(state, payload) {
        state.date = payload
    },

    ASSIGN_REPORTCS(state, payload) {
        state.reportcs = payload
    },

    ASSIGN_ORDER_PRODUCT(state, payload){
        state.orderProduct = payload
    },

    ASSIGN_EDIT_ORDER_PRODUCT(state, payload){
        state.editOrderProduct = payload
    },

    ASSIGN_LIST_CS(state, payload){
        state.listCS = payload
    },

    ASSIGN_ALL_LIST_CS(state, payload){
        state.listAllCS = payload
    },

    ASSIGN_VIEW_ORDER(state, payload){
        state.viewOrder = payload
    },

    ASSIGN_EDIT_ORDER(state, payload){
        state.editOrder = payload
    }
}

const actions = {
    getCsReports({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/cs-reports?page=${state.page}&date=${search}`)
            .then((response) => {
                commit('ASSIGN_DATA', response.data)
                resolve(response.data)
            })
        })
        .catch((error)=>{
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, {root:true})
            }
        })
    },

    //view
    viewCsReport({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/cs-reports/${payload}`)
            .then((response) => {
                commit('ASSIGN_REPORTCS',response.data)
                resolve(response.data)
            })
        })
        .catch((error) => {
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, { root: true })
            }
        })
    },

    submitCsReport({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/cs-reports/add`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                dispatch('viewCsReport').then(() => {
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

    submitCustomer({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/cs-reports/customers`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                dispatch('viewCsReport').then(() => {
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

    removePosition({dispatch}, payload){
        return new Promise((resolve, reject) => {
            $axios.delete(`/positions/${payload}`)
            .then((response) => {
                dispatch('getPosition').then(() => resolve())
            })
        })
    },

    addProductOrder({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/add-product-form/${payload}`)
            .then((response) => {
                commit('ASSIGN_ORDER_PRODUCT', response.data)
                resolve(response.data)
            })
        })
    },

    submitProductOrder({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/add-product-form`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                dispatch('viewCsReport').then(() => {
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

    editProductOrder({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/edit-product-form/${payload}`)
            .then((response) => {
                commit('ASSIGN_EDIT_ORDER_PRODUCT', response.data)
                resolve(response.data)
            })
        })
    },

    updateProductOrder({ state }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/update-product-form/${state.id}`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                resolve(response.data)
            })
        })
    },

    removeProductOrder({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/delete-product-order/${payload}`)
            .then((response) => {
                dispatch('viewCsReport').then(() => resolve(response.data))
            })
        })
    },

    // list per user
    getListCS({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/list-user-cs?month=${payload.month}&year=${payload.year}`)
            .then((response) => {
                commit('ASSIGN_LIST_CS', response.data)
                resolve(response.data)
            })
        })
    },

    viewOrderCS({commit, state}, payload){
        let view = typeof payload.view != 'undefined' ? payload.view:''
        return new Promise((resolve, reject) => {
            $axios.get(`/view-report-order?id=${view}&page=${state.page}`)
            .then((response) => {
                commit('ASSIGN_VIEW_ORDER', response.data)
                resolve(response.data)
            })
        })
    },

    getAllListCS({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/list-user-all-cs`)
            .then((response) => {
                commit('ASSIGN_ALL_LIST_CS', response.data)
                resolve(response.data)
            })
        })
    },

    updateCsReport({ state }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/cs-reports/update/${state.id}`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                resolve(response.data)
            })
        })
    },

    editOrderCsReport({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/edit-order/${payload}`)
            .then((response) => {
                commit('ASSIGN_EDIT_ORDER', response.data)
                resolve(response.data)
            })
        })
    },

    updateOrderCsReport({ state }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/update-order/${state.id}`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                resolve(response.data)
            })
        })
    },

    removeOrder({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/delete-order/${payload}`)
            .then((response) => {
                dispatch('viewCsReport').then(() => resolve(response.data))
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

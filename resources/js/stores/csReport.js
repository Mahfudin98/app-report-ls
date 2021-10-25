import $axios from '../api'

const state = () => ({
    csReports: [],
    page: 1,
    id: '',
    date: '',
    reportcs: []
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

    editPosition({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/positions/${payload}/edit`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data.data)
                resolve(response.data)
            })
        })
    },

    updatePosition({state, commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.put(`/positions/${payload}`, state.position)
            .then((response) => {
                commit('CLEAR_FORM')
                resolve(response.data)
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
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}

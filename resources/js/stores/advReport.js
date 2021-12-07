import $axios from '../api'

const state = () => ({
    advReports: [],
    page: 1,
    id: '',
    view: [],
    show: [],
    viewManage: [],
})

const mutations = {
    ASSIGN_DATA(state, payload){
        state.advReports = payload
    },

    SET_PAGE(state, payload) {
        state.page = payload
    },

    SET_ID_UPDATE(state, payload) {
        state.id = payload
    },
    ASSIGN_VIEW(state, payload){
        state.view = payload
    },
    ASSIGN_SHOW(state, payload){
        state.show = payload
    },
    ASSIGN_VIEW_MANAGE(state, payload){
        state.viewManage = payload
    },
}

const actions = {
    getAdvReports({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/adv-reports?page=${state.page}&date=${search}`)
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

    submitAdvReport({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/adv-reports`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                dispatch('getAdvReports').then(() => {
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

    editAdvReport({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/adv-edit/${payload}`)
            .then((response) => {
                resolve(response.data)
            })
        })
    },

    updateAdvReport({state, commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.post(`/adv-update/${state.id}`, payload)
            .then((response) => {
                resolve(response.data)
            })
        })
    },

    removeAdvReport({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/adv-delete/${payload}`)
            .then((response) => {
                dispatch('getAdvReports').then(() => resolve(response.data))
            })
        })
    },
    viewAdvReport({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/adv-view/${payload.start}/${payload.end}`)
            .then((response) => {
                commit('ASSIGN_VIEW',response.data)
                resolve(response.data)
            })
        })
        .catch((error) => {
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, { root: true })
            }
        })
    },
    ShowAdvReport({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/adv-reports/show/${payload}`)
            .then((response) => {
                commit('ASSIGN_SHOW',response.data)
                resolve(response.data)
            })
        })
        .catch((error) => {
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, { root: true })
            }
        })
    },
    viewManageAdvReport({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/adv-view/${payload.id}/${payload.start}/${payload.end}`)
            .then((response) => {
                commit('ASSIGN_VIEW_MANAGE',response.data)
                resolve(response.data)
            })
        })
        .catch((error) => {
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, { root: true })
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

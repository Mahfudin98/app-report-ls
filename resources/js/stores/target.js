import $axios from '../api'

const state = () => ({
    targets: [],
    profile: [],
    page: 1,
    id: '',
    slug: ''
})

const mutations = {
    ASSIGN_DATA(state, payload){
        state.targets = payload
    },

    SET_PAGE(state, payload) {
        state.page = payload
    },

    SET_ID_UPDATE(state, payload) {
        state.id = payload
    },

    ASSIGN_PROFILE(state, payload) {
        state.profile = payload
    }
}

const actions = {
    getTarget({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/target?page=${state.page}&q=${search}`)
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

    submitTarget({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/post-target`, payload)
            .then((response) => {
                dispatch('getTarget').then(() => {
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

    editTeam({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/targets/${payload}/edit`)
            .then((response) => {
                resolve(response.data)
            })
        })
    },
    updateTeam({ state }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/targets-update/${state.id}`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                resolve(response.data)
            })
        })
    },

    removeTeam({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/targets/${payload}`)
            .then((response) => {
                dispatch('getTeams').then(() => resolve(response.data))
            })
        })
    },

    showTeam({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/targets/${payload}`)
            .then((response) => {
                commit('ASSIGN_PROFILE',response.data)
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

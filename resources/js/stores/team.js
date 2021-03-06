import $axios from '../api'

const state = () => ({
    teams: [],
    profile: [],
    page: 1,
    id: '',
    slug: ''
})

const mutations = {
    ASSIGN_DATA(state, payload){
        state.teams = payload
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
    getTeams({commit, state}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/teams?page=${state.page}&q=${search}`)
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

    submitTeam({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/teams`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                dispatch('getTeams').then(() => {
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
            $axios.get(`/teams/${payload}/edit`)
            .then((response) => {
                resolve(response.data)
            })
        })
    },
    updateTeam({ state }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/teams-update/${state.id}`, payload, {
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
            $axios.delete(`/teams/${payload}`)
            .then((response) => {
                dispatch('getTeams').then(() => resolve(response.data))
            })
        })
    },

    showTeam({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/teams/${payload}`)
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

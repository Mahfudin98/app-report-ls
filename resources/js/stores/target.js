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
    getTargets({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/target?month=${payload.month}&year=${payload.year}`)
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
            $axios.post(`/post-target`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                resolve(response.data)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    },

    editTarget({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/target/${payload}/edit`)
            .then((response) => {
                resolve(response.data)
            })
        })
    },
    updateTarget({ state }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/update-target/${state.id}`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                resolve(response.data)
            })
        })
    },
    removeTarget({dispatch}, payload){
        return new Promise((resolve, reject) => {
            $axios.delete(`/target-delete/${payload}`)
            .then((response) => {
                resolve(response.data)
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

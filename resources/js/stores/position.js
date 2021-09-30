import $axios from '../api'

const state = () => ({
    positions: [],

    position: {
        name: '',
        slug: ''
    },
})

const mutations = {
    ASSIGN_DATA(state, payload){
        state.positions = payload
    },

    ASSIGN_FORM(state, payload){
        state.position = {
            name: payload.name,
            slug: payload.slug
        }
    },

    CLEAR_FORM(state, payload){
        state.position = {
            name: '',
            slug: ''
        }
    }
}

const actions = {
    getPositions({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/positions?q=${search}`)
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

    submitPosition({dispatch, commit, state}){
        return new Promise((resolve, reject) => {
            $axios.post(`/positions`, state.position)
            .then((response) => {
                dispatch('getPositions').then(() => {
                    commit('CLEAR_FORM')
                    resolve(response.data)
                })
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root:true })
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
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}

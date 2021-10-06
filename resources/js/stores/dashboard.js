import $axios from '../api.js'

const state = () => ({
    omsets: [],
})

const mutations = {

    ASSIGN_DATA_TRANSACTION(state, payload) {
        state.omsets = payload
    }
}

const actions = {
    getChartData({ commit }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/chart?date=${search}`)
            .then((response) => {
                commit('ASSIGN_DATA_TRANSACTION', response.data)
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

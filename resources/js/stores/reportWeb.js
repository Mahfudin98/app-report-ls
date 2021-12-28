import $axios from '../api'

const state = () => ({
    reportWebs: [],
    webBar: [],
    viewReportWebs: []
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.reportWebs = payload
    },

    ASSIGN_WEB_BAR_DATA(state, payload) {
        state.webBar = payload
    },

    ASSIGN_VIEW_REPORT_WEB(state, payload) {
        state.viewReportWebs = payload
    }
}

const actions = {
    getReportWebs({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
                $axios.get(`/report-web`)
                    .then((response) => {
                        commit('ASSIGN_DATA', response.data)
                        resolve(response.data)
                    })
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
    },

    submitReportWebs({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/report-web`, payload, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                dispatch('getReportWebs').then(() => {
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

    getViewReportWeb({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/report-web/view/${payload}`)
            .then((response) => {
                commit('ASSIGN_VIEW_REPORT_WEB',response.data)
                resolve(response.data)
            })
        })
        .catch((error) => {
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, { root: true })
            }
        })
    },

    // analisis
    getChartBarWeb({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/chart-web?month=${payload.month}&year=${payload.year}`)
                .then((response) => {
                    commit('ASSIGN_WEB_BAR_DATA', response.data)
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

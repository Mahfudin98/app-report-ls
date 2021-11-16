import $axios from '../api.js'

const state = () => ({
    omsets: [],
    persentasecs: [],
    allOmsets: [],
    dataCustomers: [],

    page: 1
})

const mutations = {
    ASSIGN_DATA(state, payload){
        state.dataCustomers = payload
    },

    SET_PAGE(state, payload) {
        state.page = payload
    },
    ASSIGN_DATA_OMSET(state, payload) {
        state.omsets = payload
    },
    ASSIGN_DATA_PERSENTASE_CS(state, payload) {
        state.persentasecs = payload
    },
    ASSIGN_DATA_ALL_OMSET(state, payload) {
        state.allOmsets = payload
    }
}

const actions = {
    getChartBarOmset({ commit }, payload) {
        let barOmset = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/chart?date=${barOmset}`)
            .then((response) => {
                commit('ASSIGN_DATA_OMSET', response.data)
                resolve(response.data)
            })
        })
    },
    getChartPersentaseCS({ commit }, payload) {
        let persen = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/persentase-cs?date=${persen}`)
            .then((response) => {
                commit('ASSIGN_DATA_PERSENTASE_CS', response.data)
                resolve(response.data)
            })
        })
    },
    getChartAllOrder({commit}, payload) {
        return new Promise((resolve, reject) => {
            //MINTA DATA CHART TRANSAKSI KE SERVER BERDASARKAN BULAN DAN TAHUN
            $axios.get(`/omset?month=${payload.month}&year=${payload.year}`)
            .then((response) => {
                //KEMUDIAN KIRIM DATA NYA KE MUTATION UNTUK KEMUDIAN DISIMPAN KE STATE
                commit('ASSIGN_DATA_ALL_OMSET', response.data)
                resolve(response.data)
            })
        })
    },
    getDataCustomer({commit, state}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/list-customer?page=${state.page}&date=${search}`)
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
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}

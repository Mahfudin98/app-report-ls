import $axios from '../api.js'

const state = () => ({
    transactions: [], //STATE UNTUK MENYIMPAN DATA TRANSAKSI
})

const mutations = {
    //MUTATION UNTUK MEMANIPULASI DATA STATE TRANSAKSI
    ASSIGN_DATA_TRANSACTION(state, payload) {
        state.transactions = payload
    }
}

const actions = {
    //ACTION UNTUK MENG-HANDLE REQUEST KE SERVER
    getChartData({ commit }, payload) {
        return new Promise((resolve, reject) => {
            //MINTA DATA CHART TRANSAKSI KE SERVER BERDASARKAN BULAN DAN TAHUN
            $axios.get(`/chart?month=${payload.month}&year=${payload.year}`)
            .then((response) => {
                //KEMUDIAN KIRIM DATA NYA KE MUTATION UNTUK KEMUDIAN DISIMPAN KE STATE
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

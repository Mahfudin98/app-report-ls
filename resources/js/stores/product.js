import $axios from '../api'

const state = () => ({
    products: [],

    product: {
        name: '',
        price: '',
        weight: '',
        stock: '',
        type_pembelian: '',
        type_product: ''
    },
    bar: [],
    lists: [],
    donat: [],
    page: 1
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.products = payload
    },

    SET_PAGE(state, payload) {
        state.page = payload
    },

    ASSIGN_FORM(state, payload) {
        state.product = {
            name: payload.name,
            price: payload.price,
            stock: payload.stock,
            weight: payload.weight,
            type_pembelian: payload.type_pembelian,
            type_product: payload.type_product
        }
    },

    CLEAR_FORM(state, payload) {
        state.product = {
            name: '',
            price: '',
            stock: '',
            weight: '',
            type_pembelian: '',
            type_product: ''
        }
    },

    // analisis
    ASSIGN_DATA_BAR(state, payload) {
        state.bar = payload
    },
    ASSIGN_DATA_LIST(state, payload) {
        state.lists = payload
    },
    ASSIGN_DATA_DONAT(state, payload) {
        state.donat = payload
    }
}

const actions = {
    getProducts({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
                $axios.get(`/products?page=${state.page}&q=${search}`)
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

    submitProduct({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            $axios.post(`/products`, state.product)
                .then((response) => {
                    dispatch('getProducts').then(() => {
                        commit('CLEAR_FORM')
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

    editProduct({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/products/${payload}/edit`)
                .then((response) => {
                    commit('ASSIGN_FORM', response.data.data)
                    resolve(response.data)
                })
        })
    },

    updateProduct({ state, commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.put(`/products/${payload}`, state.product)
                .then((response) => {
                    commit('CLEAR_FORM')
                    resolve(response.data)
                })
        })
    },

    removeProduct({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/products/${payload}`)
                .then((response) => {
                    dispatch('getProducts').then(() => resolve())
                })
        })
    },

    getAllProducts({ commit, state }, payload) {
        return new Promise((resolve, reject) => {
                $axios.get(`/all-product`)
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

    // analisis
    getChartBar({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/product-chart?month=${payload.month}&year=${payload.year}`)
                .then((response) => {
                    commit('ASSIGN_DATA_BAR', response.data)
                    resolve(response.data)
                })
        })
    },
    getListChart({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/product-chart-list?month=${payload.month}&year=${payload.year}`)
                .then((response) => {
                    commit('ASSIGN_DATA_LIST', response.data)
                    resolve(response.data)
                })
        })
    },

    getDonatChart({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/product-presentase?month=${payload.month}&year=${payload.year}`)
                .then((response) => {
                    commit('ASSIGN_DATA_DONAT', response.data)
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
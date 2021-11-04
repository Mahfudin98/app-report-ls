import $axios from '../api'

const state = () => ({
    products: [],

    product: {
        name: '',
        price: '',
        type_pembelian: '',
        type_product: ''
    },

    page: 1
})

const mutations = {
    ASSIGN_DATA(state, payload){
        state.products = payload
    },

    SET_PAGE(state, payload) {
        state.page = payload
    },

    ASSIGN_FORM(state, payload){
        state.product = {
            name: payload.name,
            price: payload.price,
            type_pembelian: payload.type_pembelian,
            type_product: payload.type_product
        }
    },

    CLEAR_FORM(state, payload){
        state.product = {
            name: '',
            price: '',
            type_pembelian: '',
            type_product: ''
        }
    }
}

const actions = {
    getProducts({commit, state}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/products?page=${state.page}&q=${search}`)
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

    submitProduct({dispatch, commit, state}){
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
                    commit('SET_ERRORS', error.response.data.errors, { root:true })
                }
            })
        })
    },

    editProduct({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/products/${payload}/edit`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data.data)
                resolve(response.data)
            })
        })
    },

    updateProduct({state, commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.put(`/products/${payload}`, state.product)
            .then((response) => {
                commit('CLEAR_FORM')
                resolve(response.data)
            })
        })
    },

    removeProduct({dispatch}, payload){
        return new Promise((resolve, reject) => {
            $axios.delete(`/products/${payload}`)
            .then((response) => {
                dispatch('getProducts').then(() => resolve())
            })
        })
    },

    getAllProducts({commit, state}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/all-product`)
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

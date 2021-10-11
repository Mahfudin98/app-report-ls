import $axios from '../api'

const state = () => ({
    inventorys: [],

    inventory: {
        name: ''
    },

    inventoriUsages: [],
    slug: '',
    inventoryUsageShow: [],
})

const mutations = {
    ASSIGN_DATA(state, payload){
        state.inventorys = payload
    },

    ASSIGN_INVENTORI_USAGE_DATA(state, payload){
        state.inventoriUsages = payload
    },

    ASSIGN_FORM(state, payload){
        state.inventory = {
            name: payload.name,
        }
    },

    ASSIGN_PROFILE_INVENTORY_USAGE_SHOW(state, payload) {
        state.inventoryUsageShow = payload
    },

    CLEAR_FORM(state, payload){
        state.inventory = {
            name: '',
        }
    }
}

const actions = {
    getInventorys({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/inventorys?q=${search}`)
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

    submitInventory({dispatch, commit, state}){
        return new Promise((resolve, reject) => {
            $axios.post(`/inventorys`, state.inventory)
            .then((response) => {
                dispatch('getInventorys').then(() => {
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

    editInventory({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/inventorys/${payload}/edit`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data.data)
                resolve(response.data)
            })
        })
    },

    updateInventory({state, commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.put(`/inventorys/${payload}`, state.inventory)
            .then((response) => {
                commit('CLEAR_FORM')
                resolve(response.data)
            })
        })
    },

    removeInventory({dispatch}, payload){
        return new Promise((resolve, reject) => {
            $axios.delete(`/inventorys/${payload}`)
            .then((response) => {
                dispatch('getInventory').then(() => resolve())
            })
        })
    },

    // usage
    getInventorUsages({commit}, payload){
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/inventorys/usage?q=${search}`)
            .then((response) => {
                commit('ASSIGN_INVENTORI_USAGE_DATA', response.data)
                resolve(response.data)
            })
        })
        .catch((error)=>{
            if (error.response.status == 422) {
                commit('SET_ERRORS', error.response.data.errors, {root:true})
            }
        })
    },
    submitInventoriUsage({dispatch, commit}, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/inventorys/usage`, payload)
            .then((response) => {
                dispatch('getInventorUsages').then(() => {
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
    showInventoriUsage({commit}, payload){
        return new Promise((resolve, reject) => {
            $axios.get(`/inventorys/usage/${payload}`)
            .then((response) => {
                commit('ASSIGN_PROFILE_INVENTORY_USAGE_SHOW',response.data)
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

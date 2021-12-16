import $axios from "../api";

const state = () => ({
    provinces: [],
    cities: [],
    districts: [],
    costs: []
});

const mutations = {
    ASSIGN_PROVINCES_DATA(state, payload) {
        state.provinces = payload;
    },

    ASSIGN_CITIES_DATA(state, payload) {
        state.cities = payload;
    },

    ASSIGN_DISTRICTS_DATA(state, payload) {
        state.districts = payload;
    },

    ASSIGN_COSTS_DATA(state, payload) {
        state.costs = payload;
    }
};

const actions = {
    getProvinces({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/provinces`).then(response => {
                commit("ASSIGN_PROVINCES_DATA", response.data);
                resolve(response.data);
            });
        });
    },

    getCities({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/cities/${payload}`).then(response => {
                commit("ASSIGN_CITIES_DATA", response.data);
                resolve(response.data);
            });
        });
    },

    getDistricts({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/district/${payload}`).then(response => {
                commit("ASSIGN_DISTRICTS_DATA", response.data);
                resolve(response.data);
            });
        });
    },

    submitCost({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/checkOngkir`, payload).then(response => {
                commit("ASSIGN_COSTS_DATA", response.data);
                resolve(response.data);
            });
        });
    }
};

export default {
    namespaced: true,
    state,
    actions,
    mutations
};
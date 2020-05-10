import Vue from "vue";
import Vuex from "vuex";
import VuexPersistance from "vuex-persist";

import { authStore } from "./modules/auth/authStore";
import { profileStore } from "./modules/profiles/profileStore";
import { postStore } from "./modules/posts/postStore";
import axios from "../axios/axios";

const VuexPersist = new VuexPersistance({
    key: "vuex-solidarity",
    storage: window.localStorage,
});

Vue.use(Vuex);

const initState = {
    backdoor: false,
    city_id: 1,
    cities: []
};

export default new Vuex.Store({
    state: initState,
    mutations: {
        setBackdoor(state) {
            state.backdoor = true;
        },
        setCityId(state, city_id) {
            state.city_id = city_id;
        },
        setCities(state, cities) {
            state.cities = cities;
        },
        resetState(state) {
            state.city_id = "";
        },
    },
    actions: {
        resetAllStates({ commit }) {
            commit("auth/resetState");
            commit("post/resetState");
            commit("profile/resetState");
        },
        setCityId({ commit }, city_id) {
            commit("setCityId", city_id);
        },
        async fetchCities({ commit }) {

            const response = await axios
                .get(`/api/v1/cities`)
                .then((res) => res.data);

            if (!response) return;

            await commit("setCities", response);

            return response;
        }
    },
    getters: {
        getBackdoor(state) {
            return state.backdoor;
        },
        getCityId(state) {
            return state.city_id;
        },
        getCities(state) {
            return state.cities;
        },
    },
    modules: {
        auth: authStore,
        profile: profileStore,
        post: postStore,
    },
    plugins: [VuexPersist.plugin],
});

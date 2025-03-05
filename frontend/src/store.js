// store.js
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loggedIn: false,
    },
    mutations: {
        toggleLogin(state) {
            state.loggedIn = !state.loggedIn;
        },
        },
    actions: {
        toggleLogin({ commit }) {
            commit('toggleLogin');
        },
    },
    getters: {
        isLoggedIn: (state) => state.loggedIn,
    },
});
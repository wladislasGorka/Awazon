import { createApp } from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import { createRouter, createWebHistory } from 'vue-router'
import {routes} from './routes.js'
import { createStore } from 'vuex'


const router = createRouter({
  history: createWebHistory(),
  routes,
})

loadFonts()

const store = createStore({
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


const app = createApp(App);
app.use(vuetify)
   .use(require('vue-cookies'))
   .use(router)
   .use(store)
   .mount('#app');
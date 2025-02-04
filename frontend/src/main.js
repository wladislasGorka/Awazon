import { createApp } from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import { createRouter, createWebHistory } from 'vue-router'
import {routes} from './routes.js'

const router = createRouter({
  history: createWebHistory(),
  routes,
})

loadFonts()

createApp(App)
  .use(vuetify)
  .use(router)
  .mount('#app')
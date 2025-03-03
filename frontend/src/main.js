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

const app = createApp(App);
app.use(vuetify)
   .use(require('vue-cookies'))
   .use(router)
   .mount('#app');
import { createApp } from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import { createRouter, createWebHistory } from 'vue-router'
import {routes} from './routes.js'
import { initializeApp } from "firebase/app";
import { fetchProducts } from './routes';
// import { getAnalytics } from "firebase/analytics";


const router = createRouter({
  history: createWebHistory(),
  routes,
})

const firebaseConfig = {
  apiKey: "AIzaSyDjaPqFdZIsKh9MhxuDYQ0Kq-VDDXlcxkY",
  authDomain: "testprojectworkplace.firebaseapp.com",
  projectId: "testprojectworkplace",
  storageBucket: "testprojectworkplace.firebasestorage.app",
  messagingSenderId: "459786838119",
  appId: "1:459786838119:web:a752d328672608252eb4c2",
  measurementId: "G-J2DVM70LXN"
};

initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);

loadFonts()

const app = createApp({
  data() {
    return {
      products: [],
    };
  },
  async mounted() {
    this.products = await fetchProducts();
  },
  render: h => h(App),
});
app.use(vuetify)
   .use(router)
   .mount('#app');
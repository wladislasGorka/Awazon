import { createApp } from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import { createRouter, createWebHistory } from 'vue-router'
import {routes} from './routes.js'
import { initializeApp } from "firebase/app";
import { getAuth } from 'firebase/auth';
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

const firebaseApp = initializeApp(firebaseConfig);
const auth = getAuth(firebaseApp);
// const analytics = getAnalytics(app);

loadFonts()

const app = createApp(App);
app.config.globalProperties.$firebaseAuth = auth; // Make Firebase Auth available globally
app.use(vuetify)
   .use(router)
   .mount('#app');
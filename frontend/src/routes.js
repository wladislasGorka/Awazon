import HelloWorld from './components/HelloWorld.vue'
import RegisterView from './components/RegisterView.vue'
import ProductView from './components/ProductView.vue'
import LoginView from './components/LoginView.vue'
import LogoutView from './components/LogoutView.vue'

export const routes = [
  { path: '/', component: HelloWorld },
  { path: '/Register', component: RegisterView },
  { path: '/Product', component: ProductView },
  { path: '/Login', component: LoginView },
  { path: '/Logout', component: LogoutView }
]


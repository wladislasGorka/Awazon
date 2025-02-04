import HelloWorld from './components/HelloWorld.vue'
import RegisterView from './components/RegisterView.vue'
import LoginView from './components/LoginView.vue'

export const routes = [
  { path: '/', component: HelloWorld },
  { path: '/Register', component: RegisterView },
  { path: '/Login', component: LoginView }
]


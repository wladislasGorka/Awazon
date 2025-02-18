import HelloWorld from './components/HelloWorld.vue'
import UsersView from './components/UsersView.vue'
import RegisterMemberView from './components/RegisterMemberView.vue'
import RegisterMerchantView from './components/RegisterMerchantView.vue'
import ProductView from './components/ProductView.vue'
import LoginView from './components/LoginView.vue'
import LogoutView from './components/LogoutView.vue'

export const routes = [
  { path: '/', component: HelloWorld },
  { path: '/Users', component: UsersView },
  { path: '/RegisterMember', component: RegisterMemberView },
  { path: '/RegisterMerchant', component: RegisterMerchantView },
  { path: '/Product', component: ProductView },
  { path: '/Login', component: LoginView },
  { path: '/Logout', component: LogoutView }
]


import HelloWorld from './components/HelloWorld.vue'
import UsersView from './components/UsersView.vue'
import RegisterMemberView from './components/RegisterMemberView.vue'
import RegisterMerchantView from './components/RegisterMerchantView.vue'
import ProductView from './components/ProductView.vue'
import LoginView from './components/LoginView.vue'
import LogoutView from './components/LogoutView.vue'
import EventsView from './components/EventView.vue'
import ForumView from './components/ForumView.vue'
import ShopsView from './components/ShopsView.vue'
import ProductsView from './components/ProductsView.vue'
import ContactView from './components/ContactView.vue'
import CartView from './components/CartView.vue'
import OrderView from './components/OrderView.vue'
import ForumSubjectView from './components/ForumSubjectView.vue'
import ForumSectionView from './components/ForumSectionView.vue'

export const routes = [
  { path: '/', component: HelloWorld },
  { path: '/Users', component: UsersView },
  { path: '/RegisterMember', component: RegisterMemberView },
  { path: '/RegisterMerchant', component: RegisterMerchantView },
  { path: '/Product', component: ProductView },
  { path: '/Login', component: LoginView },
  { path: '/Logout', component: LogoutView },
  { path: '/Events', component: EventsView },
  { path: '/Forum', component: ForumView },
  { path: '/Shops', component: ShopsView },
  { path: '/Products', component: ProductsView },
  { path: '/Contact', component: ContactView },
  { path : '/Cart', component: CartView },
  { path : '/Order', component: OrderView },
  { path : '/ForumSubject', component: ForumSubjectView },
  { path : '/ForumSection', component: ForumSectionView }
]

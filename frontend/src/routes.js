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
import ShopDetailView from './components/ShopDetailView.vue'
import ProductsView from './components/ProductsView.vue'
import ProductDetailView from './components/ProductDetailView.vue'
import ContactView from './components/ContactView.vue'
import CartView from './components/CartView.vue'
import OrderView from './components/OrderView.vue'
import ForumSubjectView from './components/ForumSubjectView.vue'
import ForumSectionView from './components/ForumSectionView.vue'
// Dashboard Merchant Routes
import DashboardMerchantView from './components/DashboardMerchantView.vue'
import DashboardMerchantShopView from './components/DashboardMerchant/ShopView.vue'
import DashboardMerchantProductsView from './components/DashboardMerchant/ProductsView.vue'
import DashboardMerchantOrdersView from './components/DashboardMerchant/OrdersView.vue'


export const routes = [
  { path: '/', component: HelloWorld },
  { path: '/home', component: HelloWorld },
  { path: '/Users', component: UsersView },
  { path: '/RegisterMember', component: RegisterMemberView },
  { path: '/RegisterMerchant', component: RegisterMerchantView },
  { path: '/Product', component: ProductView },
  { path: '/Login', component: LoginView },
  { path: '/Logout', component: LogoutView },
  { path: '/Events', component: EventsView },
  { path: '/Forum', component: ForumView },
  { path: '/Shops/:id', component: ShopDetailView },
  { path: '/Shops', component: ShopsView },
  { path: '/Products/:id', component: ProductDetailView },
  { path: '/Products', component: ProductsView },
  { path: '/Contact', component: ContactView },
  { path : '/Cart', component: CartView },
  { path : '/Order', component: OrderView },
  { path : '/ForumSubject', component: ForumSubjectView },
  { path : '/ForumSection', component: ForumSectionView },
  // Dashboard Merchant Routes
  { path: '/Dashboard/:id/Shop', component: DashboardMerchantShopView },
  { path: '/Dashboard/:id/Products', component: DashboardMerchantProductsView },
  { path: '/Dashboard/:id/Orders', component: DashboardMerchantOrdersView },
  { path: '/Dashboard', component: DashboardMerchantView },

]
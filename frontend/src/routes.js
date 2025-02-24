import HelloWorld from './components/HelloWorld.vue'
import UsersView from './components/UsersView.vue'
import RegisterMemberView from './components/RegisterMemberView.vue'
import RegisterMerchantView from './components/RegisterMerchantView.vue'
import ProductView from './components/ProductView.vue'
import LoginView from './components/LoginView.vue'
import LogoutView from './components/LogoutView.vue'
import EventsView from './components/EventsView.vue'
import ForumView from './components/ForumView.vue'
import ShopsView from './components/ShopsView.vue'
import ProductsView from './components/ProductsView.vue'
import ContactView from './components/ContactView.vue'

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
]

export const fetchProducts = async () => {
  try {
      const response = await fetch('/product');
      const data = await response.json();
      return data;
  } catch (error) {
      console.error('Erreur lors de la récupération des produits :', error);
      return [];
  }
};

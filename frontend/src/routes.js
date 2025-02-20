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

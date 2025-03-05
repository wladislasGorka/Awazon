<template>
  <v-app>
   <v-container>
    <h1>Bienvenue sur AWAZON</h1>
    <MapComponent /> <!-- Intégration du composant Map -->
      <SalesSlider :sales="sales" />
      <ShopSlider :shops="shop" />
      <div v-if="fetchError" class="error-message">
        {{ fetchError }}
      </div>
    </v-container>
   </v-app>
</template>

<script>
import MapComponent from './MapComponent.vue';
import SalesSlider from './SalesSlider.vue';
import ShopSlider from './ShopSlider.vue';

export default {
  name: 'HelloWorld',
  components: {
    SalesSlider,
    ShopSlider,
    MapComponent,
  },
  data() {
    return {
      sales: [],
      shop:[],
      fetchError: null,
    };
  },
  created() {
    this.fetchSales();
    this.fetchShop();
  },
  methods: {
    async fetchSales() {
      try {
        const response = await fetch('http://localhost:8000/sales');
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        this.sales = data;
      } catch (error) {
        console.error('Erreur:', error);
        this.fetchError = error.message;
      }
    },
  
  async fetchShop() {
      try {
        const response = await fetch('http://localhost:8000/shop');
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        this.shop = data;
      } catch (error) {
        console.error('Erreur:', error);
        this.fetchError = error.message;
      }
    },
  },
};
</script>

<style scoped>
.error-message {
  color: red;
  margin-top: 20px;
}
</style>
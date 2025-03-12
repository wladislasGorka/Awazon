<template>
  <v-app>
    <v-container>
      <v-row justify="center"  class="mt-5">
        <v-col cols="12" md="8">
          <h1 class="beautiful-title">Bienvenue sur AWAZON</h1>
          
           <div class="icons-divider">
            <span v-for="n in 7" :key="n" class="icon-item">
            <v-icon>mdi-star</v-icon>
            <v-icon>mdi-storefront</v-icon>
            <v-icon>mdi-tag</v-icon>
            <v-icon>mdi-cart</v-icon>            </span>
          </div>
        </v-col>
      </v-row>
 
      <SalesSlider :sales="sales" />
      <ShopSlider :shops="shop" />
      <ProductSlider :products="products" />
      <div v-if="fetchError" class="error-message">
        {{ fetchError }}
      </div>
    </v-container>
  </v-app>
</template>

<script>
import SalesSlider from './SalesSlider.vue';
import ShopSlider from './ShopSlider.vue';
import ProductSlider from './ProductSlider.vue';

export default {
  name: 'HelloWorld',
  components: {
    SalesSlider,
    ShopSlider,
    ProductSlider,
    
  },
  data() {
    return {
      sales: [],
      shop: [],
      products: [],
      fetchError: null,
    };
  },
  mounted() {
  this.fetchSales();
  this.fetchShop();
  this.fetchProduct();
},

  methods: {
  
  fetchSales() {
    fetch('http://localhost:8000/sales')
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        this.sales = data;
        console.log('Sales data fetched successfully:', this.sales);
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des ventes:', error);
        this.fetchError = error.message;
      });
  },

  fetchShop() {
    fetch('http://localhost:8000/shop')
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        this.shop = data;
        console.log('Shop data fetched successfully:', this.shop);
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des magasins:', error);
        this.fetchError = error.message;
      });
     },
     fetchProduct() {
    fetch('http://localhost:8000/product')
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        this.products = data;
        console.log('Product data fetched successfully:', this.products);
        console.log(data);
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des produits:', error);
        this.fetchError = error.message;
      });
}

 
    }
    
  }

</script>

<style scoped>
.error-message {
  color: red;
  margin-top: 20px;
}

.beautiful-title {
  font-size: 4rem; /* Texte grand et visible */
  font-weight: bold; /* Texte gras */
  text-align: center; /* Centré horizontalement */
  background-image: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet);
            background-clip: text;
            color: transparent;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Ombre subtile pour du relief */
  letter-spacing: 1px; /* Espacement des lettres */
  margin: 20px 0; /* Espacement autour */
}
.icons-divider {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px; /* Espacement entre les icônes */
  margin: 20px 0; /* Espacement autour */
}
</style>

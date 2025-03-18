<template>
  <v-app>
    <v-container>
      <v-row justify="center" class="mt-5">
        <v-col cols="12" md="8">
          <h1 class="beautiful-title">
          Awazon
          </h1>

          <h2 class="animated-text">
            <span :key="currentWord" class="fade">{{ currentWord }}</span>
          </h2>
<v-divider class="mb-5"></v-divider>
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
    ProductSlider
  },
  data() {
    return {
      sales: [],
      shop: [],
      products: [],
      fetchError: null,
      words: ['Acheter', 'Vendez', 'Agissez'], // Your rotating words
      currentIndex: 0
    };
  },
  methods: {
    startWordRotation() {
      setInterval(() => {
        this.currentIndex = (this.currentIndex + 1) % this.words.length;
      }, 2000);
    },
  
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
    fetch('http://localhost:8000/products')
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
},

},
      computed: {
        currentWord() {
          return this.words[this.currentIndex];
        }
      },
      mounted() {
        this.fetchSales();
        this.fetchShop();
        this.fetchProduct();

        // Change word every 2 seconds
        this.startWordRotation();
      },

}
</script>

<style scoped>
.error-message {
  color: red;
  margin-top: 20px;
}

.beautiful-title {
  font-size: 4rem;
  font-weight: bold;
  text-align: center;
  background-image: linear-gradient(to right, violet, indigo, blue);
  background-clip: text;
  color: transparent;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
  letter-spacing: 1px;
  margin: 20px 0;
}

.animated-text {
  font-size: 2.5rem;
  font-weight: bold;
  text-align: center;
  color: #8d56d2;
  height: 3rem;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
}

.fade {
  position: absolute;
  opacity: 0;
  animation: fadeInOut 2s infinite;
}

@keyframes fadeInOut {
  0% { opacity: 0; transform: translateY(10px); }
  10% { opacity: 1; transform: translateY(0px); }
  90% { opacity: 1; transform: translateY(0px); }
  100% { opacity: 0; transform: translateY(-10px); }
}

.icons-divider {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
  margin: 20px 0;
}

.v-divider {
  margin-top: 30%;
}
</style>

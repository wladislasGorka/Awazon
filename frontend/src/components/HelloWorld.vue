<template>
  <v-app>
    <v-container>
      <v-row justify="center" class="mt-5">
      </v-row>

      <v-row justify="center" class="mt-5">
        <v-col cols="12" md="8">
          <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""
          />
          <h1 class="beautiful-title">
            Awazon
          </h1>

          <h2 class="animated-text">
            <span :key="currentWord" class="fade">{{ currentWord }}</span>
          </h2>
          <v-divider class="mb-5"></v-divider>
          <v-col cols="12" md="10">
          <div id="map" class="leaflet-map"></div>
        </v-col>
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
import L from 'leaflet';
import SalesSlider from './SalesSlider.vue';
import ShopSlider from './ShopSlider.vue';
import ProductSlider from './ProductSlider.vue';

import 'leaflet/dist/leaflet.js';

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
      words: ['Acheter', 'Vendez', 'Agissez'], 
      currentIndex: 0,
      map: null, 
    };
  },
  methods: {
    
    startWordRotation() {
      setInterval(() => {
        this.currentIndex = (this.currentIndex + 1) % this.words.length;
      }, 2000);
    },

    
    initMap() {
      
      this.map = L.map('map').setView([43.3443, 3.2158], 13);

      
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      }).addTo(this.map);

      
      L.marker([43.3443, 3.2158])
        .addTo(this.map)
        .bindPopup(`<b>Béziers</b><br>La magie d'Awazon commence ici.`)
        .openPopup();
    },
  },
  computed: {
    currentWord() {
      return this.words[this.currentIndex];
    },
  },
  mounted() {
    
    this.initMap();

    
    this.startWordRotation();
  },
};
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
  0% {
    opacity: 0;
    transform: translateY(10px);
  }
  10% {
    opacity: 1;
    transform: translateY(0px);
  }
  90% {
    opacity: 1;
    transform: translateY(0px);
  }
  100% {
    opacity: 0;
    transform: translateY(-10px);
  }
}

.leaflet-map {
  height: 400px;
  width: 100%;
  border: 1px solid #ddd;
  border-radius: 8px;
  margin-top: 20px;
  margin-left: 10%;
}
</style>

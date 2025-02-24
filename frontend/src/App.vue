<!-- src/App.vue -->
<template>
  <v-app>
    <ProductForm @productCreated="fetchProducts"/>
  </v-app>
</template>

<script>
import ProductForm from './components/ProductForm.vue';

export default {
  components: {
    ProductForm
  },
  methods: {
    fetchProducts() {
      // Recharger les produits depuis l'API
    }
  }
};
</script>

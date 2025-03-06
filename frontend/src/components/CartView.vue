<!-- src/components/CartView.vue -->
<template>
  <v-container>
    <v-row>
      <v-col cols="8">
        <h2>Votre Panier</h2>
        <div v-if="cartItems.length">
          <ul>
            <li v-for="item in cartItems" :key="item.id">
              {{ item.product.name }} - {{ item.quantity }} x {{ item.product.price }} €
            </li>
          </ul>
        </div>
        <div v-else>
          <p>Votre panier est vide.</p>
          <RouterLink to="/Products">
            <v-btn color="primary">Voir les produits</v-btn>
          </RouterLink>
        </div>
      </v-col>
      <v-col cols="4">
        <v-card>
          <v-card-title>Total: {{ totalPrice }} €</v-card-title>
          <v-card-actions>
            <RouterLink to="/order">
              <v-btn color="primary" v-if="cartItems.length">Commander</v-btn>
            </RouterLink>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';
import { RouterLink } from 'vue-router';

export default {
  components: {
    RouterLink,
  },
  data() {
    return {
      cartItems: [],
    };
  },
  computed: {
    totalPrice() {
      return this.cartItems.reduce((total, item) => {
        return total + item.product.price * item.quantity;
      }, 0);
    },
  },
  methods: {
    fetchCart() {
      axios.get('http://localhost:8000/api/cart')
        .then(response => {
          this.cartItems = response.data;
        })
        .catch(error => {
          console.error('Error fetching cart:', error);
        });
    }
  },
  created() {
    this.fetchCart();
  },
};
</script>

<style scoped>
/* Add any required styling here */
</style>

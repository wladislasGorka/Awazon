<template>
  <v-container>
    <v-row>
      <v-col cols="8">
        <h2>Votre Panier</h2>
        <div v-if="cartItems.length">
          <ul>
            <li v-for="item in cartItems" :key="item.id">
              {{ item.product.name }} - {{ item.quantity }} x {{ item.product.price }} €
              <v-btn @click="deleteCartItem(item.id)">Supprimer</v-btn>
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
            <RouterLink to="/Order">
              <v-btn color="primary" v-if="cartItems.length">Commander</v-btn>
            </RouterLink>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
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
      fetch(`http://localhost:8000/cart/`+this.$cookies.get('user').id, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          console.log('Cart data fetched:', data); // Debugging statement
          this.cartItems = data;
        })
        .catch(error => {
          console.error('Error fetching cart:', error);
        });
    },
    deleteCartItem(id) {
      fetch(`http://localhost:8000/cart/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        },
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          this.cartItems = this.cartItems.filter(item => item.id !== id);
        })
        .catch(error => {
          console.error('Error deleting cart item:', error);
        });
    }
  },
  created() {
    this.fetchCart();
  },
};
</script>

<style scoped>
</style>

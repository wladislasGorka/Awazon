<template>
  <v-container>
    <v-row>
      <v-col cols="8">
        <h2>Votre Panier</h2>
        <div v-if="cartProduct.length">
          <ul>
            <li v-for="product in cartProduct" :key="product[0].id">
              {{ product.name }} - {{ product[0].quantity }} x {{ product.price }} €
              <v-btn @click="deleteCartproduct(product[0].id)">Supprimer</v-btn>
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
          <v-card-title>Total: {{ totalPrice() }} €</v-card-title>
          <v-card-actions>
            <RouterLink to="/Order">
              <v-btn color="primary" v-if="cartProduct.length">Commander</v-btn>
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
      cartProduct: [],
    };
  },
  computed: {
    
  },
  methods: {

    totalPrice() {
      let totalPrice = 0;
      this.cartProduct.forEach(product => {
       let productPrice = product.price
        totalPrice += productPrice * product[0].quantity;
        console.log(product.price);
      });
      return totalPrice;

    },
    fetchCart() {

      fetch(`http://localhost:8000/cart/`+this.$cookies.get("user").id, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        }
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          console.log('Cart data fetched:', data); 
          this.cartProduct = data;
        })
        .catch(error => {
          console.error('Error fetching cart:', error);
        });
    },
    deleteCartproduct(id) {
      fetch(`http://localhost:8000/cart/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        }
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          this.cartProduct = this.cartProduct.filter(product => product.id !== id);

          this.fetchCart();
        })
        .catch(error => {
          console.error('Error deleting cart product:', error);
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

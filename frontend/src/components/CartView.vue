<template>
  <v-container class="cart-container">
    <v-row>
      <!-- 🛒 CART ITEMS -->
      <v-col cols="8">
        <h2 class="cart-title">Votre Panier</h2>

        <v-card v-if="cartProduct.length" class="cart-card">
          <v-list>
            <v-list-item v-for="product in cartProduct" :key="product.id">
              <v-row align="center">

                <v-col cols="2">
                  <v-img :src="product.image" alt="Product Image" class="product-image"></v-img>
                </v-col>

                <v-col cols="6">
                  <v-list-item-title class="product-name">{{ product.name }}</v-list-item-title>
                  <v-list-item-subtitle>
                    <strong>{{ product[0].quantity }}</strong> x {{ product.price }} €
                  </v-list-item-subtitle>
                </v-col>

                <v-col cols="4" class="text-right">
                  <v-btn icon @click="deleteCartproduct(product[0].id)" color="red">
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </v-col>
              </v-row>
            </v-list-item>
          </v-list>
        </v-card>

        <div v-else class="empty-cart">
          <p>Votre panier est vide.</p>
          <RouterLink to="/Products">
            <v-btn color="primary">Voir les produits</v-btn>
          </RouterLink>
        </div>
      </v-col>
      <v-col cols="4">
        <v-card class="summary-card">
          <v-card-title class="text-h5">Total: {{ totalPrice() }} €</v-card-title>
          <v-card-actions class="justify-center">
            <RouterLink to="/Order">
              <v-btn color="green" dark v-if="cartProduct.length">
                Commander <v-icon right>mdi-arrow-right</v-icon>
              </v-btn>
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
  methods: {
    totalPrice() {
      return this.cartProduct.reduce((total, product) => {
        return total + product.price * product[0].quantity;
      }, 0);
    },
    fetchCart() {
      fetch(`http://localhost:8000/cart/` + this.$cookies.get("user").id, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
      })
        .then(response => response.json())
        .then(data => { this.cartProduct = data; })
        .catch(error => console.error('Error fetching cart:', error));
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
    },
  },
  created() {
    this.fetchCart();
  },
};
</script>

<style scoped>

.cart-container {
  max-width: 1200px;
  margin: auto;
}


.cart-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}


.cart-card {
  padding: 20px;
  border-radius: 10px;
}


.product-image {
  width: 60px;
  height: 60px;
  border-radius: 8px;
  object-fit: cover;
}


.product-name {
  font-weight: bold;
  font-size: 18px;
}


.summary-card {
  padding: 20px;
  text-align: center;
  background: #f5f5f5;
  border-radius: 10px;
}


.empty-cart {
  text-align: center;
  margin-top: 20px;
}
</style>

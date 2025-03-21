<template>
    <v-container class="product-container">
      <v-row justify="center">
        <v-col cols="12" md="8">
          <v-card class="mx-auto product-card">
            <v-card-title class="headline text-center">
              {{ product.name }}
              <v-icon class="fav-icon" @click="addFavorite()">mdi-heart</v-icon>
            </v-card-title>
  
            <v-card-subtitle class="text-center">{{ product.description }}</v-card-subtitle>
  
            <v-divider class="my-3"></v-divider>
  
            <v-card-text>
              <v-list dense>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>
                      <strong>💸 Prix:</strong> {{ product.price }}€
                    </v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
              <v-row justify="center" class="button-group">
                <v-btn class="cute-btn" @click="addToCart()" color="purple darken-2">
                  🛒 Ajouter au Panier
                </v-btn>
                <v-btn class="cute-btn buy-btn" @click="buy()" color="purple lighten-1">
                  🚀 Acheter Maintenant
                </v-btn>
              </v-row>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-snackbar v-model="snackbar" timeout="2000" color="purple darken-3">
        {{ snackbarText }}
      </v-snackbar>
    </v-container>
  </template>
  
  <script>
  export default {
    name: 'ProductDetailView',
    data() {
      return {
        product: {},
        snackbar: false,
        snackbarText: '', 
      };
    },
    methods: {
      addFavorite() {
        this.snackbarText = "💜 Ajouté aux favoris !";
        this.snackbar = true;
      },
  
      addToCart() {
        fetch('http://localhost:8000/cart', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            productId: this.product.id,
            memberId: this.$cookies.get('user').id,
            quantity: 1,
            price: this.product.price
          })
        })
        .then(response => {
          if (!response.ok) throw new Error('Network response was not ok');
          return response.json();
        })
        .then(data => {
          console.log('Product added to cart:', data);
          this.snackbarText = "🛒 Produit ajouté au panier !";
          this.snackbar = true;
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      },
  
      buy() {
        this.addToCart();
        setTimeout(() => {
          this.$router.push(`/Cart`);
        }, 1500);
      }
    },
    
    mounted() {
      fetch(`http://localhost:8000/products/${this.$route.params.id}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        }
      })
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
      })
      .then(data => {
        this.product = data;
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    }
  };
  </script>
  
  <style scoped>
  .product-container {
    max-width: 800px;
    margin: auto;
  }
  
  .product-card {
    border-radius: 15px;
    background-color: #f3e5f5; /* Soft lavender */
    box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
  }
  

  .cute-btn {
    margin: 5px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 20px;
    padding: 10px 20px;
    transition: all 0.3s ease;
    color: white !important;
  }
  
  .cute-btn:hover {
    transform: scale(1.05);
  }
  

  .buy-btn {
    background-color: #7e57c2 !important;
  }
  

  .fav-icon {
    float: right;
    font-size: 26px;
    cursor: pointer;
    color: #7b1fa2;
    transition: transform 0.2s ease-in-out;
  }
  
  .fav-icon:hover {
    transform: scale(1.2);
    color: #4a148c;
  }
  
  .v-snackbar {
    font-size: 18px;
    font-weight: bold;
    text-align: center;
  }
  </style>
  
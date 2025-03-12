<template>
    <v-container>
      <v-row justify="center">
        <v-col cols="12" md="8">
          <v-card class="mx-auto">
            <v-card-title class="headline">{{ product.name }}</v-card-title>
            <v-card-subtitle class="mb-2">{{ product.description }}</v-card-subtitle>
            <v-card-text>
              <v-divider class="my-3"></v-divider>
              <v-list dense>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title><strong>Prix:</strong> {{ product.price }}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-card-text>
                <v-btn @click="addFavorite()" color="primary">+Fav</v-btn>
                <v-btn @click="addToCart()" color="primary">+Panier</v-btn>
                <v-btn @click="buy()" color="primary">+Commander</v-btn>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
</template>

<script>
export default {
    name: 'ProductDetailView',
    data() {
        return {
            product: {}
        };
    },
    methods: {
        addFavorite() {
            /* fetch('http://localhost:8000/api/favorite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    productId: this.product.id,
                    memberId: this.$cookies.get('user').id
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Product added to favorites:', data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            }); */
        },
        // method to add a product to the cart
        addToCart() {
            fetch('http://localhost:8000/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                   
                },
                body: JSON.stringify({
                    productId: this.product.id,
                    memberId: this.$cookies.get('user').id,
                    quantity: 1,
                    addTime: new Date().toISOString(),
                    price: this.product.price
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Product added to cart:', data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        },
        buy() {
            this.addToCart();
            this.$router.push(`/Cart`);
        }
    },
    mounted() {
        fetch('http://localhost:8000/products/' + this.$route.params.id, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
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

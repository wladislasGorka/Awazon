<template>
    <v-container>
      <v-row justify="center">
        <v-col cols="12" md="8">
          <v-card class="mx-auto" max-width="600">
            <v-img :src="shop.logo" alt="Shop Logo" height="200px"></v-img>
            <v-card-title class="headline">{{ shop.name }}</v-card-title>
            <v-card-subtitle class="mb-2">{{ shop.type }}</v-card-subtitle>
            <v-card-text>
              <v-divider class="my-3"></v-divider>
              <v-list dense>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title><strong>Address:</strong> {{ shop.address }}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title><strong>Phone:</strong> {{ shop.phone }}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-card-text>
                <v-btn @click="addFavorite()" color="primary">+Fav</v-btn>
                <v-btn @click="addCart()" color="primary">+Panier</v-btn>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>

<script>
    export default{
        name: 'ShopDetailView',
        data() {
            return {
                shop: {}
            }
        },
        methods: {
            addFavorite() {
                // fetch('http://localhost:8000/member/addFav', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json'
                //     },
                //     body: JSON.stringify({
                //         shop: this.shop.id
                //         // user: this.$store.state.user.id
                //     })
                // })
                // .then(response => {
                //     if (!response.ok) {
                //         throw new Error('Network response was not ok');
                //     }
                //     return response.json();
                // })
                // .catch(error => {
                //     console.error('There was a problem with the fetch operation:', error);
                // });
            },
            addCart() {
                console.log('Add to cart');
            }
        },
        mounted() {
            fetch('http://localhost:8000/shops/' + this.$route.params.id, {
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
                this.shop = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }
    }
</script>
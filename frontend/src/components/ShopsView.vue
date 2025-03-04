<template>
    <v-container>    
      <v-row class="text-center">  
        <v-col cols="2" class="mb-4">
          <h1 class="display-2 font-weight-bold mb-3">
            Menu
          </h1>
        </v-col>

        <v-col cols="10" class="mb-4">
          <v-container class="d-flex justify-start flex-wrap mb-6 bg-surface-variant">
            <ShopsCardView class="ma-2" v-for="shop in shops" :key="shop.id" :shop="shop" />
          </v-container>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script>
  import ShopsCardView from './ShopsCardView.vue';

  export default {
    name: 'ShopsPage',
    components: {
      ShopsCardView
    },
    data() {
      return {
        shops: []
      };
    },
    mounted() {
      fetch('http://localhost:8000/shops', {
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
        this.shops = data;
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    }
  }

  </script>
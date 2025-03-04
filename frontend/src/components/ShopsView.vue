<template>
  <v-container>    
    <v-row class="text-center">  
      <v-col cols="2" class="mb-4">
        <v-container class="d-flex mb-6 bg-surface-variant">
          <v-select
            v-model= "selectedType"
            :items="shopTypes"
            label="Type de boutique"
            clearable
            density="compact"
            variant="outlined"
          ></v-select>
        </v-container>
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
        shops: [],
        shopTypes: [],
        selectedType: undefined
      };
    },
    watch: {
      selectedType(value) {
        if(value==null){
          // Pas de type sélectionné
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
        }else{
          // Type sélectionné
          fetch('http://localhost:8000/shops/' + value, {
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
      },
    },
    mounted() {
      // Récupérer les données des shops
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

      // Récupérer les types de shops
      fetch('http://localhost:8000/shops-types', {
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
        this.shopTypes = data;
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    }
  }

</script>
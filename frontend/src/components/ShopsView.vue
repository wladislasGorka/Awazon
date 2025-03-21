<template>   
    <v-row v-if="loading">
      <v-col class="text-center">
        <v-progress-circular indeterminate color="primary"></v-progress-circular>
      </v-col>
    </v-row>
    <v-row class="text-center">  
      <v-col cols="2" class="mb-4">
        <v-container class="mb-6 bg-surface-variant">
          <v-select
            v-model= "selectedType"
            :items="shopTypes"
            label="Type de boutique"
            clearable
            density="compact"
            variant="outlined"
          ></v-select>

          <v-select
            v-model= "selectedCategory"
            :items="shopCategory"
            label="Categorie"
            clearable
            density="compact"
            variant="outlined"
          ></v-select>
        </v-container>
      </v-col>

      <v-col cols="10" class="mb-4">        
        <v-container v-if="shops.length>0" class="d-flex justify-start flex-wrap mb-6 bg-surface-variant">      
          <ShopsCardView class="ma-2" v-for="shop in shops" :key="shop.id" :shop="shop" />
        </v-container>
        <v-container v-else class="d-flex justify-start flex-wrap mb-6 bg-surface-variant">
          <v-row>
            <v-col cols="12">
              <h1 class="display-2 text-subtitle-2 mb-3">
                Aucun résultat ne correspond à votre recherche.
              </h1>
            </v-col>
          </v-row>
        </v-container>
      </v-col>
    </v-row>
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
        shopCategory: [],
        selectedType: null,
        selectedCategory: null
      };
    },
    // Repère les changements dans les filres
    watch: {
      selectedType() {
        this.shopsList();
      },
      selectedCategory() {
        this.shopsList();
      }
    },
    methods: {
      // Récupérer les données des shops selon les filtres
      shopsList() {
        let url = 'http://localhost:8000/shops'
                  + '?type=' + this.selectedType 
                  + '&category=' + this.selectedCategory;
        console.log(url);
        fetch('http://localhost:8000/shops?type=' + this.selectedType + '&category=' + this.selectedCategory, {
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
    mounted() {
      // Récupère les données des shops
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
        console.error('There was a problem with the fetch operation (all):', error);
      });

      // Récupère les types de shops
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
        console.error('There was a problem with the fetch operation (type):', error);
      });

      // Récupère les catégories de shops
      fetch('http://localhost:8000/shops-categories', {
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
        this.shopCategory = data;
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation (category):', error);
      });
    }
  }

</script>
<template>
  <v-row class="text-center">  
    <v-col cols="2" class="mb-4">
      <v-container class="mb-6 bg-surface-variant">
        <v-select
          v-model= "selectedCategory"
          :items="productCategory"
          label="Catégorie"
          clearable
          density="compact"
          variant="outlined"
        ></v-select>

        <v-select
          v-model= "selectedSubCategory"
          :items="productSubCategory"
          label="Sous-catégorie"
          clearable
          density="compact"
          variant="outlined"
        ></v-select>
      </v-container>
    </v-col>

    <v-col cols="10" class="mb-4">
      <v-container v-if="products.length>0" class="d-flex justify-start flex-wrap mb-6 bg-surface-variant">      
        <ProductsCardView class="ma-2" v-for="product in products" :key="product.id" :product="product" />
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
import ProductsCardView from './ProductsCardView.vue';

  export default {
    name: 'ProductsPage',
    components: {
      ProductsCardView
    },
    data() {
      return {
        products: [],
        productCategories: [],
        productSubCategories: [],
        productCategory: [],
        productSubCategory: [],
        selectedCategory: null,
        selectedSubCategory: null
      };
    },
    // Repère les changements dans les filres
    watch: {
      selectedCategory() {
        this.selectedSubCategory = null;
        this.setProductSubCategory(this.selectedCategory);
        this.productsList();
      },
      selectedSubCategory() {
        this.productsList();
      }
    },
    methods: {
      // Récupérer les données des shops selon les filtres
      productsList() {
        let url = 'http://localhost:8000/products'
                  + '?category=' + this.selectedCategory 
                  + '&sub-category=' + this.selectedSubCategory;
        console.log(url);
        fetch(url, {
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
          this.products = data;
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation (filtered):', error);
        });
      },
      setProductCategory(){
        this.productCategory = Object.keys(this.productCategories);
      },
      setProductSubCategory(category){
        this.productSubCategory = this.productCategories[category] || this.productSubCategories;
      }
    },
    mounted() {
      // Récupère les données des produits
      fetch('http://localhost:8000/products', {
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
        this.products = data;
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation (all):', error);
      });

      // // Récupère les catégories des produits
      // fetch('http://localhost:8000/products/category', {
      //   method: 'GET',
      //   headers: {
      //     'Content-Type': 'application/json'
      //   }
      // })
      // .then(response => {
      //   if (!response.ok) {
      //     throw new Error('Network response was not ok');
      //   }
      //   return response.json();
      // })
      // .then(data => {
      //   this.productCategory = data;
      // })
      // .catch(error => {
      //   console.error('There was a problem with the fetch operation (type):', error);
      // });

      // Récupère les sous-catégories des produits
      fetch('http://localhost:8000/products/sub-category', {
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
        this.productSubCategories = data;
        this.setProductSubCategory();
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation (type):', error);
      });

      // Récupère les sous-catégories des produits
      fetch('http://localhost:8000/products/category/smart', {
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
        this.productCategories = JSON.parse(data);
        this.setProductCategory();
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation (type):', error);
      });
    },
  }
</script>
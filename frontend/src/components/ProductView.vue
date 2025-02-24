<!-- src/components/ProductView.vue -->
<template>
    <v-form @submit.prevent="submitForm">
      <v-text-field v-model="name" label="Nom" required></v-text-field>
      <v-text-field v-model="desc" label="Description" type="text" required></v-text-field>
      <v-text-field v-model="price" label="Prix" type="number" required></v-text-field>
      <v-btn type="submit" color="primary">Add Product</v-btn>
    </v-form>
  </template>
  
  <script>

  export default {
    data() {
      return {
        name: '',
        desc: '',
        price: ''
      };
    },
    methods: {
      submitForm() {
        const productData = {
          name: this.name,
          desc: this.desc,
          price: this.price
        };
  
        fetch('http://localhost:8000/product', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(productData)
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          console.log('Product created successfully:', data);
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      }
    }
  };
  </script>
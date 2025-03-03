<!-- src/components/RegisterMerchantView.vue -->
<template>
    <v-form @submit.prevent="submitForm">
      <v-text-field v-model="name" label="Nom" required></v-text-field>
      <v-text-field v-model="email" label="Email" type="email" required></v-text-field>
      <v-text-field v-model="siret" label="Siret" type="number" required></v-text-field>
      <v-text-field v-model="password" label="Mot de passe" type="password" required></v-text-field>
      <v-btn type="submit" color="primary">Enregistrer en tant que Marchand</v-btn>
    </v-form>
  </template>
  
  <script>

  export default {
    data() {
      return {
        name: '',
        email: '',
        siret: '',
        password: ''
      };
    },
    methods: {
      submitForm() {
        const userData = {
          name: this.name,
          email: this.email,
          siret: this.siret,
          password: this.password
        };
  
        fetch('http://localhost:8000/register/merchant', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(userData)
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          console.log('Merchant created successfully:', data);
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      }
    }
  };
  </script>
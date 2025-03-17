<!-- src/components/RegisterMerchantView.vue -->
<template>
  <v-container class="register-container">
    <v-form @submit.prevent="submitForm" class="register-form">
      <v-row>
        <v-col col="12" md="6">
          <h2 class="form-heading">Identité personnelle</h2>
          <v-text-field v-model="name" label="Nom" required class="mb-4"></v-text-field>
          <v-text-field v-model="firstName" label="Prénom" required class="mb-4"></v-text-field>
          <v-text-field v-model="email" label="Email" type="email" required class="mb-4"></v-text-field>
          <v-text-field v-model="phone" label="Téléphone" type="number" required class="mb-4"></v-text-field>
          <v-text-field v-model="address" label="Adresse" type="text" required class="mb-4"></v-text-field>
          <v-text-field v-model="password" label="Mot de passe" type="password" required class="mb-4"></v-text-field>
        </v-col>
        <v-col col="12" md="6">
          <h2 class="form-heading">Identité de la boutique</h2>
          <v-text-field v-model="nameShop" label="Nom de la boutique" type="text" required class="mb-4"></v-text-field>
          <v-text-field v-model="addressShop" label="Adresse de la boutique" type="text" required class="mb-4"></v-text-field>
          <v-text-field v-model="siret" label="Siret" type="number" required class="mb-4"></v-text-field>
        </v-col>
      </v-row>  
      
      <v-btn type="submit" color="primary">Devenir Vendeur</v-btn>
    </v-form>
    </v-container>
  
    
  </template>
  
  <script>

  export default {
    data() {
      return {
        name: '',
        firstName: '',
        email: '',
        phone: '',
        address: '',
        password: '',
        nameShop: '',
        addressShop: '',
        siret: ''
      };
    },
    methods: {
      submitForm() {
        const userData = {
          name: this.name,
          firstName: this.firstName,
          email: this.email,
          phone: this.phone,
          address: this.address,
          password: this.password,
          nameShop: this.nameShop,
          addressShop: this.addressShop,
          siret: this.siret
        };
  
        fetch('http://localhost:8000/merchant/registration', {
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
          this.$router.push({ path: '/login' });
          return response.json();
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      }
    }
  };
  </script>
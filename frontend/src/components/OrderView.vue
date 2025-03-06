<!-- src/components/OrderView.vue -->
<template>
    <v-container>
      <v-stepper v-model="step">
        <v-stepper-header>
          <v-stepper-step :complete="step > 1" step="1">Adresse de Facturation</v-stepper-step>
          <v-stepper-step :complete="step > 2" step="2">Expédition</v-stepper-step>
          <v-stepper-step :complete="step > 3" step="3">Paiement</v-stepper-step>
        </v-stepper-header>
  
        <v-stepper-items>
          <v-stepper-content step="1">
            <v-text-field v-model="billingAddress" label="Adresse de Facturation" required></v-text-field>
            <v-btn color="primary" @click="nextStep">Suivant</v-btn>
          </v-stepper-content>
  
          <v-stepper-content step="2">
            <v-text-field v-model="shippingAddress" label="Adresse de Livraison" required></v-text-field>
            <v-btn color="primary" @click="nextStep">Suivant</v-btn>
          </v-stepper-content>
  
          <v-stepper-content step="3">
            <v-text-field v-model="paymentInfo" label="Informations de Paiement" required></v-text-field>
            <v-btn color="primary" @click="placeOrder">Placer la Commande</v-btn>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </v-container>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        step: 1,
        billingAddress: '',
        shippingAddress: '',
        paymentInfo: '',
      };
    },
    methods: {
      nextStep() {
        this.step++;
      },
      placeOrder() {
        const orderData = {
          address_bill: this.billingAddress,
          shipping_address: this.shippingAddress,
          payment_info: this.paymentInfo,
          cartId: this.cartId, // Assuming you have a cartId available
          // Add other required order data
        };
  
        axios.post('http://localhost:8000/api/orders', orderData)
          .then(response => {
            console.log('Order placed:', response.data);
            // Handle order placement success, e.g., navigate to order confirmation page
          })
          .catch(error => {
            console.error('Error placing order:', error);
          });
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add any required styling here */
  </style>
  
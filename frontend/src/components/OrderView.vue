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
  export default {
    data() {
      return {
        step: 1,
        billingAddress: '',
        shippingAddress: '',
        paymentInfo: '',
        cartId: '',
        productsId: []
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
          //cartId: this.cartId, // Ajouter d'autres données de commande nécessaires
          userId: this.$cookies.get('user').id,
          productsId: this.productsId,
        };
  
        fetch('http://localhost:8000/order/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(orderData),
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          console.log('Order placed:', data);
          // manage the succes of the order
        })
        .catch(error => {
          console.error('Error placing order:', error);
        });
      }
    },
  };
  </script>
  
  <style scoped>
  </style>
  
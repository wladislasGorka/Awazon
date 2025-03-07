<template>
    <v-app-bar app>
      <RouterLink to="/Events"> <v-btn>Evenements</v-btn></RouterLink> |
      <RouterLink to="/Forum"> <v-btn>Forum</v-btn></RouterLink> |
      <RouterLink to="/Shops"> <v-btn>Commerces</v-btn></RouterLink> |
      <RouterLink to="/Products"> <v-btn>Produits</v-btn></RouterLink> |
      <RouterLink to="/Contact"> <v-btn>Contact</v-btn></RouterLink> 
      <v-spacer></v-spacer>
      <RouterLink to="/Cart"> <v-btn>Panier</v-btn></RouterLink>
      
      <v-btn>Langue</v-btn>
      <v-btn>Theme</v-btn>
    </v-app-bar>
  </template>
  
  <script>
  import { RouterLink } from 'vue-router';
  
  export default {
    name: 'SubNavBar',
    components: {
      RouterLink,
    }
  };
  </script>
  
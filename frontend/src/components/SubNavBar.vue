<!-- src/components/SubNavbar.vue -->
<template>
    <v-app-bar app>
      <RouterLink to="/Events"> <v-btn>Evenements | </v-btn></RouterLink>
      <RouterLink to="/Forum"> <v-btn v-if="isLoggedIn">Forum | </v-btn></RouterLink>
      <RouterLink to="/Shops"> <v-btn>Commerces | </v-btn></RouterLink>
      <RouterLink to="/Products"> <v-btn>Produits | </v-btn></RouterLink>
      <RouterLink to="/Dashboard"> <v-btn v-if="isLoggedIn">Dashboard | </v-btn></RouterLink>
      <RouterLink to="/Contact"> <v-btn>Contact</v-btn></RouterLink> 
      <v-spacer></v-spacer>
      <v-btn>Panier</v-btn>
      <v-btn>Langue</v-btn>
      <v-btn>Theme</v-btn>
    </v-app-bar>
</template>

<script>
    import { RouterLink } from 'vue-router';
    import { mapGetters } from 'vuex';

    export default {
        name: 'SubNavBar',
        components: {
            RouterLink,
        },
        computed: {
            ...mapGetters(['isLoggedIn']),
        },
    };
</script>
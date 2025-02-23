<!-- src/components/Navbar.vue -->
<template>
    <v-app-bar app>
      <RouterLink to="/"> <v-toolbar-title>My Navbar</v-toolbar-title></RouterLink>
      <v-spacer></v-spacer>
      <RouterLink to="/Login"> <v-btn>Connexion</v-btn></RouterLink> |
      <RouterLink to="/RegisterMember"> <v-btn>Inscription</v-btn></RouterLink> |
      <RouterLink to="/RegisterMerchant"> <v-btn>Vendez sur Awazon</v-btn></RouterLink> |
      <RouterLink to="/Logout"> <v-btn>Deconnexion</v-btn></RouterLink>
    </v-app-bar>
</template>

<script>
    import { RouterLink } from 'vue-router';

    export default {
    name: 'Nav-bar',
    components: {
        RouterLink,
    },
    }
</script>
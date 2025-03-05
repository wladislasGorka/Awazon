<!-- src/components/Navbar.vue -->
<template>
    <v-app-bar app>
        <RouterLink to="/"> <v-toolbar-title>My Navbar</v-toolbar-title></RouterLink>
        <v-spacer></v-spacer>
        <RouterLink to="/Login"> <v-btn>Connexion</v-btn></RouterLink> |
        <RouterLink to="/RegisterMember"> <v-btn>Inscription</v-btn></RouterLink> |
        <RouterLink to="/RegisterMerchant"> <v-btn>Vendez sur Awazon</v-btn></RouterLink> |
        <v-btn @click="logout">Deconnexion</v-btn>
    </v-app-bar>
</template>

<script>
    import { RouterLink } from 'vue-router';

    export default {
        name: 'Nav-bar',
        components: {
            RouterLink,
        },
        methods: {
            logout() {
                this.$cookies.remove('token');
                this.$router.push('/');
            }
        }
    }
</script>
<!-- src/components/Navbar.vue -->
<template>
    <v-app-bar app>
        <RouterLink to="/"> <v-toolbar-title>Accueil</v-toolbar-title></RouterLink>
        <v-spacer></v-spacer>
        <RouterLink to="/Login"> <v-btn v-if="!isLoggedIn">Connexion | </v-btn></RouterLink> 
        <RouterLink to="/RegisterMember"> <v-btn v-if="!isLoggedIn">Inscription | </v-btn></RouterLink> 
        <RouterLink to="/RegisterMerchant"> <v-btn v-if="!isLoggedIn">Vendez sur Awazon | </v-btn></RouterLink>
        <v-btn v-if="isLoggedIn" @click="logout()"> Deconnexion</v-btn>
    </v-app-bar>
</template>

<script>
    import { RouterLink } from 'vue-router';
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: 'Nav-bar',
        components: {
            RouterLink,
        },
        computed: {
            ...mapGetters(['isLoggedIn']),
        },
        methods: {
            logout() {
                this.$cookies.remove('token');
                this.$cookies.remove('user');
                this.toggleLogin();
                this.$router.push('/');
            },
            ...mapActions(['toggleLogin']),
        }
    }
</script>
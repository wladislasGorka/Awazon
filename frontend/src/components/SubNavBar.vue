<template>
  <v-app-bar app>
    <RouterLink to="/Events"> <v-btn>Evenements | </v-btn></RouterLink>
    <RouterLink to="/Forum"> <v-btn v-if="isLoggedIn">Forum | </v-btn></RouterLink>
    <RouterLink to="/Shops"> <v-btn>Commerces | </v-btn></RouterLink>
    <RouterLink to="/Products"> <v-btn>Produits | </v-btn></RouterLink>
    <RouterLink to="/Dashboard"> <v-btn v-if="isLoggedIn && this.$cookies.get('user').roles['ROLE_MERCHANT']" >Dashboard | </v-btn></RouterLink>
    <RouterLink to="/Contact"> <v-btn>Contact</v-btn></RouterLink> 
    <v-spacer></v-spacer>
    <RouterLink to="/Cart"> <v-btn v-if="isLoggedIn">Panier</v-btn></RouterLink>
    
    <v-btn>Langue</v-btn>
    <v-switch @click="toggleTheme"></v-switch>
  </v-app-bar>
</template>

<script>
import { RouterLink } from 'vue-router';
import { mapGetters } from 'vuex';
import { useTheme } from 'vuetify';

export default {
  name: 'SubNavBar',
  components: {
    RouterLink,
  },
  computed: {
    ...mapGetters(['isLoggedIn']),
  },
  setup() {
    const theme = useTheme();

    const toggleTheme = () => {
      theme.global.name.value = theme.global.name.value === 'lightTheme' ? 'darkTheme' : 'lightTheme';
    };

    return {
      toggleTheme,
    };
  },
};
</script>

<style scoped>

</style>

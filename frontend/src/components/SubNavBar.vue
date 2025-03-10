<template>
  <v-app-bar app elevation="2" :color="$vuetify.theme.dark ? 'purple darken-3' : 'purple lighten-4'" dark>
      <v-container class="d-flex align-center">
          <RouterLink to="/Events" class="subnav-btn">Événements</RouterLink>
          <RouterLink to="/Forum" v-if="isLoggedIn" class="subnav-btn">Forum</RouterLink>
          <RouterLink to="/Shops" class="subnav-btn">Commerces</RouterLink>
          <RouterLink to="/Products" class="subnav-btn">Produits</RouterLink>
          <RouterLink to="/Dashboard" v-if="isLoggedIn && this.$cookies.get('user').roles['ROLE_MEMBER']" class="subnav-btn">Dashboard</RouterLink>
          <RouterLink to="/Contact" class="subnav-btn">Contact</RouterLink>
          
          <v-spacer></v-spacer>
          
          <RouterLink to="/Cart" v-if="isLoggedIn" class="subnav-btn">Panier</RouterLink>
          <v-btn class="subnav-btn">Langue</v-btn>
          <v-switch class="theme-toggle" @click="toggleTheme"></v-switch>
      </v-container>
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
.subnav-btn {
  position: relative;
  text-decoration: none;
  color: white;
  font-weight: 500;
  transition: color 0.3s, transform 0.3s;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  background: linear-gradient(45deg, #fcdbb5, #efa4ef);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.subnav-btn::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: -2px;
  width: 0;
  height: 2px;
  background-color: #fcdbb5;
  transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
}

.subnav-btn:hover::after {
  width: 100%;
  left: 0;
}

.subnav-btn:hover {
  transform: scale(1.1);
  box-shadow: 0 0 8px #fcdbb5(255, 204, 0, 0.7);
}

.theme-toggle {
  align-self: center;
  margin-left: 1rem;
  transition: transform 0.3s ease-in-out;
}

.theme-toggle:hover {
  transform: rotate(10deg);
}
</style>

<template>
  <v-app-bar app elevation="4" :color="$vuetify.theme.dark ? 'deep-purple darken-3' : 'deep-purple lighten-1'" dark>
    <v-container class="d-flex align-center">
      <RouterLink to="/" class="nav-title">
        <v-img src="/images/logoAwazon.png" width="200" height="100"/>
      </RouterLink>

      <v-spacer></v-spacer>

      <v-text-field
        class="search-bar"
        dense
        outlined
        hide-details
        placeholder="Search..."
        prepend-inner-icon="mdi-magnify"
        color="white"
        min-width="100"
      ></v-text-field>

      <v-spacer></v-spacer>

      <div class="nav-links">
        <RouterLink to="/Login" v-if="!isLoggedIn" class="nav-btn">
          <v-btn text>Connexion</v-btn>
        </RouterLink>
        <RouterLink to="/RegisterMember" v-if="!isLoggedIn" class="nav-btn">
          <v-btn text>Inscription</v-btn>
        </RouterLink>
        <RouterLink to="/RegisterMerchant" v-if="!isLoggedIn" class="nav-btn">
          <v-btn text>Vendez sur Awazon</v-btn>
        </RouterLink>
        <v-btn v-if="isLoggedIn" class="logout-btn" @click="logout">Déconnexion</v-btn>
      </div>
    </v-container>
  </v-app-bar>
</template>

<script>
import { RouterLink } from 'vue-router';
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'Nav-bar',
  components: { RouterLink },
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
};
</script>

<style scoped>
.nav-title {
  font-size: 1.5rem;
  font-weight: bold;
  text-decoration: none;
  color: white;
  transition: opacity 0.3s;
}

.nav-title:hover {
  opacity: 0.8;
}

.search-bar {
  max-width: 300px;
  background-color: rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  padding: 4px;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.nav-btn {
  text-decoration: none;
  color: white;
  font-weight: 500;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  transition: color 0.3s, transform 0.3s, background 0.3s, text-decoration 0.3s;
  position: relative;
}

.nav-btn .v-btn {
  position: relative;
}

.nav-btn .v-btn::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(45deg, #ff5733, #c70039);
  transition: width 0.3s;
}

.nav-btn:hover .v-btn {
  color: #ffcc00;
}

.nav-btn:hover .v-btn::after {
  width: 100%;
}

.logout-btn {
  background: linear-gradient(45deg, #ff5733, #c70039);
  color: white;
  transition: box-shadow 0.3s;
}

.logout-btn:hover {
  box-shadow: 0 4px 15px rgba(255, 87, 51, 0.5);
}
</style>

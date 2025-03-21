<template>
  <v-app-bar app elevation="4" :color="$vuetify.theme.dark ? 'deep-purple darken-3' : 'deep-purple lighten-1'" dark>
    <v-container class="d-flex align-center">
      <RouterLink to="/" class="nav-title">
        <v-img src="/images/logoAwazon.png" width="200" height="100"/>
      </RouterLink>

      <v-spacer></v-spacer>

     
      <v-autocomplete
        v-model="searchQuery"
        :items="searchResults"
        label="Rechercher un produit..."
        item-text="name"
        item-value="id"
        return-object
        variant="outlined"
        hide-details
        dense
        color="white"
        min-width="300"
        @input="searchItems"
        prepend-inner-icon="mdi-magnify"
        placeholder="Search..."
      ></v-autocomplete>

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

  <v-menu v-if="searchResults.length > 0" bottom left>
    <v-list>
      <v-list-item-group v-if="searchResults.length">
        <v-list-item
          v-for="result in searchResults"
          :key="result.id"
          @click="goToResult(result)"
        >
          <v-list-item-content>
            <v-list-item-title>{{ result.name }}</v-list-item-title>
            <v-list-item-subtitle>{{ result.type }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-menu>

  <v-snackbar v-model="errorMessageVisible" color="red" timeout="3000">
    {{ errorMessage }}
  </v-snackbar>
</template>

<script>
import { RouterLink } from 'vue-router';
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'Nav-bar',
  components: { RouterLink },
  data() {
    return {
      searchQuery: null,
      searchResults: [],
      debounceTimeout: null,
      errorMessageVisible: false,
      errorMessage: '',
    };
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

    searchProducts() {
      if (this.debounceTimeout) {
        clearTimeout(this.debounceTimeout);
      }

      this.debounceTimeout = setTimeout(() => {
        if (!this.searchQuery || this.searchQuery.trim() === '') {
          this.searchResults = [];
          return;
        }

        fetch(`http://localhost:8000/products/search?q=${this.searchQuery}`)
          .then((response) => response.json())
          .then((data) => {
            if (data.length === 0) {
              this.errorMessage = 'No results found';
              this.errorMessageVisible = true;
              this.searchResults = [];
            } else {
              this.searchResults = data;
            }
          })
          .catch((error) => {
            console.error('Error fetching search results:', error);
            this.errorMessage = 'An error occurred while fetching results';
            this.errorMessageVisible = true;
          });
      }, 500);
    },
    goToResult(result) {
      if (result.type === 'product') {
        this.$router.push(`/product/${result.id}`);
      } 
    },
    ...mapActions(['toggleLogin']),
  },
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
}

.logout-btn {
  background: linear-gradient(45deg, #ff5733, #c70039);
  color: white;
  transition: box-shadow 0.3s;
}

.logout-btn:hover {
  box-shadow: 0 4px 15px rgba(255, 87, 51, 0.5);
}

@media (max-width: 600px) {
  .v-app-bar {
    padding: 0 16px;
  }
  .nav-links {
    display: none;
  }
  .v-app-bar-nav-icon {
    display: block;
  }
}
</style>

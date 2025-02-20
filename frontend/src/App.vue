<template>
  <v-app>
    <v-main>
      <RouterView />
      <Navbar />
    </v-main>
  </v-app>
</template>

<script>
import Navbar from './components/Navbar.vue';
import { getAuth } from 'firebase/auth';

export default {
  name: 'App',
  
  components: {
    Navbar,
  },
  mounted() {
    const auth = getAuth();
    auth.onAuthStateChanged(user => {
      if (user) {
        console.log('User is signed in.');
        this.$router.push("/");
      } else {
        console.log('No user is signed in.');
        this.$router.push("/Login");
      }
    });
  },

  data() {
    return {
      // Any necessary data properties can go here
    };
  },
};
</script>

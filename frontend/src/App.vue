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

export default {
  name: 'App',
  
  components: {
    Navbar,
  },
  mounted() {
    const auth = this.$firebaseAuth;
    auth.onAuthStateChanged(user => {
      if (user) {
        console.log('User is signed in:', user);
      } else {
        console.log('No user is signed in.');
      }
    });
  },

  data: () => ({
    //
  }),
}
</script>

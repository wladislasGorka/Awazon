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
import { getAuth } from "firebase/auth";
import { useRouter } from 'vue-router';

export default {
  name: 'App',
  
  components: {
    Navbar,
  },
  mounted() {
    const router = useRouter();
    const auth = getAuth();
    auth.onAuthStateChanged(user => {
      if (user) {
        console.log('User is signed in.');
        router.push("/");
      } else {
        console.log('No user is signed in.');
        router.push("/Login")
      }
    });
  },

  data: () => ({
    //
  }),
}
</script>

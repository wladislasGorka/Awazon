<!-- src/App.vue -->
<template>
  <v-app>
    <v-main>
      <RouterView />
      <Navbar />
      <SubNavBar />
    </v-main>
    <FooterPage />
  </v-app>
</template>

<script>
import Navbar from './components/Navbar.vue';
import SubNavBar from './components/SubNavBar.vue';
import FooterPage from './components/FooterView.vue';
import { getAuth } from "firebase/auth";
import { RouterView, useRouter } from 'vue-router';

export default {
  components: {
    Navbar,
    SubNavBar,
    RouterView,
    FooterPage
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

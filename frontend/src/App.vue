<template>
  <v-app class="mx-0">
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
import { RouterView } from 'vue-router';

export default {
  name: 'App',
  
  components: {
    Navbar,
    SubNavBar,
    RouterView,
    FooterPage
  },

  data: () => ({
    //
  }),
}
</script>
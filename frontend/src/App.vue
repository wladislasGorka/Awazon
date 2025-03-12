<template>
  <v-app>
    <v-main>
      <RouterView />
      <Navbar />
      <SubNavBar />
    </v-main>
    <FooterPage />
    <AwaiView />
  </v-app>
</template>

<script>
import Navbar from './components/Navbar.vue';
import SubNavBar from './components/SubNavBar.vue';
import FooterPage from './components/FooterView.vue';
import AwaiView from './components/AwaiView.vue'; 
import { RouterView } from 'vue-router';

export default {
  name: 'App',
  components: {
    Navbar,
    SubNavBar,
    RouterView,
    FooterPage,
    AwaiView
  }
}
</script>

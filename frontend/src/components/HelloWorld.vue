<template>
  <v-app>
    <SubNavBar @toggle-cart="toggleCart" />
    <v-container v-if="!showCart">
      <v-row class="text-center">
        <v-col cols="12">
          <v-img
            :src="require('../assets/logo.svg')"
            class="my-3"
            contain
            height="200"
          />
        </v-col>

        <v-col class="mb-4">
          <h1 class="display-2 font-weight-bold mb-3">
            Welcome to the Vuetify 3 Beta
          </h1>

          <p class="subheading font-weight-regular">
            For help and collaboration with other Vuetify developers,
            <br>please join our online
            <a
              href="https://community.vuetifyjs.com"
              target="_blank"
            >Discord Community</a>
          </p>
        </v-col>
      </v-row>
    </v-container>
    <CartView v-if="showCart" />
  </v-app>
</template>

<script>
import SubNavBar from './SubNavBar.vue';
import CartView from './CartView.vue';

export default {
  name: 'HelloWorld',
  components: {
    SubNavBar,
    CartView,
  },
  data() {
    return {
      showCart: false,
    };
  },
  methods: {
    toggleCart() {
      this.showCart = !this.showCart;
    }
  }
};
</script>

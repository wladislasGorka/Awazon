<template>
  <v-card link width="200" max-height="150" class="mx-auto" @click="goToDetailView()">
    <v-card-title>
        {{ shop.name }}
    </v-card-title>
    <v-img :src="shop.logo" alt="Shop Logo" max-height="200px"></v-img>
    <!-- <v-card-text>
      <p class="display-2 text-subtitle-1 mb-3">
        {{ shop.address }}
      </p>
      <p>
        {{ shop.type }}
      </p>
    </v-card-text> -->
  </v-card>
</template>

<script>
  export default {
    name: 'ShopsCardView',
    props: {
        shop: Object
    },
    methods: {
        goToDetailView() {
            this.$router.push({ path: `/Shops/${this.shop.id}`});
        }
    }
  };
</script>
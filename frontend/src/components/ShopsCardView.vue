<template>
    <v-card link width="200" min-height="200" class="mx-auto" @click="goToDetailView()">
      <v-card-title>        
        <h1 class="display-2 text-subtitle-2 mb-3">
            {{ shop.name }}
        </h1>
      </v-card-title>
      <v-card-text>
        <p class="display-2 text-subtitle-1 mb-3">
          {{ shop.address }}
        </p>
        <p>
          {{ shop.type }}
        </p>
      </v-card-text>
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
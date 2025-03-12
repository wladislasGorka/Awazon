<template>
    <v-card link width="200" min-height="200" class="mx-auto" @click="goToDetailView()">
      <v-card-title>        
        <h1 class="display-2 text-subtitle-2 mb-3">
            {{ product.name }}
        </h1>
      </v-card-title>
      <v-card-text>
        <p class="display-2 text-subtitle-1 mb-3">
          {{ product.description }}
        </p>
        <p>
          {{ product.price }}
        </p>
      </v-card-text>
    </v-card>
</template>

<script>
    export default {
      name: 'ProductsCardView',
      props: {
          product: Object
      },
      methods: {
          goToDetailView() {
              this.$router.push({ path: `/products/${this.product.id}`});
          }
      }
    };
</script>
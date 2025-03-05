<template>
  <v-carousel>
    <v-carousel-item v-for="shop in shops" :key="shop.id">
      <v-card>
        <v-card-title>{{ shop.name }}</v-card-title>
        <v-card-subtitle>{{ shop.address }}</v-card-subtitle>
        <v-card-text>
          <strong>Siret:</strong> {{ shop.siret }}
          <br />
          <strong>Téléphone:</strong> {{ shop.phone }}
          <br />
          <strong>Type:</strong> {{ shop.type }}
        </v-card-text>
        <v-img v-for="image in shop.imagesShop" :key="image.id" :src="`/images/${image.name}`" aspect-ratio="1" cover></v-img>
      </v-card>
    </v-carousel-item>
  </v-carousel>
</template>

<script>
export default {
  name: 'ShopSlider',
  props: {
    shops: {
      type: Array,
      required: true,
    },
  },
};
</script>
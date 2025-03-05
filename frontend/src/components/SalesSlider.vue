<template>
  <v-carousel>
    <v-carousel-item v-for="sale in sales" :key="sale.id">
      <v-card>
        <v-card-title>{{ sale.slogan }}</v-card-title>
        <v-card-subtitle>{{ sale.description }}</v-card-subtitle>
        <v-card-text>
          <strong>{{ sale.pourcent }}% de réduction</strong>
          <br />
          Du {{ sale.date_start }} au {{ sale.date_end }}
        </v-card-text>
        <v-img v-for="image in sale.salesImages" :key="image" :src="`/images/SalesImages/${image}`" aspect-ratio="1" cover></v-img>
      </v-card>
    </v-carousel-item>
  </v-carousel>
</template>

<script>
export default {
  name: 'SalesSlider',
  props: {
    sales: {
      type: Array,
      required: true,
    },
  },
};
</script>
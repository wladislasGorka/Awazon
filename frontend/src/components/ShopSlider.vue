<template>
  <v-app>
    <v-container>
      <!-- Titre Principal -->
      <v-row justify="center"  class="slider-title-row">
        <v-col cols="12" class="text-center">
          <h1 class="slider-title">Shops</h1>
        </v-col>
      </v-row>

      <!-- Carousel -->
      <v-carousel>
        <v-carousel-item v-for="shop in shops" :key="shop.id">
          <div class="slider-card">
            <v-card class="text-center">
              <v-card-title class="title">{{ shop.name }}</v-card-title>
              <v-card-subtitle class="subtitle">{{ shop.address }}</v-card-subtitle>
              <v-card-text>
                <strong>Siret:</strong> {{ shop.siret }}<br />
                <strong>Téléphone:</strong> {{ shop.phone }}<br />
                <strong>Type:</strong> {{ shop.type }}
              </v-card-text>
            </v-card>
          </div>
        </v-carousel-item>
      </v-carousel>
    </v-container>
  </v-app>
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

<style scoped>
/* Titre Principal */
.slider-title-row {
  margin-bottom: 20px; /* Espacement entre le titre et le carousel */
}

.slider-title {
  font-size: 3rem; /* Taille du texte */
  font-weight: bold; /* Texte gras */
  color: #00bfff; /* Bleu clair */
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Légère ombre */
  margin: 0; /* Pas de marge par défaut */
  text-align: center; /* Centré horizontalement */
  font-family: 'Poppins', sans-serif; /* Police élégante */
}

/* Carte dans le Carousel */
.slider-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%; /* Remplit toute la hauteur de l'élément */
  text-align: center; /* Centre le texte horizontalement */
  background: rgba(0, 0, 0, 0.6); /* Fond sombre semi-transparent */
  color: white; /* Contraste avec le texte */
  padding: 20px;
  box-sizing: border-box;
}

.title {
  font-size: 2.5rem; /* Taille de titre importante */
  font-weight: bold; /* Texte en gras */
  margin-bottom: 10px;
}

.subtitle {
  font-size: 1.2rem;
  margin-bottom: 15px;
}
</style>

<template>
  <v-app>
    <v-container>
       <!-- Titre Principal -->
       <v-row justify="center" class="slider-title-row">
        <v-col cols="12" class="text-center">
          <h1 class="slider-title">Promos !!</h1>
        </v-col>
      </v-row>
      <v-carousel>
        <v-carousel-item v-for="sale in sales" :key="sale.id">
          <div class="slider-card">
            <v-card class="text-center">
              <v-card-title class="title">{{ sale.slogan }}</v-card-title>
              <v-card-subtitle class="subtitle">{{ sale.description }}</v-card-subtitle>
              <v-card-text>
                <strong class="discount">{{ sale.pourcent }}% de réduction</strong>
                <br />
                Du {{ sale.date_start }} au {{ sale.date_end }}
              </v-card-text>
              <v-img
                v-for="image in sale.salesImages"
                :key="image"
                :src="`/images/SalesImages/${image}`"
                class="slider-image"
                cover
              ></v-img>
            </v-card>
          </div>
        </v-carousel-item>
      </v-carousel>
    </v-container>
  </v-app>
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

<style scoped>
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
.slider-title {
  font-size: 3rem; /* Taille du texte */
  font-weight: bold; /* Texte gras */
  color: #00bfff; /* Bleu clair */
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Légère ombre */
  margin: 0; /* Pas de marge par défaut */
  text-align: center; /* Centré horizontalement */
  font-family: 'Poppins', sans-serif; /* Police élégante */
}
.discount {
  font-size: 1.5rem;
  color: #ffc107; /* Couleur dorée pour mettre en avant */
  font-weight: bold;
}

.slider-image {
  margin-top: 15px;
  max-width: 80%;
  border-radius: 10px; /* Coins arrondis pour un style élégant */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Ombre subtile sous les images */
}
</style>

<template>
  <v-app>
    <v-container>
      <!-- Titre Principal -->
      <v-row justify="center" class="slider-title-row">
        <v-col cols="12" class="text-center">
          <h1 class="slider-title">Promotions :</h1>
        </v-col>
      </v-row>

      <v-carousel>
        <v-carousel-item v-for="sale in sales" :key="sale.id">
          <div class="slider-card">
            <v-card class="text-center">
              <v-img
                v-for="image in sale.salesImages"
                :key="image"
                :src="`/images/SalesImages/${image}`"
                class="slider-image"
                cover
              ></v-img>

              <v-card-text class="card-content">
                <v-card-title class="title">{{ sale.slogan }}</v-card-title>
                <v-card-subtitle class="subtitle">{{ sale.description }}</v-card-subtitle>
                <strong class="discount">{{ sale.pourcent }}% de réduction</strong>
                <br />
                Du {{ sale.date_start }} au {{ sale.date_end }}
              </v-card-text>

              <v-card-actions class="card-actions">
                <v-btn color="primary" @click="redirectToProduct(sale.id)">
                  En profiter
                </v-btn>
              </v-card-actions>
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

  methods: {
    redirectToProduct(productId) {
      // Redirige vers la page /Products/:id produit détail????
      this.$router.push({ path: `/Products/${productId}` });
    },
  },
};
</script>

<style scoped>
.slider-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start; 
  height: 100%; /* Remplit toute la hauteur de l'élément */
  text-align: center; /* Centre le texte horizontalement */
  background: rgba(0, 0, 0, 0.6); /* Fond sombre semi-transparent */
  color: white; /* Contraste avec le texte */
  padding: 20px;
  box-sizing: border-box;
}

.title {
  font-size: 1.8rem; /* Taille de titre importante */
  font-weight: bold; /* Texte en gras */
  margin-bottom: 10px;
}

.subtitle {
  font-size: 1.2rem;
  margin-bottom: 10px;
  line-height: 1.4; /* Ajoute de l'espacement entre les lignes */
}
.slider-title {
  font-size: 3rem; /* Taille du texte */
  font-weight: bold; /* Texte gras */
  background-image: linear-gradient(to right, violet, indigo, blue);            
  background-clip: text;
            color: transparent;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Légère ombre */
  margin: 0; /* Pas de marge par défaut */
  text-align: center; /* Centré horizontalement */
  font-family: 'Poppins', sans-serif; /* Police élégante */
}
.discount {
  font-size: 1.4rem;
  color: #bba257; /* Couleur dorée pour mettre en avant les réductions */
  font-weight: bold;
  margin-bottom: 10px;
}
.slider-image {
  margin-top: 15px;
  max-width: 100%; /* S'étend sur toute la largeur du slider */
  max-height: 200px; /* Définit une hauteur maximale */
  object-fit: cover; /* Recadre les images sans déformation */
  border-radius: 10px; /* Coins arrondis pour un style élégant */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Ombre subtile */
}
.card-actions {
  display: flex;
  justify-content: center; /* Centre le bouton */
  margin-top: 10px;
}
.v-btn {
  font-size: 1rem;
  text-transform: uppercase;
  font-weight: bold;
  color: white;
  background-color: #ff5722; /* Couleur vive pour attirer l'attention */
  border-radius: 5px;
  padding: 10px 15px;
}
.v-btn:hover {
  background-color: #e64a19; /* Couleur plus foncée au survol */
}
</style>

<template>
    <v-container>
      <!-- Titre Principal -->
      <v-row justify="center"  class="slider-title-row">
        <v-col cols="12" class="text-center">
          <h1 class="slider-title">Boutiques/Restaurants :</h1>
        </v-col>
      </v-row>

      <!-- Carousel -->
      <v-carousel height="380">
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
              <v-card-actions class="card-actions">
                <v-btn
                  v-if="shop.type.toLowerCase() === 'restaurant'"
                  color="success"
                  @click="reserve(shop.id)"
                >
                  Réserver
                </v-btn>
                <v-btn
                  v-else-if="shop.type.toLowerCase() === 'magasin'"
                  color="primary"
                  @click="viewProducts(shop.id)"
                >
                  Nos produits
                </v-btn>
              </v-card-actions>
            </v-card>
          </div>
        </v-carousel-item>
      </v-carousel>
    </v-container>
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
  methods: {
    reserve(shopId) {
      //  réservation 
      console.log(`Réservation pour le restaurant avec l'ID ${shopId}.`);
      alert(`Vous avez choisi de réserver le restaurant avec l'ID ${shopId}.`);
    },
    viewProducts(shopId) {
      // produits 
      console.log(`Afficher les produits pour le magasin avec l'ID ${shopId}.`);
      this.$router.push({ path: `/shop/${shopId}/products` });
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
  background-image: linear-gradient(to right, violet, indigo, blue);            
  background-clip: text;
            color: transparent;
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
  height: 100%; 
  text-align: center; 
  background: rgba(0, 0, 0, 0.6); 
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

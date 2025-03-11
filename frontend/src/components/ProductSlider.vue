<template>
  <v-app>
    <v-container>
      <!-- Titre Principal -->
      <v-row justify="center" class="slider-title-row">
        <v-col cols="12" class="text-center">
          <h1 class="slider-title">Produits :</h1>
        </v-col>
      </v-row>

      <!-- Carousel -->
      <v-carousel>
        <v-carousel-item v-for="product in products" :key="product.id">
          <div class="slider-card">
            <v-card class="text-center">
              <v-card-title class="title">{{ product.name }}</v-card-title>
              <v-card-subtitle class="subtitle">{{ product.description }}</v-card-subtitle>
              <v-card-text>
                <strong>Prix:</strong> {{ product.price }} €<br />
                <strong>Stock:</strong> {{ product.stock ? 'Disponible' : 'Rupture de stock' }}<br />
                <strong>Catégorie:</strong> {{ product.category }}
              </v-card-text>
              <v-card-actions>
                <v-btn color="primary" @click="orderProduct(product.id)">Commander</v-btn>
                <v-icon>mdi-cart</v-icon>  
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
  name: 'ProductSlider',
  props: {
    products: {
      type: Array,
      required: true,
    },
  },
  methods: {
    orderProduct(productId) {
      this.$router.push({ path: '/order', query: { productId } });     
       console.log(`Produit avec l'ID ${productId} commandé.`);
      
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
  background-image: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet);
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
.v-btn {
  margin-top: 10px;
  color: white;
}
</style>

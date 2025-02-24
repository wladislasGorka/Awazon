<template>
  <v-container>
    <v-form @submit.prevent="createProduct">
      <v-text-field
        v-model="product.name"
        label="Nom du produit"
        required
      ></v-text-field>
      <v-text-field
        v-model="product.description"
        label="Description"
        required
      ></v-text-field>
      <v-text-field
        v-model="product.price"
        label="Prix"
        type="number"
        required
      ></v-text-field>
      <v-btn type="submit" color="primary">Créer</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      product: {
        name: '',
        descritpion:'',
        price: 0
      }
    };
  },
  methods: {
    createProduct() {
      // Appeler l'API pour créer un produit
      fetch('http://localhost:8000/api/product', {        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.product)
      })
      .then(response => response.json())
      .then(data => {
        // Traiter la réponse de l'API
        console.log('Produit créé avec succès:', data);
        // Réinitialiser le formulaire
        this.product.name = '';
        this.product.descritpion='',
        this.product.price = 0;
      })
      .catch(error => {
        console.error('Erreur lors de la création du produit:', error);
      });
    }
  }
};
</script>

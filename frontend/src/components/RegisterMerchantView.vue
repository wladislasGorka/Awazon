<!-- src/components/RegisterMerchantView.vue -->
<template>
  <v-container class="register-container">
    <v-form @submit.prevent="submitForm" class="register-form">
      <v-row>
        <v-col col="12" md="6">
          <h2 class="form-heading">Identité personnelle</h2>
          <v-text-field v-model="name" label="Nom" required class="mb-4"></v-text-field>
          <v-text-field v-model="firstName" label="Prénom" required class="mb-4"></v-text-field>
          <v-text-field v-model="email" label="Email" type="email" required class="mb-4"></v-text-field>
          <v-text-field v-model="phone" label="Téléphone" type="number" required class="mb-4"></v-text-field>
          <v-text-field v-model="address" label="Adresse" type="text" required class="mb-4"></v-text-field>
          <v-text-field v-model="password" label="Mot de passe" type="password" required class="mb-4"></v-text-field>
        </v-col>
        <v-col col="12" md="6">
          <h2 class="form-heading">Identité de la boutique</h2>
          <v-text-field v-model="nameShop" label="Nom de la boutique" type="text" required class="mb-4"></v-text-field>
          <v-text-field v-model="addressShop" label="Adresse de la boutique" type="text" required class="mb-4"></v-text-field>
          <v-text-field v-model="siret" label="Siret" type="number" required class="mb-4"></v-text-field>
        </v-col>
      </v-row>      
      <v-btn type="submit" color="primary" class="submit-btn">Enregistrer en tant que Marchand</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      firstName: '',
      email: '',
      phone: '',
      address: '',
      password: '',
      nameShop: '',
      addressShop: '',
      siret: ''
    };
  },
  methods: {
    submitForm() {
      const userData = {
        name: this.name,
        firstName: this.firstName,
        email: this.email,
        phone: this.phone,
        address: this.address,
        password: this.password,
        nameShop: this.nameShop,
        addressShop: this.addressShop,
        siret: this.siret
      };

      fetch('http://localhost:8000/merchant/registration', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(userData)
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        this.$router.push({ path: '/login' });
        return response.json();
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    }
  }
};
</script>

<style scoped>
.register-container {
  max-width: 800px;
  margin: 50px auto;
  padding: 30px;
  background: #f9f9f9;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.register-form {
  display: flex;
  flex-direction: column;
}

.form-heading {
  font-size: 24px;
  color: #6c5ce7;
  margin-bottom: 20px;
  font-weight: bold;
}

.v-text-field {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.submit-btn {
  margin-top: 20px;
  padding: 12px 25px;
  font-weight: bold;
  border-radius: 30px;
  background-color: #6c5ce7;
}

.submit-btn:hover {
  background-color: #5a4be1;
}

.v-text-field label {
  font-weight: bold;
  color: #333;
}

.mb-4 {
  margin-bottom: 20px;
}
</style>

<!-- src/components/RegisterMemberView.vue -->
<template>
  <v-container class="register-container">
    <v-form @submit.prevent="submitForm" class="register-form">
      <v-text-field v-model="firstname" label="Firstname" type="text" required class="mb-4"></v-text-field>
      <v-text-field v-model="name" label="Name" type="text" required class="mb-4"></v-text-field>
      <v-text-field v-model="phone" label="Phone" type="number" required class="mb-4"></v-text-field>
      <v-text-field v-model="email" label="Email" type="email" required class="mb-4"></v-text-field>
      <v-text-field v-model="password" label="Mot de passe" type="password" required class="mb-4"></v-text-field>
      <v-btn type="submit" color="primary" class="submit-btn">Enregistrer en tant que membre</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      firstname: '',
      name: '',
      phone: '',
      email: '',
      password: ''
    };
  },
  methods: {
    submitForm() {
      const userData = {
        firstName: this.firstname,
        name: this.name,
        phone: this.phone,
        email: this.email,
        password: this.password
      };

      fetch('http://localhost:8000/member/registration', {
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
  max-width: 500px;
  margin: 50px auto;
  background: #f9f9f9;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.register-form {
  display: flex;
  flex-direction: column;
}

.register-form .v-text-field {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.register-form .submit-btn {
  margin-top: 20px;
  padding: 10px 20px;
  font-weight: bold;
  border-radius: 30px;
}

.register-form .submit-btn:hover {
  background-color: #6c5ce7;
}

.v-text-field label {
  font-weight: bold;
  color: #333;
}
</style>

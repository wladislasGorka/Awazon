<!-- src/components/LoginView.vue -->
<template>
  <v-form @submit.prevent="submitForm">
    <v-text-field v-model="email" name="email" label="Email" type="email" required></v-text-field>
    <v-text-field v-model="password" name="password" label="Mot de passe" type="password" required></v-text-field>
    <v-btn type="submit" color="primary">Login</v-btn>
  </v-form>
</template>

<script>

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    submitForm() {
      const userData = {
        email: this.email,
        password: this.password
      };
      console.log(userData);

      fetch('http://localhost:8000/login', {
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
        return response.json();
      })
      .then(data => {
        console.log('User logged successfully:', data);
        this.$cookies.set('token', data.token, '1D');
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      }); 
    }
  }
};

</script>


<!-- src/components/RegisterMemberView.vue -->
<template>
    <v-form @submit.prevent="submitForm">
      <v-text-field v-model="firstname" label="firstname" type="text" required></v-text-field>
      <v-text-field v-model="name" label="name" type="text" required></v-text-field>
      <v-text-field v-model="phone" label="phone" type="number" required></v-text-field>
      <v-text-field v-model="email" label="Email" type="email" required></v-text-field>
      <v-text-field v-model="password" label="Mot de passe" type="password" required></v-text-field>
      <v-btn type="submit" color="primary">Enregistrer en tant que membre</v-btn>
    </v-form>
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
          return response.json();
        })
        .then(data => {
          console.log('Member created successfully');
          this.$cookies.set('token', data.token, '1D');
          //console.log('Token:', this.$cookies.get('token'));
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      }
    }
  };
  </script>
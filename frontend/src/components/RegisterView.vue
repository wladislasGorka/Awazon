<!-- src/components/RegisterView.vue -->
<template>
    <v-form @submit.prevent="submitForm">
      <v-text-field v-model="name" label="Nom" required></v-text-field>
      <v-text-field v-model="email" label="Email" type="email" required></v-text-field>
      <v-text-field v-model="password" label="Mot de passe" type="password" required></v-text-field>
      <v-btn type="submit" color="primary">Enregistrer</v-btn>
    </v-form>
  </template>
  
  <script>
  import { getAuth, createUserWithEmailAndPassword } from "firebase/auth";

  export default {
    data() {
      return {
        name: '',
        email: '',
        password: ''
      };
    },
    methods: {
      submitForm() {
        const userData = {
          name: this.name,
          email: this.email,
          password: this.password
        };

        const auth = getAuth();
        createUserWithEmailAndPassword(auth, this.email, this.password).then( cred =>{
            console.log(cred);
        })
  
        fetch('http://localhost:8000/user', {
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
          console.log('User created successfully:', data);
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      }
    }
  };
  </script>
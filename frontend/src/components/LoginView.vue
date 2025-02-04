<!-- src/components/LoginView.vue -->
<template>
    <v-form @submit.prevent="submitForm">
      <v-text-field v-model="email" label="Email" type="email" required></v-text-field>
      <v-text-field v-model="password" label="Mot de passe" type="password" required></v-text-field>
      <v-btn type="submit" color="primary">Enregistrer</v-btn>
    </v-form>
  </template>
  
  <script>
  import { getAuth, signInWithEmailAndPassword } from "firebase/auth";

  export default {
    data() {
      return {
        email: '',
        password: ''
      };
    },
    methods: {
      submitForm() {
        // const userData = {
        //   email: this.email,
        //   password: this.password
        // };
        
        const auth = getAuth();
        signInWithEmailAndPassword(auth, this.email, this.password)
        .then( cred =>{
            console.log(cred);
        })
      }
    }
  };
  </script>
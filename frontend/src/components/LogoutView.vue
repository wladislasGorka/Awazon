<!-- src/components/LogoutView.vue -->
<template>
    <div>
      <p>Hello</p>
      <v-btn @click="logout">Logout</v-btn>
    </div>
</template>
  
  <script>
  import { getAuth, signOut } from 'firebase/auth';
  
  export default {
    name: 'LogoutView',
    methods: {
      logout() {
        const auth = getAuth();
        signOut(auth)
          .then(() => {
            console.log('Sign-out successful.');
            // Redirect to login page or show a message
          })
          .catch((error) => {
            console.error('Error signing out:', error);
          });
      }
    }
  };
  </script>
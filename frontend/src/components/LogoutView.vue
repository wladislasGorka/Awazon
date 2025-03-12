<!-- src/components/LogoutView.vue -->
<template>
    <div>
      <p>Hello</p>
      <v-btn @click="logout">Logout</v-btn>
    </div>
</template>
  
  <script>
  
  export default {
    name: 'LogoutView',
    methods: {
      logout() {
        fetch('http://localhost:8000/logout', {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json'
            }
          })
          .then(response => {
            if (response.ok) {
                this.$router.push('/Events');
            } else {
                console.error('Logout failed:', response.statusText);
            }
          })
          .catch(error => {
            console.error('Erreur:', error);
          });
      }
    }
  };
  </script>
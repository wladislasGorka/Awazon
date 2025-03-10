<template>
  <v-container fill-height>
    <v-row justify="center" align="center">
      <v-col cols="12" sm="8" md="6">
        <v-card class="elevation-12" :style="{ background: 'linear-gradient(to bottom right, #673ab7, #512da8)' }">
          <v-card-title class="text-center text-white">
            <span class="headline">Login</span>
          </v-card-title>
          
          <v-card-text>
            <v-form @submit.prevent="submitForm">
              <v-text-field 
                v-model="email" 
                name="email" 
                label="Email" 
                type="email" 
                required 
                class="mt-4"
                outlined
                dense
                color="purple"
              ></v-text-field>
              <v-text-field 
                v-model="password" 
                name="password" 
                label="Mot de passe" 
                type="password" 
                required 
                class="mt-4"
                outlined
                dense
                color="purple"
              ></v-text-field>

              <v-btn 
                type="submit" 
                color="primary" 
                class="mt-5 w-100" 
                elevation="2"
                :style="{
                  background: 'linear-gradient(to right, #512da8, #673ab7)',
                  transition: 'background 0.3s ease-in-out'
                }"
                @mouseover="hover = true" 
                @mouseleave="hover = false"
              >
                Login
              </v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      email: '',
      password: '',
      hover: false
    };
  },
  methods: {
    ...mapActions(['toggleLogin']),
    submitForm() {
      const userData = {
        email: this.email,
        password: this.password
      };

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
        this.$cookies.set('token', data.token, '1D');
        this.$cookies.set('user', data, '1D');
        this.toggleLogin();
        if (data.roles[1] === 'ROLE_MEMBER') {
          this.$router.push('/');
        }
        if (data.roles[1] === 'ROLE_MERCHANT') {
          this.$router.push('/dashboard');
        } 
        if (data.roles[1] === 'ROLE_ADMIN') {
          this.$router.push('/dashboard-admin');
        }
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      }); 
    }
  }
};
</script>

<style scoped>

/* .v-container {
  background: url('/frontend/public/images/loginImage.jpg') no-repeat center center fixed;
  background-size: cover;
  height: 100vh;
}
 */

.v-btn {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.v-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}


.v-card {
  border-radius: 16px;
}


.v-text-field {
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 8px;
}
</style>

<template>
  <v-container>
    <h2 class="display-2 font-weight-bold mb-3">
      Formulaire de contact
    </h2>
    <v-form ref="form" v-model="valid" class="animated-form">
      <v-text-field
        v-model="form.name"
        :rules="[v => !!v || 'Nom requis']"
        label="Nom"
        required
        class="animated-input"
      ></v-text-field>
      <v-text-field
        v-model="form.email"
        :rules="emailRules"
        label="Email"
        required
        class="animated-input"
      ></v-text-field>
      <v-select
        v-model="form.reason"
        :items="reasons"
        label="Raison de contact"
        required
        class="animated-input"
      ></v-select>
      <v-textarea
        v-model="form.message"
        :rules="[v => !!v || 'Message requis']"
        label="Message"
        required
        rows="5"
        class="animated-textarea"
      ></v-textarea>
      <v-btn
        :disabled="!valid"
        @click="submitForm"
        color="primary"
        class="animated-btn"
      >
        Envoyer le message
      </v-btn>
    </v-form>
    <v-alert
      v-if="success"
      type="success"
      dismissible
      class="mt-3"
    >
      Message envoyé avec succès!
    </v-alert>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      valid: false,
      form: {
        name: '',
        email: '',
        reason: '',
        message: '',
      },
      reasons: [
        'Support',
        'Ventes',
        'Retour d\'information',
        'Autre'
      ],
      emailRules: [
        v => !!v || 'Email requis',
        v => /.+@.+/.test(v) || 'Email doit être valide',
      ],
      success: false,
    };
  },
  methods: {
    submitForm() {
      if (this.$refs.form.validate()) {
        // Simulate form submission
        setTimeout(() => {
          this.success = true;
          this.resetForm();
        }, 1000);
      }
    },
    resetForm() {
      this.form.name = '';
      this.form.email = '';
      this.form.reason = '';
      this.form.message = '';
      this.$refs.form.reset();
    }
  }
};
</script>

<style scoped>
/* CSS Animations */
.animated-form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  animation: fadeInUp 0.5s ease-out;
}

.animated-input, .animated-textarea {
  transition: all 0.3s ease-in-out;
}

.animated-input:focus, .animated-textarea:focus {
  box-shadow: 0 0 10px 2px rgba(103, 58, 183, 0.5); /* Purple glow */
  transform: scale(1.05);
}

.animated-btn {
  background-color: #673ab7; /* Purple color */
  transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.animated-btn:hover {
  background-color: #512da8; /* Darker purple on hover */
  transform: translateY(-2px);
}

.animated-btn:active {
  transform: translateY(0);
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

<template>
    <v-container>    
      <h2 class="display-2 font-weight-bold mb-3">
        Formulaire de contact
      </h2>
      <FormView :form="form"/>
    </v-container>
  </template>
  
  <script>
import FormView from './FormView.vue';

  
  export default {
    name: 'ContactPage',
    components: {
      FormView,
    },
    data() {
      return {
        form: {
          input: "v-text-filed", model: "name", type: "text", label: "name", required: true
        }
        
      };
    }
  }
  </script>
  
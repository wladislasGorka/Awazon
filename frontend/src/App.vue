<template>
  <v-app>
    <v-main>
      <HelloWorld/>
      <v-container>
        <user-form></user-form>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import UserForm from './components/UserForm.vue';

export default {
  name: 'App',
  
  components: {
    HelloWorld,
    UserForm
  },

  data: () => ({
    //
  }),
}
</script>

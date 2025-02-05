<!-- src/components/Navbar.vue -->
<template>
    <v-app-bar app>
      <v-toolbar-title>My Navbar</v-toolbar-title>
      <v-spacer></v-spacer>
      <RouterLink to="/"> Home</RouterLink> |
      <RouterLink to="/Register"> Register</RouterLink> |
      <RouterLink to="/Login"> Login</RouterLink> |
      <RouterLink to="/Logout"> Logout</RouterLink>
    </v-app-bar>
</template>

<script>
    import { RouterLink } from 'vue-router';

    export default {
    name: 'Nav-bar',
    components: {
        RouterLink,
    },
    }
</script>
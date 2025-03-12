<template>
  <v-container>
    <v-row>
      <v-col v-for="section in section" :key="section.id">
        <v-card @click="goToSection(section.id)">
          <v-card-title>{{ section.name }}</v-card-title>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      section: [],
    };
  },
  created() {
    this.fetchsection();
  },
  methods: {
    fetchsection() {
      fetch('/ForumSection', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        this.section = data;
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    },
    goToSection(id) {
      this.$router.push(`/forumSection/${id}`);
    },
  },
};
</script>

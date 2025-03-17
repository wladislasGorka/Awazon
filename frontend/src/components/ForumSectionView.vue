<template>
  <v-container>
    <v-row v-if="loading">
      <v-col class="text-center">
        <v-progress-circular indeterminate color="primary"></v-progress-circular>
      </v-col>
    </v-row>
    <v-row v-else-if="error">
      <v-col class="text-center">
        <p class="error--text">{{ error }}</p>
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col v-for="section in sections" :key="section.id">
        <v-card @click="goToSection(section.id)">
          <v-card-title>{{ section.name }}</v-card-title>
          <v-card-text>
            <p>Accès: {{ section.access }}</p>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      sections: [],
      loading: true,
      error: null,
    };
  },
  created() {
    this.fetchSections();
  },
  methods: {
    fetchSections() {
      this.loading = true;
      this.error = null;
      fetch('/forum-section', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error('Erreur de réseau');
          }
          return response.json();
        })
        .then((data) => {
          this.sections = data;
        })
        .catch((error) => {
          console.error('Erreur lors de la récupération des sections:', error);
          this.error = 'Impossible de charger les sections.';
        })
        .finally(() => {
          this.loading = false;
        });
    },
    goToSection(id) {
      this.$router.push(`/forum-section/${id}`);
    },
  },
};
</script>
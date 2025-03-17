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
      <v-col v-for="subject in subjects" :key="subject.id">
        <v-card @click="goToSubject(subject.id)">
          <v-card-title>{{ subject.name }}</v-card-title>
          <v-card-text>
            <p>Créé par: {{ subject.user.email }}</p>
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
      subjects: [],
      loading: true,
      error: null,
    };
  },
  created() {
    this.fetchSubjects();
  },
  methods: {
    fetchSubjects() {
      this.loading = true;
      this.error = null;
      fetch(`/forum-subject?forum-section_id=${this.$route.params.id}`, {
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
          this.subjects = data;
        })
        .catch((error) => {
          console.error('Erreur lors de la récupération des sujets:', error);
          this.error = 'Impossible de charger les sujets.';
        })
        .finally(() => {
          this.loading = false;
        });
    },
    goToSubject(id) {
      this.$router.push(`/forum-message/${id}`);
    },
  },
};
</script>
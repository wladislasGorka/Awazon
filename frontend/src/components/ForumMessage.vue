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
      <v-col>
        <forum-message :message="forumMessage" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>


export default {
  data() {
    return {
      forumMessage: null,
      loading: true,
      error: null,
    };
  },
  created() {
    this.fetchForumMessage();
  },
  methods: {
    async fetchForumMessage() {
      this.loading = true;
      this.error = null;
      try {
        const response = await fetch(`/forum-message/${this.$route.params.id}`, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
        });

        if (!response.ok) {
          throw new Error('Erreur de réseau');
        }

        this.forumMessage = await response.json();
      } catch (error) {
        console.error('Erreur lors de la récupération du message:', error);
        this.error = 'Impossible de charger le message.';
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

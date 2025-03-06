<template>
  <v-container>
    <v-row>
      <v-col v-for="section in sections" :key="section.id">
        <v-card @click="goToSection(section.id)">
          <v-card-title>{{ section.name }}</v-card-title>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      sections: [],
    };
  },
  created() {
    this.fetchSections();
  },
  methods: {
    fetchSections() {
      axios.get('/section')
        .then(response => {
          this.sections = response.data;
        });
    },
    goToSection(id) {
      this.$router.push(`/section/${id}`);
    },
  },
};
</script>

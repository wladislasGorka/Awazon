<template>
    <v-container>
      <v-row>
        <v-col v-for="subject in subjects" :key="subject.id">
          <v-card @click="goToSubject(subject.id)">
            <v-card-title>{{ subject.name }}</v-card-title>
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
        subjects: [],
      };
    },
    created() {
      this.fetchSubjects();
    },
    methods: {
      fetchSubjects() {
        axios.get(`/subjects?section_id=${this.$route.params.id}`)
          .then(response => {
            this.subjects = response.data;
          });
      },
      goToSubject(id) {
        this.$router.push(`/subject/${id}`);
      },
    },
  };
  </script>
  
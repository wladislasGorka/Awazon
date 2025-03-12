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
        fetch(`/forumSubject?forumSection_id=${this.$route.params.id}`, {
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
          this.subjects = data;
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      },
      goToSubject(id) {
        this.$router.push(`/forumSubject/${id}`);
      },
    },
  };
  </script>
  
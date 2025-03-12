<template>
    <v-container>
      <v-row>
        <v-col>
          <v-card>
            <v-card-title>{{ subject.name }}</v-card-title>
            <v-card-text>
              <p>Section: {{ subject.forumSection }}</p>
              <p>Created by: {{ subject.user }}</p>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col v-for="message in messages" :key="message.id">
          <v-card>
            <v-card-text>
              {{ message.message }}
              <small>{{ message.date_creation }} by {{ message.user }}</small>
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
        subject: {},
        messages: [],
      };
    },
    created() {
      this.fetchSubjectAndMessages();
    },
    methods: {
      fetchSubjectAndMessages() {
        fetch(`/ForumSubject/${this.$route.params.id}`, {
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
          this.subject = data;
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation for subject:', error);
        });
  
        fetch(`/message?subject_id=${this.$route.params.id}`, {
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
          this.messages = data;
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation for messages:', error);
        });
      },
    },
  };
  </script>
  
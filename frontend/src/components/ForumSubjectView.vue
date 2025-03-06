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
  import axios from 'axios';
  
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
        axios.get(`/subject/${this.$route.params.id}`)
          .then(response => {
            this.subject = response.data;
          });
        axios.get(`/message?subject_id=${this.$route.params.id}`)
          .then(response => {
            this.messages = response.data;
          });
      },
    },
  };
  </script>
  
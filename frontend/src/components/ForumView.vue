<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <h1>Forum</h1>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <ForumSectionView />
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <ForumSubjectView />
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <ForumMessage />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ForumSectionView from './ForumSectionView.vue';
import ForumSubjectView from './ForumSubjectView.vue';
import ForumMessage from './ForumMessage.vue';

export default {
  components: {
    ForumSectionView,
    ForumSubjectView,
    ForumMessage,
  },
};
</script>
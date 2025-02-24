<template>
    <div>
      <p>Name: {{ form.input }}</p>
      <p>Name: {{ form.model }}</p>
      <p>Name: {{ form.type }}</p>
      <p>Name: {{ form.label }}</p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      form: {
        type: Object,
        required: true
      }
    }
  };
  </script>
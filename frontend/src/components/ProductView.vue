<template>
  <div>
    <h1>Liste des produits</h1>
    <ul>
      <li v-for="product in products" :key="product.id">{{ product.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ['products'],
};
</script>

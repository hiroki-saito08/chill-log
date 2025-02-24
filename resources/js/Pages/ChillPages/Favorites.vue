<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const favorites = ref([]);

onMounted(() => {
  favorites.value = usePage().props.favorites || [];
});
</script>

<template>
  <div>
    <h2>Favorites</h2>
    <ul>
      <li v-for="fav in favorites" :key="fav.id">
        <a :href="`/posts/${fav.id}`">{{ fav.title }}</a>
      </li>
    </ul>
  </div>
</template>

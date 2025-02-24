<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const posts = ref([]);

onMounted(() => {
  posts.value = usePage().props.posts || [];
});
</script>

<template>
  <div>
    <h2>My Posts</h2>
    <ul>
      <li v-for="post in posts" :key="post.id">
        <a :href="`/posts/${post.id}`">{{ post.title }}</a>
      </li>
    </ul>
  </div>
</template>

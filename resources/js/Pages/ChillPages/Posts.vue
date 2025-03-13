<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
  posts: Object
});
</script>

<template>
  <Head title="All Chill Spots" />
  <div class="bg-light min-vh-100">
    <Header />

    <div class="container mt-5">
      <h3>📌 All Chill Spots</h3>
      <div class="list-group">
        <Link v-for="post in posts.data" :key="post.id" :href="route('posts.show', post.id)" class="list-group-item">
          {{ post.title }}
        </Link>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import PostCard from '@/Components/PostCard.vue';
import Pagination from '@/Components/Pagination.vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
  user: Object,
  posts: Object,
});
</script>

<template>
  <Header />
  <div class="container my-5">
    <div class="bg-white p-4 rounded-4 shadow-sm mb-4 text-center">
      <img
        :src="`/storage/${user.profile_image}`"
        alt="Profile image"
        class="rounded-circle mb-3"
        style="width: 100px; height: 100px; object-fit: cover;"
        @error="(e) => e.target.src = '/images/default.jpg'"
      >
      <h2 class="fw-bold">{{ user.name }}</h2>
      <p class="text-muted" style="white-space: pre-line;">{{ user.bio }}</p>
    </div>

    <div>
      <h4 class="mb-3 text-secondary">Posts by {{ user.name }}</h4>
      <div v-if="posts.data.length">
        <PostCard v-for="post in posts.data" :key="post.id" :post="post" />
        <Pagination :links="posts.links" />
      </div>
      <p v-else class="text-muted">No posts yet.</p>
    </div>
  </div>

  <Footer />
</template>

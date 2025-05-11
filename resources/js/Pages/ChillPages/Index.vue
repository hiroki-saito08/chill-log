<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import PostCard from '@/Components/PostCard.vue';

const props = defineProps({
  posts: Object,
  popularPosts: Object
});

const filters = ref({
  keyword: '',
  category: '',
})

function searchPosts() {
  router.get(route('posts'), {
    keyword: filters.value.keyword,
    category: filters.value.category,
  })
}
</script>

<template>
  <Head title="Chill-log" />
  <div class="bg-light min-vh-100 top-page">
    <Header />

    <!-- 検索フォーム -->
    <div class="search-wrapper">
      <input
        type="text"
        v-model="filters.keyword"
        placeholder="Search by keyword..."
        class="form-control mb-2"
      />
      <select v-model="filters.category" class="form-select mb-3">
        <option value="">All Categories</option>
        <option value="Park">Park</option>
        <option value="Cafe">Cafe</option>
        <option value="Beach">Beach</option>
        <option value="Other">Other</option>
      </select>
      <button @click="searchPosts" class="btn btn-success w-100">
        Search
      </button>
    </div>

    <div class="container">

      <div class="section">
        <h3 class="mb-4">🏆 Popular Chill Spots</h3>
        <PostCard v-for="post in popularPosts" :key="post.id" :post="post" />
      </div>

      <div class="section">
        <h3 class="mb-4">🆕 New Chill Spots</h3>
        <PostCard v-for="post in posts" :key="post.id" :post="post" />
      </div>
    </div>

    <Footer />
  </div>
</template>

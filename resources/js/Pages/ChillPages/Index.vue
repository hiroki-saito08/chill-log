<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import PostCard from '@/Components/PostCard.vue';

const props = defineProps({
  posts: Object,
  popularPosts: Object,
  categories: Array
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
  <!-- SEO -->
  <Head>
    <title>Chill-log | Find Your Chill Spot</title>
    <meta name="description" content="Chill-log is a place to share and discover relaxing spots around you. Parks, cafes, beaches and more – find your perfect chill." />
    <meta property="og:title" content="Chill-log | Find Your Chill Spot" />
    <meta property="og:description" content="Share and explore relaxing places like parks, cafes, and beaches in your area." />
    <meta property="og:image" content="/default-ogp.png" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://chill-log.com/" />
  </Head>

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
        <option v-for="option in categories" :key="option" :value="option">
          {{ option }}
        </option>
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

<style>
  .top-page .container {
    margin-top: 60px;
    margin-bottom: 60px;
  }

  .top-page .section {
    background: #f4f4f4;
    padding: 30px;
    border-left: 10px solid #88B04B;
    border-radius: 10px;
    margin-bottom: 40px;
  }

  .top-page .section:last-child {
    margin-bottom: 0;
  }

  .search-wrapper {
    max-width: 800px;
    text-align: center;
    margin: 0 auto;
    margin-top: 40px;
    margin-bottom: 40px;
  }

@media (max-width: 768px) {
  .top-page .container {
    margin-top: 0;
    margin-bottom: 0;
    border-radius: 0;
  }

  .top-page .section {
    background: none;
    padding: 0;
    border-left: none;
    border-radius: 0;
    margin-bottom: 60px;
  }

  .search-wrapper {
    padding: 15px;
    margin-top: 20px;
    margin-bottom: 20px;
  }
}
</style>

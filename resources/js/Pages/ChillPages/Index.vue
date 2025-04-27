<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import PostCard from '@/Components/PostCard.vue';
import { computed } from 'vue';

const props = defineProps({
  posts: Object,
  popularPosts: Object
});

// ページネーションのリンク
const paginationLinks = computed(() => props.posts.links);
</script>

<template>
  <Head title="Chill-log" />
  <div class="bg-light min-vh-100">
    <Header />

    <div class="m-5">
      <div class="d-flex justify-content-center">
        <input type="text" placeholder="Search for chill spots..." class="form-control w-75 rounded-pill shadow-sm">
      </div>
    </div>

    <div class="search-map">
      <h3>🗺 Area selection (Map & Search)</h3>
      <div class="map-container">🗺 Map area (to be implemented)</div>
    </div>

    <div class="container custom-container">

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

  .container {
    margin-top: 60px;
    margin-bottom: 60px;
  }

  .search-bar input {
    width: 70%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .search-map {
    width: 70%;
    margin: 0 auto;
  }

  .map-container {
    width: 100%;
    height: 300px;
    background: #d3d3d3;
    text-align: center;
    line-height: 300px;
    border-radius: 10px;
    font-size: 18px;
    color: #555;
  }
</style>

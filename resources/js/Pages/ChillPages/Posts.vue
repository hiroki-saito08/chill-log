<script setup>
import { Link } from '@inertiajs/vue3'
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import PostCard from '@/Components/PostCard.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
  posts: Object,
  filters: Array
})

</script>

<template>
  <div>
    <Header />

    <div class="container">

      <div class="mt-3 mb-4">
        <span>Search Results:</span>
        <span v-if="!filters.category && !filters.keyword"> All </span>
        <span v-if="filters.category"> Category「{{ filters.category }}」</span>
        <span v-if="filters.keyword"> Keyword「{{ filters.keyword }}」</span>
      </div>

      <div v-if="posts.data.length">
        <PostCard v-for="post in posts.data" :key="post.id" :post="post" />

        <!-- ページネーション -->
        <Pagination :links="posts.links" />
      </div>

      <!-- 投稿がない場合 -->
      <div v-else class="no-posts">
        <p>No posts available.</p>
      </div>
    </div>

    <Footer />
  </div>
</template>

<style scoped>
.container {
  max-width: 1000px;
  margin: 80px auto;
  padding: 20px;
}

@media (max-width: 768px) {
  .container {
    margin-top: 0;
    margin-bottom: 0;
    border-radius: 0;
  }

  .section {
    background: none;
    padding: 0;
    border-left: none;
    border-radius: 0;
    margin-bottom: 60px;
  }
}
</style>

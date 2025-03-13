<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
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

    <div class="container mt-4 custom-container">
      <div class="d-flex justify-content-center">
        <input type="text" placeholder="Search for chill spots..." class="form-control w-75 rounded-pill shadow-sm">
      </div>
    </div>

    <div class="container mt-5">
      <h3>🏆 Popular Chill Spots</h3>
      <div class="list-group">
        <Link v-for="post in popularPosts" :key="post.id" :href="route('posts.show', post.id)" class="list-group-item">
          {{ post.title }}
        </Link>
      </div>
    </div>

    <div class="container mt-5">
      <h3>🆕 New Chill Spots</h3>
      <div class="list-group">
        <Link v-for="post in posts.data" :key="post.id" :href="route('posts.show', post.id)" class="list-group-item">
          {{ post.title }}
        </Link>
      </div>
    </div>

    <Footer />
  </div>
</template>


<style>
.custom-bg-green {
  background-color: #88B04B !important;
  border-radius: 20px;
}

.custom-container {
  max-width: 1000px !important;
  margin: 0 auto;
}

.custom-list-item {
  display: flex;
  align-items: center;
  padding: 15px 20px;
  border-radius: 15px;
  background: #ffffff;
  transition: all 0.2s ease-in-out;
  font-size: 1.1rem;
  font-weight: bold;
}

.custom-list-item:hover {
  background: #f8f9fa;
  transform: translateY(-2px);
}

/* リストの上部と下部の丸みを適用 */
.rounded-list {
  border-radius: 15px !important;
  overflow: hidden;
}

.list-group-item:first-child {
  border-top-left-radius: 15px !important;
  border-top-right-radius: 15px !important;
}

.list-group-item:last-child {
  border-bottom-left-radius: 15px !important;
  border-bottom-right-radius: 15px !important;
}
</style>

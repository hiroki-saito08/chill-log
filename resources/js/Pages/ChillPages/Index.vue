<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Search from '@/Components/Search.vue';
import { ref } from 'vue';

const props = defineProps({
  posts: Object,
  popularPosts: Object
});
</script>

<template>
  <Head title="Chill-log" />
  <div class="bg-light min-vh-100">
    <header class="custom-header text-white text-center rounded-bottom">
      <a href="#" class="text-white text-decoration-none">Chill-log</a>
    </header>

    <div class="container mt-4 custom-container">
      <div class="d-flex justify-content-center">
        <input type="text" placeholder="Search for chill spots..." class="form-control w-75 rounded-pill shadow-sm">
      </div>
    </div>

    <div class="container mt-5 custom-container">
      <div class="card text-white custom-bg-green">
        <div class="card-body">
          <h3 class="card-title">🗺 Area Selection (Map & Search)</h3>
          <div class="bg-light text-dark text-center py-5 rounded" style="border-radius: 15px;">🗺 Map Area (Coming Soon)</div>
        </div>
      </div>
    </div>

    <div class="container mt-5 custom-container">
      <div class="card text-white custom-bg-green">
        <div class="card-body">
          <h3 class="card-title">🏆 National Ranking</h3>
          <div class="list-group mt-3 rounded-list">
            <Link v-for="post in popularPosts" :key="post.id" :href="route('post.show', post.id)" class="list-group-item list-group-item-action custom-list-item text-dark fw-bold my-2">
            {{ post.title }}
            </Link>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5 custom-container">
      <div class="card text-white custom-bg-green">
        <div class="card-body">
          <h3 class="card-title">🆕 New Chill Spots</h3>
          <div class="list-group mt-3 rounded-list">
            <Link v-for="post in posts" :key="post.id" :href="route('post.show', post.id)" class="list-group-item list-group-item-action custom-list-item text-dark fw-bold my-2">
            {{ post.title }}
            </Link>
          </div>
        </div>
      </div>
    </div>

    <footer class="custom-footer text-white text-center py-3 mt-5 rounded-top">
      &copy; 2025 Chill-log
    </footer>
  </div>
</template>

<style>
.custom-bg-green {
  background-color: #88B04B !important;
  border-radius: 20px;
}

.custom-header {
  background-color: #6C7A89 !important;
  padding: 15px 0;
  font-size: 1.5rem;
}

.custom-footer {
  background-color: #6C7A89 !important;
  padding: 15px 0;
  font-size: 1.0rem;
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

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
    <header class="bg-secondary text-white py-3 text-center rounded-bottom">
      <a href="#" class="text-white text-decoration-none fs-3">🏠 Chill-log</a>
    </header>

    <div class="container mt-4">
      <div class="d-flex justify-content-center">
        <input type="text" placeholder="Search for chill spots..." class="form-control w-75 rounded-pill shadow-sm">
      </div>
    </div>

    <div class="container mt-5">
      <div class="card text-white" style="background-color: #88B04B; border-radius: 15px;">
        <div class="card-body">
          <h3 class="card-title">🗺 Area Selection (Map & Search)</h3>
          <div class="bg-light text-dark text-center py-5 rounded" style="border-radius: 10px;">🗺 Map Area (Coming Soon)</div>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="card text-white" style="background-color: #88B04B; border-radius: 15px;">
        <div class="card-body">
          <h3 class="card-title">🏆 National Ranking</h3>
          <div class="list-group">
            <Link v-for="post in popularPosts" :key="post.id" :href="route('post.show', post.id)" class="list-group-item list-group-item-action btn btn-light text-dark rounded-pill my-2">
            {{ post.title }}
            </Link>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="card text-white" style="background-color: #88B04B; border-radius: 15px;">
        <div class="card-body">
          <h3 class="card-title">🆕 New Chill Spots</h3>
          <div class="list-group">
            <Link v-for="post in posts" :key="post.id" :href="route('post.show', post.id)" class="list-group-item list-group-item-action btn btn-light text-dark rounded-pill my-2">
            {{ post.title }}
            </Link>
          </div>
        </div>
      </div>
    </div>

    <footer class="bg-secondary text-white text-center py-3 mt-5 rounded-top">
      &copy; 2025 Chill-log
    </footer>
  </div>
</template>

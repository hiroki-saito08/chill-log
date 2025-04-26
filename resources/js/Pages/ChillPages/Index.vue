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
        <div v-for="post in popularPosts" :key="post.id" class="mb-3">
          <Link
            :href="route('posts.show', { post: post.id })"
            class="text-decoration-none text-dark"
          >
            <div class="card">
              <div class="row g-0">
                <div class="col-4 d-flex align-items-center justify-content-center p-3">
                  <img
                    v-if="post.images.length"
                    :src="`/storage/${post.images[0].image_path}`"
                    alt="Post Image"
                    class="img-fluid rounded"
                    style="height: 120px; object-fit: cover;"
                  />
                  <div v-else class="text-muted small">No Image</div>
                </div>
                <div class="col-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.description }}</p>
                  </div>
                </div>
              </div>
            </div>
          </Link>
        </div>
      </div>

      <div class="section">
        <h3 class="mb-4">🆕 New Chill Spots</h3>
        <div v-for="post in posts" :key="post.id" class="mb-3">
          <Link
            :href="route('posts.show', { post: post.id })"
            class="text-decoration-none text-dark"
          >
            <div class="card">
              <div class="row g-0">
                <div class="col-4 d-flex align-items-center justify-content-center p-3">
                  <img
                    v-if="post.images.length"
                    :src="`/storage/${post.images[0].image_path}`"
                    alt="Post Image"
                    class="img-fluid rounded"
                    style="height: 120px; object-fit: cover;"
                  />
                  <div v-else class="text-muted small">No Image</div>
                </div>
                <div class="col-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.description }}</p>
                  </div>
                </div>
              </div>
            </div>
          </Link>
        </div>
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

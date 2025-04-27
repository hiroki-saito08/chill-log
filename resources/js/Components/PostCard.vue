<template>
  <div class="post-card">
    <Link :href="route('posts.show', { post: post.id })" class="post-link">
      <div class="post-thumbnail-wrapper">
        <img
          v-if="post.images.length"
          :src="`/storage/${post.images[0].image_path}`"
          alt="Spot image"
          class="post-thumbnail"
        />
      </div>
      <div class="post-info">
        <h2 class="post-title">{{ post.title }}</h2>
        <p class="post-description">{{ post.description?.slice(0, 100) }}...</p>
      </div>
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  post: Object
})
</script>

<style scoped>
.page-title {
  text-align: center;
  margin-bottom: 40px;
  color: #333;
}

.post-card {
  background: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  margin-bottom: 20px;
  overflow: hidden;
  transition: transform 0.2s;
}

.post-card:hover {
  transform: translateY(-2px);
}

.post-link {
  text-decoration: none;
  color: inherit;
  display: flex;
  flex-direction: row;
}

.post-thumbnail-wrapper {
  width: 150px;
  height: 150px;
  overflow: hidden;
  flex-shrink: 0;
}

.post-thumbnail {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.post-info {
  padding: 20px;
  flex-grow: 1;
}

.post-title {
  font-size: 20px;
  color: #88B04B; /* メインカラー */
  margin-bottom: 10px;
}

.post-description {
  color: #666;
  font-size: 14px;
}

</style>

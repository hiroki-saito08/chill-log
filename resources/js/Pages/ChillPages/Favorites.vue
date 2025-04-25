<script setup>
import { computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const favorites = computed(() => usePage().props.favorites);

const deletePost = (postId) => {
  if (confirm('Are you sure you want to remove this post?')) {
    router.delete(route('favorite.destroy', postId));
  }
};
</script>

<template>
  <section id="favorite-section" class="section">
    <h2>Favorite Posts</h2>

    <div v-if="favorites.length === 0">
      No Posts
    </div>
    <div v-else>
      <div class="favorite-list">
        <div v-for="favorite in favorites" :key="favorite.id" class="favorite-card">
          <img :src="favorite.image" alt="Spot Thumbnail" class="favorite-image">
          <div class="favorite-info">
            <h3>{{ favorite.title }}</h3>
            <p class="favorite-date">{{ favorite.date }}</p>
          </div>
          <div class="favorite-actions">
            <button class="delete-btn" @click="deletePost(favorite.post_id)">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* 見出し */
h2 {
  text-align: center;
}

/* お気に入りリスト */
.favorite-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* お気に入りカード */
.favorite-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: white;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.favorite-image {
  width: 50px;
  height: 50px;
  border-radius: 5px;
  object-fit: cover;
}

.favorite-info {
  flex-grow: 1;
  padding-left: 15px;
}

.favorite-info h3 {
  margin: 0;
  font-size: 16px;
}

.favorite-date {
  font-size: 14px;
  color: gray;
}

/* ボタン */
.favorite-actions {
  display: flex;
  gap: 10px;
}

.delete-btn {
  background: #dc3545;
  color: white;
  padding: 5px 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>

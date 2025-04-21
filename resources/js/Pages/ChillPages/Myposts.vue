<script setup>
import { ref, computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const posts = computed(() => usePage().props.posts);

const sortOption = ref('newest');
const sortedPosts = computed(() => {
  return [...posts.value].sort((a, b) => {
    return sortOption.value === 'newest'
      ? new Date(b.date) - new Date(a.date)
      : new Date(a.date) - new Date(b.date);
  });
});

const editPost = (id) => {
  console.log(`Edit post: ${id}`);
};

const deletePost = (id) => {
  router.delete(route('posts.destroy', id));
};
</script>

<template>
  <section id="my-posts-section" class="section">
    <h2>My Posts</h2>

    <div v-if="posts.length === 0">
      No Posts
    </div>
    <div v-else>
      <div class="filter-container">
        <select id="sort" v-model="sortOption">
          <option value="newest">Newest First</option>
          <option value="oldest">Oldest First</option>
        </select>
      </div>

      <div class="post-list">
        <div v-for="post in sortedPosts" :key="post.id" class="post-card">
          <img :src="post.image" alt="Spot Thumbnail" class="post-image">
          <div class="post-info">
            <h3>{{ post.title }}</h3>
            <p class="post-date">{{ post.date }}</p>
          </div>
          <div class="post-actions">
            <button class="edit-btn" @click="editPost(post.id)">Edit</button>
            <button class="delete-btn" @click="deletePost(post.id)">Delete</button>
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

/* ソート機能 */
.filter-container {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 20px;
}

.filter-container select {
  padding: 5px;
  font-size: 14px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

/* 投稿リスト */
.post-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* 投稿カード */
.post-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: white;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.post-image {
  width: 50px;
  height: 50px;
  border-radius: 5px;
  object-fit: cover;
}

.post-info {
  flex-grow: 1;
  padding-left: 15px;
}

.post-info h3 {
  margin: 0;
  font-size: 16px;
}

.post-date {
  font-size: 14px;
  color: gray;
}

/* ボタン */
.post-actions {
  display: flex;
  gap: 10px;
}

.edit-btn{
  background-color: #88B04B;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
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

<script setup>
import { ref, computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import PostCard from '@/Components/PostCard.vue';

const posts = computed(() => usePage().props.posts);

const sortOption = ref('newest');
const sortedPosts = computed(() => {
  return [...posts.value].sort((a, b) => {
    return sortOption.value === 'newest'
      ? new Date(b.created_at) - new Date(a.created_at)
      : new Date(a.created_at) - new Date(b.created_at);
  });
});

const editPost = (id) => {
  router.get(route('posts.show', id));
};

const deletePost = (id) => {
  if (confirm('Are you sure you want to remove this post?')) {
    router.delete(route('posts.destroy', id));
  }
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

      <PostCard v-for="post in sortedPosts" :key="post.id" :post="post">
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-outline-primary" @click="editPost(post)">Edit</button>
          <button class="delete-btn" @click="deletePost(post.post_id)">Delete</button>
        </div>
      </PostCard>
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
</style>

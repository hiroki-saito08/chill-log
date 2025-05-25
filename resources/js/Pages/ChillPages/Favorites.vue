<script setup>
import { computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import PostCard from '@/Components/PostCard.vue';
import Pagination from '@/Components/Pagination.vue';

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

    <div v-if="favorites.data.length === 0">
      No Posts
    </div>
    <div v-else>
      <PostCard v-for="favorite in favorites.data" :key="favorite.id" :post="favorite.post">
        <div class="d-flex gap-2">
          <button class="delete-btn" @click="deletePost(favorite.post_id)">Delete</button>
        </div>
      </PostCard>

      <!-- ページネーション -->
      <Pagination
        :links="favorites.links"
        routeName="mypage"
        :extraParams="{ section: 'favorite-section' }"
      />
    </div>
  </section>
</template>

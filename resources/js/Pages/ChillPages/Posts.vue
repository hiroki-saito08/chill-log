<script setup>
import { Link } from '@inertiajs/vue3'
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'

defineProps({
  posts: Object
})
function formatPaginationLabel(label) {
  console.log(label)
  if (label === 'pagination.previous') {
    return '«'; // ← 左矢印
  } else if (label === 'pagination.next') {
    return '»'; // → 右矢印
  }
  return label;
}
</script>

<template>
  <div>
    <Header />

    <div class="container">
      <div v-if="posts.data.length">
        <div v-for="post in posts.data" :key="post.id" class="post-card">
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

        <!-- ページネーション -->
        <div class="pagination-wrapper">
          <ul class="pagination">
            <li
              v-for="link in posts.links"
              :key="link.label"
              :class="['page-item', { active: link.active, disabled: !link.url }]"
            >
              <Link
                v-if="link.url"
                :href="link.url"
                class="page-link"
                v-html="formatPaginationLabel(link.label)"
              />
              <span v-else class="page-link" v-html="formatPaginationLabel(link.label)"></span>
            </li>
          </ul>
        </div>
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
  padding: 0 20px;
}

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

.pagination-wrapper {
  display: flex;
  justify-content: center;
  margin-top: 40px;
}

.pagination .page-item {
  display: inline-block;
  margin: 0 5px;
}

.pagination .page-link {
  background: #6C7A89; /* サブカラー */
  color: white;
  padding: 8px 12px;
  border-radius: 5px;
  text-decoration: none;
  transition: background 0.3s;
  font-weight: bold;
}

.pagination .page-item.active .page-link {
  background: #88B04B; /* メインカラー */
}

.pagination .page-link:hover {
  background: #88B04B;
}

.pagination .page-item.disabled .page-link {
  background: #ccc;
  cursor: not-allowed;
}

.no-posts {
  text-align: center;
  margin-top: 80px;
  color: #6C7A89;
  font-size: 18px;
}

</style>

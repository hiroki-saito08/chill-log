<script setup>
import { Link } from '@inertiajs/vue3'
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import PostCard from '@/Components/PostCard.vue';

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

        <PostCard v-for="post in posts.data" :key="post.id" :post="post" />

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
  padding: 20px;
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

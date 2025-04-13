<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const post = computed(() => usePage().props.post);
const isFavorite = ref(false);
const isReviewModalOpen = ref(false);

const toggleFavorite = () => {
  isFavorite.value = !isFavorite.value;
};

const openReviewModal = () => {
  isReviewModalOpen.value = true;
};

const closeReviewModal = () => {
  isReviewModalOpen.value = false;
};

const submitReview = () => {
  console.log("レビューを投稿しました");
  closeReviewModal();
};
</script>

<template>
  <Header />

  <div class="container">
    <div class="spot-image">
      <img :src="post.image" alt="Spot Image" class="spot-image">
    </div>
    <h2 class="spot-title">🌿 {{ post.title }}</h2>
    <p class="spot-details">📍 {{ post.address }}</p>
    <p class="spot-details">📌 {{ post.category }}</p>
    <p class="spot-details">{{ post.description }}</p>

    <div class="map-container">
      Google Maps エリア
    </div>

    <div class="buttons">
      <button class="btn" @click="toggleFavorite">
        {{ isFavorite ? '⭐ お気に入り済み' : '⭐ お気に入りに追加' }}
      </button>
      <button class="btn">🔗 シェア</button>
    </div>

    <button class="btn btn-review" @click="openReviewModal">💬 レビューを投稿</button>

    <div v-if="isReviewModalOpen" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeReviewModal">&times;</span>
        <h3>レビューを投稿</h3>
        <div class="form-group">
          <label>総合評価</label>
          <select>
            <option>⭐⭐⭐⭐⭐</option>
            <option>⭐⭐⭐⭐</option>
            <option>⭐⭐⭐</option>
            <option>⭐⭐</option>
            <option>⭐</option>
          </select>
        </div>
        <div class="form-group">
          <label>レビュー内容</label>
          <textarea placeholder="レビューを入力..."></textarea>
        </div>
        <button class="btn" @click="submitReview">投稿</button>
      </div>
    </div>

    <div class="review-section">
      <h3>レビュー一覧</h3>
      <p class="review-summary">総合評価: ⭐⭐⭐⭐☆ (4.2)</p>
      <div v-for="review in post.reviews" :key="review.id" class="review">
        <div class="review-header">
          {{ review.rating }} ⭐ {{ review.user }} - {{ review.date }}
        </div>
        <p>{{ review.comment }}</p>
      </div>
    </div>

    <router-link :to="'/'" class="back-button">⬅️ 前のページに戻る</router-link>
  </div>

  <Footer />
</template>

<style scoped>
/* レイアウト */
.container {
  width: 80%;
  max-width: 1000px;
  margin: 60px auto;
  background: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

/* 画像エリア */
.spot-image {
  width: 100%;
  height: 250px;
  border-radius: 10px;
  text-align: center;
  object-fit: cover;
}

/* タイトル・詳細 */
.spot-title {
  font-size: 24px;
  font-weight: bold;
  margin-top: 20px;
}

.spot-details {
  font-size: 16px;
  margin-top: 10px;
}

/* マップエリア */
.map-container {
  width: 100%;
  height: 300px;
  background: #ddd;
  border-radius: 10px;
  text-align: center;
  line-height: 300px;
  font-size: 18px;
  color: #666;
  margin-top: 20px;
}

/* ボタン */
.buttons {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 20px;
}

.btn {
  background: #88B04B;
  color: white;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
}

.btn:hover {
  background: #76A03A;
}

/* モーダル */
.modal {
  display: flex;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.4);
  align-items: center;
  justify-content: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  width: 50%;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.close {
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

/* レビュー */
.review-section {
  margin-top: 40px;
}

.review {
  background: #f9f9f9;
  padding: 15px;
  margin-top: 10px;
  border-radius: 10px;
  line-height: 1.6;
}

.review-header {
  font-weight: bold;
  margin-bottom: 5px;
}

/* 戻るボタン */
.back-button {
  display: block;
  margin: 30px auto;
  text-align: center;
  background: #ccc;
  color: #333;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  text-decoration: none;
}
</style>

<script setup>
import { computed, ref } from 'vue';
import { router, usePage, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import ShareMenu from '@/Components/ShareMenu.vue';

const post = computed(() => usePage().props.post);

// お気に入り
const isFavorited = computed(() => post.value.is_favorited);
const toggleFavorite = () => {
  console.log(post.value.id)
  if (isFavorited.value) {
    router.delete(route('favorite.destroy', post.value.id));
  } else {
    router.post(route('favorite.store', post.value.id));
  }
};

// レビュー
const isReviewed = computed(() => post.value.my_review !== null);
const showReviewForm = ref(false);
const toggleReviewForm = () => {
  showReviewForm.value = !showReviewForm.value;
};

const reviewForm = useForm({
  post_id: post.value.id,
  rating_overall: post.value.my_review?.rating_overall || 5,
  rating_silence: post.value.my_review?.rating_silence || 5,
  rating_safety: post.value.my_review?.rating_safety || 5,
  rating_relax: post.value.my_review?.rating_relax || 5,
  comment: post.value.my_review?.comment || ''
});

const submitReview = () => {
  if (isReviewed.value) {
    reviewForm.put(route('reviews.update', post.value.my_review.id), {
      onSuccess: () => {
        toggleReviewForm();
      },
      onError: (errors) => {
        console.error('Validation failed:', errors);
      }
    });
  } else {
    reviewForm.post(route('reviews.store'), {
      onSuccess: () => {
        toggleReviewForm();
        reviewForm.reset();
      },
      onError: (errors) => {
        console.error('Validation failed:', errors);
      }
    });
  }
};

// 総合レビュー計算
const averageRatings = computed(() => {
  const reviews = post.value.reviews;
  if (!reviews.length) return null;

  const avg = (key) =>
    reviews.reduce((sum, r) => sum + r[key], 0) / reviews.length;

  return {
    overall: avg('rating_overall'),
    relax: avg('rating_relax'),
    safety: avg('rating_safety'),
    silence: avg('rating_silence'),
  };
});

// 評価を星に変換
const stars = (score) => {
  const full = Math.floor(score);
  const half = score % 1 >= 0.5 ? 1 : 0;
  return '⭐'.repeat(full) + (half ? '☆' : '');
};

const formatDate = (dateStr) => {
  const date = new Date(dateStr);
  return date.toLocaleDateString();
};

</script>

<template>
  <Header />

  <div class="container">
    <div class="section">
      <div class="spot-header">
        <h2>{{ post.title }}</h2>
        <div class="category">{{ post.category }}</div>
      </div>
      <div class="image-area">Image Placeholder</div>
      <div class="spot-meta">
        Address: {{ post.address }} ・ Best time: {{ post.visit_time }}
      </div>
      <p class="description">
        {{ post.description }}
      </p>
      <div class="map-area">Map Placeholder</div>
      <div class="buttons">
        <button class="btn" @click="toggleFavorite">
          {{ isFavorited ? '★' : '☆' }}
        </button>

        <ShareMenu />
      </div>
      <div class="review-button-wrapper">
        <button class="btn" @click="toggleReviewForm">
          {{ isReviewed ? 'Edit Review' : 'Leave a Review' }}
        </button>
      </div>
    </div>

    <div class="section review-section">
      <h3>Reviews</h3>
      <p v-if="!post.reviews.length">No reviews yet.</p>

      <p class="review-summary" v-else-if="averageRatings">
        Overall: {{ stars(averageRatings.overall) }} ({{ averageRatings.overall.toFixed(1) }}) 【
        Relax: {{ stars(averageRatings.relax) }} ・
        Safety: {{ stars(averageRatings.safety) }} ・
        Silence: {{ stars(averageRatings.silence) }} 】
      </p>

      <div class="review" v-for="review in post.reviews" :key="review.id">
        <div class="review-header"> {{ review.user.name }} - {{ formatDate(review.created_at) }}</div>
        <p>Overall {{ stars(review.rating_overall) }} 【 Relax: {{ stars(review.rating_relax) }} ・ Safety: {{ stars(review.rating_safety) }} ・ Silence: {{ stars(review.rating_silence) }} 】 </p>
        <p class="review-text">{{ review.comment }}</p>
      </div>

      <div class="review-form" v-show="showReviewForm" id="reviewForm">
        <div class="form-group" v-for="field in ['rating_overall', 'rating_relax', 'rating_safety', 'rating_silence']" :key="field">
          <label>{{ field.replace('rating_', '').charAt(0).toUpperCase() + field.replace('rating_', '').slice(1) }}</label>
          <select v-model="reviewForm[field]">
            <option :value="5">⭐⭐⭐⭐⭐</option>
            <option :value="4">⭐⭐⭐⭐</option>
            <option :value="3">⭐⭐⭐</option>
            <option :value="2">⭐⭐</option>
            <option :value="1">⭐</option>
          </select>
        </div>
        <div class="form-group">
          <label>Comment</label>
          <textarea v-model="reviewForm.comment" rows="4" placeholder="Write your review...(max 500 characters)"></textarea>
        </div>
        <p>{{ reviewForm.comment.length }} / 500 characters</p>

        <button class="btn" @click="submitReview">Submit</button>
        <p v-if="reviewForm.errors.comment" class="text-danger">
          {{ reviewForm.errors.comment }}
        </p>
      </div>
    </div>
  </div>

  <Footer />
</template>

<style scoped>
.container {
  max-width: 1000px;
  margin: 0 auto;
  margin-top: 40px;
  margin-bottom: 40px;
  background: white;
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.section {
  background: #f4f4f4;
  padding: 30px;
  border-left: 10px solid #88B04B;
  border-radius: 10px;
  margin-bottom: 40px;
}

.spot-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.spot-header h2 {
  margin: 0;
  color: #333;
}

.category {
  background: #88B04B;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 14px;
}

.spot-meta {
  margin: 10px 0;
  color: #555;
  font-style: italic;
}

.image-area {
  height: 250px;
  background: #ddd;
  border-radius: 10px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #666;
}

.map-area {
  height: 250px;
  background: #bbb;
  border-radius: 10px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #444;
}

.description {
  margin: 10px 0 20px;
  color: #333;
  line-height: 1.6;
}

.buttons {
  display: flex;
  gap: 10px;
  justify-content: flex-end;
  margin-top: 20px;
  flex-wrap: wrap;
}

.review-button-wrapper {
  display: flex;
  justify-content: flex-end;
  margin-top: 10px;
}

.btn {
  background-color: #88B04B;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
}

.review-section {
  margin-top: 40px;
}

.review-summary {
  margin-top: 10px;
  font-size: 16px;
  color: #333;
}

.review {
  background: #fff;
  padding: 15px;
  margin-top: 10px;
  border-radius: 10px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
  line-height: 1.6;
}

.review-text {
  word-wrap: break-word;
  overflow-wrap: break-word;
  white-space: pre-wrap;
}

.review-header {
  font-weight: bold;
  margin-bottom: 5px;
}

.review-form {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group select,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
}
</style>

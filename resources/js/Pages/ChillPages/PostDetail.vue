<script setup>
import { computed, ref } from 'vue';
import { router, usePage, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import ShareMenu from '@/Components/ShareMenu.vue';
import Toast from '@/Components/Toast.vue'

const post = computed(() => usePage().props.post);
const user = usePage().props.auth.user
const toast = ref(null)

// 編集
const showEditModal = ref(false);
function openEditModal() {
  editForm.title = post.value.title
  editForm.category = post.value.category
  editForm.location_name = post.value.location_name
  editForm.latitude = post.value.latitude
  editForm.longitude = post.value.longitude
  editForm.description = post.value.description
  editForm.visit_time = post.value.visit_time
  showEditModal.value = true
}

const editForm = useForm({
  title: '',
  category: '',
  location_name: '',
  latitude: '',
  longitude: '',
  description: '',
  visit_time: '',
  status: 'public',
  images: [],
})
const handleFileUpload = (e) => {
  if (e.target.files.length) {
    editForm.images = Array.from(e.target.files);
  } else {
    editForm.images = [];
  }
};

function closeEditModal() {
  showEditModal.value = false
  editForm.reset()
}
function submitEdit() {
  console.log(editForm)
  editForm.post(route('posts.update', post.value.id), {
    forceFormData: true,
    onSuccess: () => {
      showEditModal.value = false
      location.reload();
    },
    onError: (errors) => {
      toast.value.triggerToast(errors, 'error');
    },
  })
}

// お気に入り
const isFavorited = computed(() => post.value.is_favorited);
const toggleFavorite = () => {
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
  <Toast ref="toast" />

  <Header />

  <div class="container">
    <div class="section">
      <div class="spot-header">
        <h2>{{ post.title }}</h2>
        <div class="category">{{ post.category }}</div>
      </div>

      <div class="mb-4">
        <div
          v-for="image in post.images"
          :key="image.id"
          class="mb-3"
        >
          <img
            :src="`/storage/${image.image_path}`"
            alt="Post Image"
            class="img-fluid w-100 rounded"
          />
        </div>
      </div>

      <div class="spot-meta">
        <p>
          <span class="fw-bold">・ Address:</span> {{ post.location_name }}
        </p>
        <p>
          <span class="fw-bold"> ・ Best time:</span> {{ post.visit_time }}
        </p>
        <p>
          <span class="fw-bold"> ・ description:</span> {{ post.description }}
        </p>
      </div>
      <!-- <div class="map-area">Map Placeholder</div> -->
      <div class="buttons">
        <button class="btn" @click="toggleFavorite">
          {{ isFavorited ? '★' : '☆' }}
        </button>

        <ShareMenu />
      </div>

      <!-- 編集ボタン（本人だけ見える） -->
      <div v-if="user && user.id === post.user_id" class="text-end mt-3">
        <button class="btn" @click="openEditModal()">
          Edit
        </button>
      </div>
      <div v-else class="review-button-wrapper">
        <button class="btn" @click="toggleReviewForm">
          {{ isReviewed ? 'Edit Review' : 'Leave a Review' }}
        </button>
      </div>
    </div>

    <!-- 編集モーダル -->
    <div v-if="showEditModal" class="modal-backdrop-custom">
      <div class="modal d-block" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Post</h5>
              <button type="button" class="btn-close" @click="closeEditModal"></button>
            </div>
            <div class="modal-body">

              <div class="form-container">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" id="title" v-model="editForm.title" placeholder="e.g., Quiet Park">
                </div>

                <div class="form-group">
                  <label for="category">Category</label>
                  <select id="category" v-model="editForm.category">
                    <option value="cafe">Cafe</option>
                    <option value="park">Park</option>
                    <option value="beach">Beach</option>
                    <option value="Sauna">Sauna</option>
                    <option value="other">Other</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="location_name">Location (Address)</label>
                  <div class="address-container">
                    <input type="text" id="location_name" v-model="editForm.location_name" placeholder="e.g., Shibuya, Tokyo">
                    <button class="map-button" @click="openMap()">Select from Map</button>
                  </div>
                </div>

                <div class="form-group">
                  <label for="visit-time">Recommended Visit Time</label>
                  <select id="visit-time" v-model="editForm.visit_time">
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                    <option value="night">Night</option>
                    <option value="anytime">Anytime</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea id="description" v-model="editForm.description" placeholder="Describe the charm of this spot"></textarea>
                </div>

                <div class="form-group">
                  <label for="image-upload">Image Upload (Max:2MB)</label>
                  <input type="file" id="image-upload" @change="handleFileUpload">
                </div>
                <div class="buttons mt-4">
                  <button type="button" class="btn cancel-btn" @click="closeEditModal">Cancel</button>
                  <button class="btn" @click="submitEdit">Save Changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- レビューセクション -->
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

      <!-- レビューフォーム -->
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

/* モーダルの背景 */
.modal-backdrop-custom {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050;
}

.modal-content {
  padding: 2rem;
}

.form-container {
  margin-top: 20px;
  background: #f9f9f9;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-weight: bold;
  margin-bottom: 8px;
}

.form-group input,
.form-group textarea,
.form-group select {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.map-button {
  margin-top: 10px;
  padding: 8px 15px;
  background: #6C7A89;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: block;
  width: 100%;
  text-align: center;
}

.btn-success {
  background: #88B04B;
  color: white;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: block;
  width: 100%;
  text-align: center;
  margin-top: 20px;
}

.btn-success:hover {
  background: #76A03A;
}
</style>

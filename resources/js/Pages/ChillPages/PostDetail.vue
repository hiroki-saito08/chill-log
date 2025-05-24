<script setup>
import { computed, ref } from 'vue';
import { Link, router, usePage, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import ShareMenu from '@/Components/ShareMenu.vue';
import Toast from '@/Components/Toast.vue'

const post = computed(() => usePage().props.post);
const props = defineProps({
  previous: Object,
  next: Object,
});

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
        toast.value.triggerToast('Review updated successfully');
      },
      onError: (errors) => {
        toast.value.triggerToast(errors, 'error');
      }
    });
  } else {
    reviewForm.post(route('reviews.store'), {
      onSuccess: () => {
        toggleReviewForm();
        reviewForm.reset();
        toast.value.triggerToast('Review stored successfully');
      },
      onError: (errors) => {
        toast.value.triggerToast(errors, 'error');
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
  <!-- SEO -->
  <Head>
    <title>{{ post.title }} | Chill-log</title>
    <meta name="description" :content="post.description.slice(0, 100)" />
    <meta property="og:title" :content="post.title" />
    <meta property="og:description" :content="post.description.slice(0, 100)" />
    <meta property="og:image" :content="`/storage/${post.images[0]?.image_path}`" />
    <meta property="og:type" content="article" />
    <meta property="og:url" :content="`https://chill-log.com/posts/${post.id}`" />
  </Head>

  <Toast ref="toast" />

  <Header />

  <div class="post-detail">
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
              class="post-image img-fluid w-100 rounded"
              @error="(e) => e.target.src = '/images/default.jpg'"
            />
          </div>
        </div>

        <!-- 投稿者プロフィールセクション -->
        <div class="d-flex align-items-center gap-3 mb-4">
          <Link :href="route('users.show', post.user.id)">
            <img
              :src="post.user.profile_image ? `/storage/${post.user.profile_image}` : '/images/default.jpg'"
              @error="(e) => e.target.src = '/images/default.jpg'"
              alt="Profile image"
              class="rounded-circle"
              style="width: 60px; height: 60px; object-fit: cover;"
            />
          </Link>

          <div>
            <Link :href="route('users.show', post.user.id)" class="fw-bold text-decoration-none text-dark">
              {{ post.user.name }}
            </Link>
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

        <!-- 平均評価 -->
        <p v-if="!post.reviews.length" class="text-muted">No reviews yet.</p>

        <div v-else-if="averageRatings" class="rating-summary-card">
          <div class="overall-rating">
            <div class="label">Overall</div>

            <div class="stars">
              {{ stars(averageRatings.overall) }}
            </div>
            <div class="score">
              {{ averageRatings.overall.toFixed(1) }}
            </div>
          </div>

          <ul class="sub-ratings">
            <li><strong>Relax</strong>: {{ stars(averageRatings.relax) }}</li>
            <li><strong>Safety</strong>: {{ stars(averageRatings.safety) }}</li>
            <li><strong>Silence</strong>: {{ stars(averageRatings.silence) }}</li>
          </ul>
        </div>

        <!-- レビューフォーム -->
        <div class="review-form" v-show="showReviewForm" id="reviewForm">
          <div class="form-group" v-for="field in ['rating_relax', 'rating_safety', 'rating_silence']" :key="field">
            <label>
              {{ field.replace('rating_', '').charAt(0).toUpperCase() + field.replace('rating_', '').slice(1) }}
            </label>
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

        <!-- 各レビュー -->
        <div
          class="review-box"
          v-for="review in post.reviews"
          :key="review.id"
        >
          <div class="review-header">
            <!-- 投稿者プロフィールセクション -->
            <div class="d-flex align-items-center gap-3 mb-4">
              <Link :href="route('users.show', review.user.id)">
                <img
                  :src="review.user.profile_image ? `/storage/${review.user.profile_image}` : '/images/default.jpg'"
                  @error="(e) => e.target.src = '/images/default.jpg'"
                  alt="Profile image"
                  class="rounded-circle"
                  style="width: 60px; height: 60px; object-fit: cover;"
                />
              </Link>

              <div>
                <Link :href="route('users.show', review.user.id)" class="fw-bold text-decoration-none text-dark">
                  {{ review.user.name }}
                </Link>
              </div>
            </div>
            <p>{{ formatDate(review.created_at) }}</p>
          </div>
          <ul class="review-scores">
            <li>Overall: {{ stars(review.rating_overall) }}</li>
            <li>Relax: {{ stars(review.rating_relax) }}</li>
            <li>Safety: {{ stars(review.rating_safety) }}</li>
            <li>Silence: {{ stars(review.rating_silence) }}</li>
          </ul>
          <p class="review-text">{{ review.comment }}</p>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-5">
        <div v-if="previous">
          <Link :href="route('posts.show', previous.id)" class="btn btn-outline-secondary">
            ← Previous
          </Link>
        </div>
        <div v-if="next">
          <Link :href="route('posts.show', next.id)" class="btn btn-outline-secondary ms-auto">
            Next →
          </Link>
        </div>
      </div>
    </div>
  </div>

  <Footer />
</template>

<style scoped>
.post-detail .container {
  padding: 40px;
  margin-top: 40px;
  margin-bottom: 40px;
}

.post-detail .section {
  background: #f4f4f4;
  padding: 30px;
  border-left: 10px solid #88B04B;
  border-radius: 10px;
  margin-bottom: 40px;
}

.post-detail .post-image {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
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

/* レビューセクション */
.review-button-wrapper {
  display: flex;
  justify-content: flex-end;
  margin-top: 10px;
}

.rating-summary-card {
  background: #f8f9fa;
  border: 2px solid #88B04B;
  border-radius: 12px;
  padding: 20px;
  margin: 30px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.overall-rating {
  margin-bottom: 10px;
}

.overall-rating .stars {
  font-size: 24px;
  color: #FFC107;
}

.overall-rating .score {
  font-size: 28px;
  font-weight: bold;
  color: #333;
}

.overall-rating .label {
  font-size: 16px;
  color: #88B04B;
  font-weight: 600;
}

.sub-ratings {
  list-style: none;
  padding-left: 0;
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
  font-size: 14px;
  color: #666;
}

.review-box {
  background: #fff;
  padding: 20px 30px 20px 30px;
  margin-top: 20px;
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
  max-height: 90vh;
  overflow-y: auto;
  max-width: 800px;
  padding: 2rem;
  margin: 0 auto;
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

.btn-outline-secondary {
  font-weight: bold;
  padding: 8px 16px;
  border-radius: 8px;
}

@media (max-width: 768px) {
  .post-detail .container {
    padding: 15px;
    margin-top: 0;
    margin-bottom: 0;
  }

  .post-detail .section {
    background: none;
    padding: 0;
    border-left: none;
    border-radius: 0;
    margin-bottom: 0;
  }

  .review-section {
    margin-top: 40px;
    background: #f4f4f4;
  }

  /* モーダル */
  .modal-content {
    width: 90%;
    padding: 10px;
  }

  .form-container {
    background: none;
    padding: 0px;
    border-radius: 0;
    box-shadow: none;
  }
}
</style>

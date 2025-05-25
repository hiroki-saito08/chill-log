<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
import Toast from '@/Components/Toast.vue'

const props = defineProps({
  categories: Array
});

const toast = ref(null)
const newPost = useForm({
  title: '',
  category: '',
  location_name: '',
  latitude: '',
  longitude: '',
  description: '',
  visit_time: [],
  status: 'public',
  images: [],
});

const handleFileUpload = (e) => {
  if (e.target.files.length) {
    newPost.images = Array.from(e.target.files);
  } else {
    newPost.images = [];
  }
};

const submitPost = () => {
  console.log(newPost)
  newPost.post('/posts', {
    forceFormData: true,
    onSuccess: () => {
      console.log('Post store successfully');
      newPost.reset();
    },
    onError: (errors) => {
      toast.value.triggerToast(errors, 'error');
    },
  });
};
</script>

<template>
  <Toast ref="toast" />

  <section id="new-post-section" class="section">
    <h2>Add a New Spot</h2>

    <div class="form-container">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" v-model="newPost.title" placeholder="e.g., Quiet Park">
      </div>

      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" v-model="newPost.category">
          <option v-for="option in categories" :key="option" :value="option">
            {{ option }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="location_name">Location (Address)</label>
        <div class="address-container">
          <input type="text" id="location_name" v-model="newPost.location_name" placeholder="e.g., Shibuya, Tokyo">
          <!-- <button class="map-button" @click="openMap()">Select from Map</button> -->
        </div>
      </div>

      <div class="form-group">
        <label class="form-label mb-2">Recommended Visit Time</label>
        <div class="d-flex flex-wrap gap-2">
          <div
            v-for="option in ['morning', 'afternoon', 'evening', 'night', 'anytime']"
            :key="option"
            class="form-check-inline"
          >
            <input
              class="btn-check"
              type="checkbox"
              :value="option"
              v-model="newPost.visit_time"
              :id="`time-${option}`"
              autocomplete="off"
            />
            <label
              class="btn btn-outline-secondary"
              :class="{ active: newPost.visit_time.includes(option) }"
              :for="`time-${option}`"
            >
              {{ option }}
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" v-model="newPost.description" placeholder="Describe the charm of this spot"></textarea>
      </div>

      <div class="form-group">
        <label for="image-upload">Image Upload (Max:2MB)</label>
        <input type="file" id="image-upload" @change="handleFileUpload">
      </div>

      <button class="btn btn-success" @click="submitPost">Submit</button>
    </div>
  </section>
</template>

<style scoped>
/* New Post スタイル */
#new-post-section {
  text-align: left;
  max-width: 600px;
  margin: 0 auto;
  overflow-x: hidden;
}

.form-container {
  margin-top: 20px;
  background: #f9f9f9;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  max-width: 800px;
}

.form-group {
  margin-bottom: 20px;

}

.form-group label {
  display: block;
  font-weight: bold;
  margin-bottom: 8px;
}

.form-group textarea,
.form-group select {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.form-group input {
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

@media (max-width: 768px) {
  .section {
    background: none;
    padding: 0;
    border-left: none;
  }

  .form-container {
    background: #f9f9f9;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
}

</style>

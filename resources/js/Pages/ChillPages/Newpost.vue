<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
import Toast from '@/Components/Toast.vue'

const toast = ref(null)
const newPost = useForm({
  title: '',
  category: '',
  location_name: '',
  latitude: '',
  longitude: '',
  description: '',
  visit_time: '',
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
          <input type="text" id="location_name" v-model="newPost.location_name" placeholder="e.g., Shibuya, Tokyo">
          <!-- <button class="map-button" @click="openMap()">Select from Map</button> -->
        </div>
      </div>

      <div class="form-group">
        <label for="visit-time">Recommended Visit Time</label>
        <select id="visit-time" v-model="newPost.visit_time">
          <option value="morning">Morning</option>
          <option value="afternoon">Afternoon</option>
          <option value="evening">Evening</option>
          <option value="night">Night</option>
          <option value="anytime">Anytime</option>
        </select>
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

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const newPost = ref({
  name: '',
  category: 'Café',
  location: '',
  visitTime: 'Morning',
  description: '',
  image: null
});

const handleFileUpload = (event) => {
  newPost.value.image = event.target.files[0];
};

const submitPost = () => {
  router.post('/posts', {
    title: newPost.value.name,
    category: newPost.value.category,
    description: newPost.value.description,
    visit_time: newPost.value.visitTime.toLowerCase(),
    status: 'public',
    latitude: null,
    longitude: null,
    image: newPost.value.image,
  }, {
    onSuccess: () => {
      alert('投稿が完了しました！');
    },
    onError: (errors) => {
      console.log(errors);
    }
  });
};
</script>

<template>
  <section id="new-post-section" class="section">
    <h2>Add a New Spot</h2>

    <div class="form-container">
      <div class="form-group">
        <label for="spot-name">Spot Name</label>
        <input type="text" id="spot-name" v-model="newPost.name" placeholder="e.g., Quiet Park">
      </div>

      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" v-model="newPost.category">
          <option>Café</option>
          <option>Park</option>
          <option>Beach</option>
          <option>Sauna</option>
          <option>Other</option>
        </select>
      </div>

      <div class="form-group">
        <label for="location">Location (Address)</label>
        <div class="address-container">
          <input type="text" id="location" v-model="newPost.location" placeholder="e.g., Shibuya, Tokyo">
          <button class="map-button" @click="openMap()">Select from Map</button>
        </div>
      </div>

      <div class="form-group">
        <label for="visit-time">Recommended Visit Time</label>
        <select id="visit-time" v-model="newPost.visitTime">
          <option>Morning</option>
          <option>Afternoon</option>
          <option>Evening</option>
          <option>Night</option>
        </select>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" v-model="newPost.description" placeholder="Describe the charm of this spot"></textarea>
      </div>

      <div class="form-group">
        <label for="image-upload">Image Upload</label>
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
</style>

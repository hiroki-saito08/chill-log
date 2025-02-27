<script setup>
import { ref } from 'vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import Myposts from '@/Pages/ChillPages/Myposts.vue';
import Favorites from '@/Pages/ChillPages/Favorites.vue';

const activeSection = ref('profile-section');

const navigate = (section) => {
  activeSection.value = section;
};
</script>

<template>
  <Header />
  <div class="main-container">

    <!-- サイドバー -->
    <nav class="sidebar">
      <a @click="navigate('profile-section')">Profile</a>
      <a @click="navigate('new-post-section')">New post</a>
      <a @click="navigate('my-posts-section')">My posts</a>
      <a @click="navigate('favorite-section')">Favorite</a>
    </nav>

    <!-- メインコンテンツ -->
    <main class="content">
      <section v-if="activeSection === 'profile-section'" id="profile-section">
        <h2>Account Settings</h2>
        <div class="profile-pic"></div>

        <div class="form-group">
          <label>Name</label>
          <input type="text" placeholder="John Doe">
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" placeholder="user@example.com">
        </div>

        <div class="form-group">
          <label>Bio</label>
          <textarea placeholder="Describe yourself"></textarea>
        </div>

        <button class="edit-password-btn">Edit Password</button>
      </section>

      <section v-if="activeSection === 'new-post-section'" id="new-post-section">
        <h2>Add a New Spot</h2>
        <div class="form-group">
          <label>Spot Name</label>
          <input type="text" placeholder="e.g., Quiet Park">
        </div>
        <div class="form-group">
          <label>Category</label>
          <select>
            <option>Café</option>
            <option>Park</option>
            <option>Beach</option>
            <option>Sauna</option>
            <option>Other</option>
          </select>
        </div>
        <button class="btn">Submit</button>
      </section>

      <!-- 既存の `Myposts.vue` と `Favorites.vue` を正しいパスで使用 -->
      <Myposts v-if="activeSection === 'my-posts-section'" />
      <Favorites v-if="activeSection === 'favorite-section'" />
    </main>

  </div>
  <Footer />
</template>

<style scoped>
.main-container {
  display: flex;
  width: 100%;
  min-height: 100vh;
}

.sidebar {
  width: 240px;
  background-color: #88B04B;
  color: white;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.sidebar a {
  color: white;
  text-decoration: none;
  padding: 12px;
  border-radius: 5px;
  transition: background 0.3s;
  cursor: pointer;
}

.sidebar a:hover {
  background: #57636f;
}

.content {
  flex-grow: 1;
  background: white;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}
</style>

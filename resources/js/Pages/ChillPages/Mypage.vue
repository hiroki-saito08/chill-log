<script setup>
import { ref } from 'vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import Profile from '@/Pages/ChillPages/Profile.vue';
import Newpost from '@/Pages/ChillPages/Newpost.vue';
import Myposts from '@/Pages/ChillPages/Myposts.vue';
import Favorites from '@/Pages/ChillPages/Favorites.vue';

const activeSection = ref('profile-section');

const navigate = (section) => {
  activeSection.value = section;
};
</script>

<template>
  <div class="mypage-main-container">
    <Header />

    <div class="mypage-content-container">
      <nav class="mypage-sidebar">
        <a @click="navigate('profile-section')" :class="{ active: activeSection === 'profile-section' }">Profile</a>
        <a @click="navigate('new-post-section')" :class="{ active: activeSection === 'new-post-section' }">New post</a>
        <a @click="navigate('my-posts-section')" :class="{ active: activeSection === 'my-posts-section' }">My posts</a>
        <a @click="navigate('favorite-section')" :class="{ active: activeSection === 'favorite-section' }">Favorite</a>
      </nav>

      <main class="mypage-content">
        <Profile v-if="activeSection === 'profile-section'" />
        <Newpost v-if="activeSection === 'new-post-section'" />
        <Myposts v-if="activeSection === 'my-posts-section'" />
        <Favorites v-if="activeSection === 'favorite-section'" />
      </main>
    </div>

    <Footer />
  </div>
</template>

<style scoped>
/* レイアウト全体を調整 */
.mypage-main-container {
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height: 100vh;
}

/* ヘッダーの影響を回避するための調整 */
.mypage-content-container {
  display: flex;
  flex-grow: 1;
}

/* サイドバーの調整 */
.mypage-sidebar {
  width: 200px;
  background-color: #88B04B;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.mypage-sidebar a {
  color: white;
  text-decoration: none;
  padding: 10px;
  border-radius: 5px;
  transition: background 0.3s;
  cursor: pointer;
}

.sidebar a.active {
  background: #6C7A89;
}

/* コンテンツエリアの調整 */
.mypage-content {
  flex-grow: 1;
  max-width: 800px; /* フォームが横幅いっぱいにならないように */
  margin: auto;
  margin-top: 50px;
  margin-bottom: 50px;
  padding: 30px;
  background: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}
</style>

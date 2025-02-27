<script setup>
import { ref } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import Myposts from '@/Pages/ChillPages/Myposts.vue';
import Favorites from '@/Pages/ChillPages/Favorites.vue';

// 初期状態
const currentSection = ref('profile');

// セクションを切り替える関数
const navigate = (section) => {
  currentSection.value = section;
};

const user = usePage().props.auth.user;
</script>

<template>
  <Head title="My Page" />

  <div class="mypage-container">
    <h1>My Page</h1>

    <!-- ナビゲーション -->
    <nav class="mypage-nav">
      <button @click="navigate('profile')" :class="{ active: currentSection === 'profile' }">Profile</button>
      <button @click="navigate('myposts')" :class="{ active: currentSection === 'myposts' }">My Posts</button>
      <button @click="navigate('favorites')" :class="{ active: currentSection === 'favorites' }">Favorites</button>
    </nav>

    <!-- プロフィールセクション -->
    <section v-if="currentSection === 'profile'">
      <h2>Profile</h2>
      <p>Name: {{ user.name }}</p>
      <p>Email: {{ user.email }}</p>
      <p>Bio: {{ user.bio || 'No bio yet' }}</p>
      <Link href="/edit-profile" class="btn">Edit Profile</Link>
    </section>

    <!-- 投稿リスト -->
    <Myposts v-if="currentSection === 'myposts'" />

    <!-- お気に入りリスト -->
    <Favorites v-if="currentSection === 'favorites'" />
  </div>
</template>

<style scoped>
.mypage-container {
  max-width: 800px;
  margin: auto;
  padding: 20px;
}

.mypage-nav {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.mypage-nav button {
  padding: 10px 15px;
  border: none;
  background: #f4f4f4;
  cursor: pointer;
}

.mypage-nav .active {
  background: #007bff;
  color: white;
}

.btn {
  display: inline-block;
  padding: 8px 12px;
  background: #28a745;
  color: white;
  border-radius: 5px;
  text-decoration: none;
}
</style>

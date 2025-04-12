<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';

const menuOpen = ref(false);
const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};

// `auth.user` を取得して、ログイン状態を判定
const auth = computed(() => usePage().props.auth);
console.log(auth.value.user);

const closeMenu = (event) => {
  if (!event.target.closest('.menu-toggle') && !event.target.closest('.user-menu')) {
    menuOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', closeMenu);
});

onUnmounted(() => {
  document.removeEventListener('click', closeMenu);
});
</script>

<template>
  <header class="custom-header text-white text-center position-relative">
    <Link :href="route('home')" class="text-white text-decoration-none fs-4">Chill-log</Link>
    <div class="menu-toggle" @click="toggleMenu">☰</div>

    <div v-show="menuOpen" class="user-menu">
      <template v-if="auth.user">
        <Link :href="route('home')" class="nav-link">Home</Link>
        <Link :href="route('mypage')" class="nav-link">Mypage</Link>
        <Link :href="route('logout')" method="post" class="nav-link logout-link">Logout</Link>
      </template>
      <template v-else>
        <Link :href="route('home')" class="nav-link">Home</Link>
        <Link :href="route('login')" class="nav-link">Login</Link>
      </template>
    </div>
  </header>
</template>

<style scoped>
.custom-header {
  background-color: #6C7A89 !important;
  padding: 15px 0;
  font-size: 1.5rem;
}

.menu-toggle {
  position: absolute;
  top: 15px;
  right: 20px;
  font-size: 24px;
  cursor: pointer;
}

.user-menu {
  position: absolute;
  top: 50px;
  right: 20px;
  background: white;
  color: #6C7A89;
  font-size: 16px;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  text-align: left;
}

.user-menu a {
  display: block;
  padding: 10px;
  text-decoration: none;
  color: #6C7A89;
  font-weight: bold;
  transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
}

.user-menu a:hover {
  background-color: #6C7A89;
  color: white;
  border-radius: 5px;
}

.logout-link {
  display: block;
  padding: 10px;
  text-decoration: none;
  color: #6C7A89;
  font-weight: bold;
  background: none;
  border: none;
  text-align: left;
}

.logout-link:hover {
  background-color: #6C7A89;
  color: white;
  border-radius: 5px;
}
</style>

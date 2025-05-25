<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <footer class="footer-container text-white">
    <div class="footer-content">
      <a :href="route('home')" class="text-white text-decoration-none fs-4">Chill-log</a>
      <nav class="footer-nav">
        <Link :href="route('about')" class="footer-link">About</Link>
        <Link :href="route('contact')" class="footer-link">Contact</Link>
        <Link :href="route('privacy')" class="footer-link">Privacy Policy</Link>
      </nav>
    </div>
    <div class="footer-bottom text-center">
      &copy; 2025 Chill-log
    </div>
  </footer>
</template>

<style>
.footer-container {
  background-color: #6C7A89 !important;
  padding: 20px 0;
  font-size: 1rem;
}

.footer-content {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  max-width: 1000px;
  margin: 0 auto;
  padding: 0 20px;
}

.footer-title {
  font-size: 1.5rem;
  font-weight: bold;
}

.footer-nav {
  display: flex;
  gap: 20px;
}

.footer-link {
  color: white;
  text-decoration: none;
  font-weight: bold;
  transition: opacity 0.2s ease-in-out;
}

.footer-link:hover {
  opacity: 0.8;
}

.footer-bottom {
  font-size: 0.875rem;
  opacity: 0.7;
  margin-top: 10px;
}

@media (max-width: 768px) {
  .footer-content {
    flex-direction: column;
    align-items: center;
    gap: 15px;
  }

  .footer-nav {
    flex-direction: column;
    gap: 10px;
  }
}
</style>

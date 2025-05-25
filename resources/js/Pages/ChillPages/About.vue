<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="About" />
  <Header />

  <div class="container py-5">
    <h1 class="mb-4 text-center fw-bold">About Chill-log</h1>
    <p class="text-muted text-center">
      Chill-log is a web application that helps people discover and share relaxing places in their area,
      such as scenic locations, cozy cafes, or peaceful parks.<br /><br />
      This platform was created with the goal of promoting mental well-being through nature, comfort, and personal experiences.
    </p>
    <ul class="list-unstyled text-center mt-4">
      <li>Share your favorite spots with photos and comments</li>
      <li>Browse posts from other users</li>
      <li>Bookmark places you like</li>
      <li>Leave reviews to help others find the best places to relax</li>
    </ul>
  </div>

  <Footer />
</template>
<style>
.container {
  margin-top: 60px;
  margin-bottom: 60px;
}
@media (max-width: 768px) {
  .container {
    margin-top: 0;
    margin-bottom: 0;
  }
}
</style>

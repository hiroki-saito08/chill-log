<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Contact" />
  <Header />

  <div class="container py-5">
    <h1 class="mb-4 text-center fw-bold">Contact Us</h1>
    <p class="text-muted text-center">
      For general inquiries or feedback about Chill-log, please email us at:<br />
      <strong>support@chill-log.net</strong><br /><br />
      Chill-log is currently operated by an individual developer.<br />
      Replies may take 1–2 business days. Thank you for your understanding.
    </p>
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

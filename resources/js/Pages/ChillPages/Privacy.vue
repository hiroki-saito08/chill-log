<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Privacy Policy" />
  <Header />

  <div class="container py-5">
    <h1 class="mb-4 text-center fw-bold">Privacy Policy</h1>
    <div class="text-muted">
      <p><strong>Effective date:</strong> May 24, 2025</p>

      <p>Chill-log ("we", "our", or "us") respects your privacy and is committed to protecting your personal information.
        This Privacy Policy outlines what data we collect, how we use it, and your rights regarding that data.</p>

      <h5 class="mt-4">1. Information We Collect</h5>
      <ul>
        <li>Name, email address, profile image, bio</li>
        <li>IP address and access logs (for security purposes)</li>
      </ul>

      <h5 class="mt-4">2. How We Use Your Information</h5>
      <ul>
        <li>To create and manage user accounts</li>
        <li>To display your posts, profile, and reviews</li>
        <li>To communicate important updates</li>
        <li>To improve the platform based on usage data</li>
      </ul>

      <h5 class="mt-4">3. Cookies and Analytics</h5>
      <p>We use cookies and logs for session management and analytics. No third-party tracking is used.</p>

      <h5 class="mt-4">4. Data Storage and Security</h5>
      <p>All data is securely stored and accessible only by authorized personnel.</p>

      <h5 class="mt-4">5. Data Sharing</h5>
      <p>We do not sell or share your information unless required by law or with your explicit consent.</p>

      <h5 class="mt-4">6. Your Rights</h5>
      <p>You may request access, correction, or deletion of your personal data by contacting <strong>support@chill-log.net</strong>.<br />
        For security reasons, we may require verification of your identity through your registered account or additional confirmation before processing such requests.<br />
        Please note that we cannot guarantee responses to requests made from unregistered or unverified sources.
      </p>

      <h5 class="mt-4">7. Policy Changes</h5>
      <p>We may update this policy as needed. Users will be notified of significant changes.</p>
    </div>
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

<script setup>
import { computed } from 'vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ status: String });

const form = useForm({});
const submit = () => form.post(route('verification.send'));
const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
  <Head title="Verify Your Email" />

  <div>
    <Header />

    <div class="container my-5">
      <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm mx-auto" style="max-width: 600px;">
        <h2 class="fs-4 fw-bold text-center mb-3 text-secondary">Please Verify Your Email</h2>

        <p class="text-muted small text-center mb-4">
          Thanks for joining Chill-log! We've sent a verification link to your email address.
          Please check your inbox and click the link. If you didn’t receive it, you can resend below.
        </p>

        <div v-if="verificationLinkSent" class="alert alert-success text-center py-2">
          ✅ A new verification link has been sent!
        </div>

        <form @submit.prevent="submit" class="d-grid gap-3 mt-4">
          <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-100">
            Resend Verification Email
          </PrimaryButton>

          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="btn btn-outline-secondary w-100 text-sm"
          >
            Log Out
          </Link>
        </form>
      </div>
    </div>

    <Footer />
  </div>
</template>

<style scoped>
.alert-success {
  background-color: #e6f9e6;
  color: #307a30;
  border-radius: 0.5rem;
}
</style>

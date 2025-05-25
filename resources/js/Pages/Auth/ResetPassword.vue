<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';

const props = defineProps({
  email: String,
  token: String,
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('password.store'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <Head title="Reset Password" />
  <Header />

  <div class="container py-5">
    <div class="max-w-md mx-auto bg-white p-5 text-center">
      <h1 class="mb-3 fw-bold text-lg">Reset Your Password</h1>
      <p class="text-muted mb-4">
        Please enter your new password below. Make sure it is secure and easy to remember.
      </p>

      <form @submit.prevent="submit" class="text-start">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email" class="form-control" v-model="form.email" readonly />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">New Password</label>
          <input id="password" type="password" class="form-control" v-model="form.password" autocomplete="new-password" />
          <div v-if="form.errors.password" class="text-danger small">{{ form.errors.password }}</div>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirm New Password</label>
          <input id="password_confirmation" type="password" class="form-control" v-model="form.password_confirmation" autocomplete="new-password" />
          <div v-if="form.errors.password_confirmation" class="text-danger small">{{ form.errors.password_confirmation }}</div>
        </div>

        <PrimaryButton :disabled="form.processing" class="w-100">
          Reset Password
        </PrimaryButton>
      </form>
    </div>
  </div>

  <Footer />
</template>
<style>
.container{
    margin-top: 60px;
    margin-bottom: 60px;
}
</style>

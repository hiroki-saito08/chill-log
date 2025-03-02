<script setup>
import { useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});

const submitRegister = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation')
  });
};
</script>

<template>
  <Header />

  <div class="register-container">
    <div class="register-box">
      <h2>Sign Up</h2>

      <form @submit.prevent="submitRegister">
        <div class="form-group">
          <label for="name">Username</label>
          <input type="text" id="name" v-model="form.name" placeholder="Enter your username" required>
          <span v-if="form.errors.name" class="error">{{ form.errors.name }}</span>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="form.email" placeholder="Enter your email" required>
          <span v-if="form.errors.email" class="error">{{ form.errors.email }}</span>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" v-model="form.password" placeholder="Enter your password" required>
          <span v-if="form.errors.password" class="error">{{ form.errors.password }}</span>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" id="password_confirmation" v-model="form.password_confirmation" placeholder="Confirm your password" required>
          <span v-if="form.errors.password_confirmation" class="error">{{ form.errors.password_confirmation }}</span>
        </div>

        <button type="submit" class="btn" :disabled="form.processing">Sign Up</button>
      </form>

      <a :href="route('login')" class="link">Already have an account? Log in</a>
    </div>
  </div>

  <Footer />
</template>


<style scoped>
/* 背景・レイアウト */
.register-container {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
  color: #333;
  min-height: 90vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

/* ヘッダー */
.register-header {
  width: 100%;
  background: #6C7A89;
  color: white;
  padding: 20px;
  text-align: center;
  font-size: 24px;
  position: fixed;
  top: 0;
  left: 0;
}

/* ロゴリンク */
.logo {
  color: white;
  text-decoration: none;
}

/* 登録ボックス */
.register-box {
  width: 95%;
  max-width: 600px;
  background: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

/* フォーム */
.form-group {
  margin-bottom: 20px;
  text-align: left;
}

.form-group label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.error {
  color: red;
  font-size: 14px;
}

/* ボタン */
.btn {
  background: #88B04B;
  color: white;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: 100%;
}

.btn:hover {
  background: #76A03A;
}

.btn:disabled {
  background: gray;
  cursor: not-allowed;
}

/* リンク */
.link {
  margin-top: 10px;
  display: block;
  text-decoration: none;
  color: #6C7A89;
}
</style>

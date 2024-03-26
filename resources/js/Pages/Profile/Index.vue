<script setup>
import { reactive, nextTick, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  user: Array,
  errors: Object
});

const modalState = ref(false);
const form = useForm({
  user_id: props.user.id,
  status: 0,
  title: null,
  content: null,
  image: null
});

const storePost = () => {
  Inertia.post(route('post.store'), form);
  closeModal();
}
const closeModal = () => {
  modalState.value = false;

  form.reset();
};
const openModal = () => {
  modalState.value = true;
}
const onImageUploaded = (e) => {
  const image = e.target.files[0];
  form.image = image;
}
</script>

<template>
  <Head title="profile" />
  <Header :authProps=props></Header>
  <div class="m-5">
    <button @click="openModal" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5">記事を投稿する</button>
    <div>
      <p class="m-5">ここにログインユーザーのプロフィールデータを表示する。</p>
      <ul>
        <li class="m-5">画像: {{props.user.img}}</li>
        <li class="m-5">ID: {{props.user.id}}</li>
        <li class="m-5">名前: {{props.user.name}}</li>
        <li class="m-5">メールアドレス: {{props.user.email}}</li>
        <li class="m-5">電話番号: {{props.user.phone}}</li>
        <li class="m-5">住所: {{props.user.address}}</li>
        <li class="m-5">誕生日: {{props.user.birthday}}</li>
        <li class="m-5">性別: {{props.user.gender}}</li>
      </ul>
    </div>
    <Link :href="route('profile.edit')" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5">プロフィールの修正画面</Link>
  </div>

  <!-- モーダルウィンドウ できれば機能切り出す -->
  <Modal :show="modalState" @close="closeModal">
    <form @submit.prevent="storePost">
      <div class="container mx-auto flex">
        <div class="bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
          <h2 class="text-lg font-medium text-gray-900 mb-4">記事を投稿する</h2>
          <div class="relative mb-4">
            <label for="title" value="title" class="leading-7 text-sm text-gray-600">Title</label>
            <input id="title" v-model="form.title" type="text" placeholder="title" @keyup.enter=false name="title" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>

          <div class="relative mb-4">
            <label for="content" value="content" class="leading-7 text-sm text-gray-600">content</label>
            <textarea id="content" v-model="form.content" type="textarea" placeholder="content" @keyup.enter=false name="content" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>

          <input id="image" @change="onImageUploaded" type="file" placeholder="image" name="image">

          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

            <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              投稿する
            </PrimaryButton>
          </div>
        </div>
      </div>
    </form>
  </Modal>
</template>

<style>

</style>

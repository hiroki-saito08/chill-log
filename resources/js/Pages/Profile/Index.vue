<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});

const modalState = ref(false);
const titleInput = ref(null);
const form = useForm({
  title: '',
});

const createPost = () => {
  console.log("投稿しました");
  closeModal();
    // form.delete(route('profile.destroy'), {
    //     preserveScroll: true,
    //     onSuccess: () => closeModal(),
    //     onError: () => titleInput.value.focus(),
    //     onFinish: () => form.reset(),
    // });
};
const closeModal = () => {
  modalState.value = false;

  form.reset();
};
const openModal = () => {
  modalState.value = true;

  nextTick(() => titleInput.value.focus());
}
</script>

<template>
  <Head title="profile" />
  <div class="m-5">
    <button @click="openModal" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5">記事を投稿する</button>
    <div>
      <p class="m-5">ここにログインユーザーのプロフィールデータを表示する。</p>
      <ul>
        <li class="m-5">プロフィール画像</li>
        <li class="m-5">ID</li>
        <li class="m-5">名前</li>
        <li class="m-5">メアド</li>
        <li class="m-5">電話番号</li>
        <li class="m-5">住所</li>
        <li class="m-5">誕生日</li>
        <li class="m-5">性別</li>
      </ul>
    </div>
    <Link :href="route('profile.edit')" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5">プロフィールの修正画面</Link>
  </div>
  <!-- モーダルウィンドウ -->
  <Modal :show="modalState" @close="closeModal">
      <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900">
              記事を投稿する
          </h2>

          <p class="mt-1 text-sm text-gray-600">

          </p>

          <div class="mt-6">
              <InputLabel for="title" value="title" class="sr-only" />

              <TextInput
                  id="title"
                  ref="titleInput"
                  v-model="form.title"
                  type="text"
                  class="mt-1 block w-3/4"
                  placeholder="title"
                  @keyup.enter=false
              />

              <InputError :message="form.errors.title" class="mt-2" />
          </div>

          <div class="mt-6 flex justify-end">
              <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

              <PrimaryButton
                  class="ml-3"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  @click="createPost"
              >
                  create Post
              </PrimaryButton>
          </div>
      </div>
  </Modal>
</template>

<style>

</style>

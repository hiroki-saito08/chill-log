<script setup>
import { reactive, ref } from 'vue';
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
const editProfileModalState = ref(false);

const form = useForm({
  user_id: props.user.id,
  status: 1, //下書き保存ボタンを追加したら、下書きの時0にする
  title: null,
  content: null,
  image: null
});
const editName = ref(props.user.name);

const openModal = () => {
  modalState.value = true;
}
const openEditProfileModal = () => {
  editProfileModalState.value = true;
}

const closeModal = () => {
  modalState.value = false;

  form.reset();
};
const closeEditProfileModal = () => {
  editProfileModalState.value = false;

  editName.value = '';
};

const storePost = () => {
  Inertia.post(route('post.store'), form);
  alert('投稿しました');
  closeModal();
}

const updateProfile = () => {
  console.log(editName)
  Inertia.post(route('profile.update', props.user.id), {
    _method: 'put',
    name: editName.value,
  });

  alert('変更しました');
  closeEditProfileModal();
}

const onImageUploaded = (e) => {
  const image = e.target.files[0];
  form.image = image;
}

</script>

<template>
  <Head title="profile" />
  <Header :authProps=props></Header>

  <div class="w-1/2 m-auto mt-10">
    <div class="mb-10">
      <h2 class="text-2xl font-bold mb-6">記事の投稿</h2>
      <button @click="openModal" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">投稿する</button>
    </div>

    <div class="mt-10 mb-10">
      <h2 class="text-2xl font-bold mb-6">ユーザー情報</h2>
      <ul>
        <li class="mt-5">ID: {{user.id}}</li>
        <li class="mt-5">名前: {{user.name}}</li>
      </ul>
    </div>

    <button @click="openEditProfileModal" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg mb-10">名前を変更する</button>

    <div class="mb-10">
      <Link :href="route('post.own')" class="block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg w-3/12">自分の投稿一覧</Link>
    </div>

    <div class="mb-10">
      <Link :href="route('post.favorite') " class="block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg mb-10 w-1/3">お気に入り投稿一覧</Link>
    </div>
  </div>




  <!-- 記事投稿モーダル -->
  <Modal :show=" modalState " @close=" closeModal ">
    <form @submit.prevent=" storePost ">
      <div class=" container mx-auto flex">
        <div class="bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
          <h2 class="text-lg font-medium text-gray-900 mb-4">記事を投稿する</h2>
          <div class="relative mb-4">
            <label for="title" value="title" class="leading-7 text-sm text-gray-600">Title</label>
            <input id="title" v-model=" form.title " type="text" placeholder="title" @keyup.enter=false name="title" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>

          <div class="relative mb-4">
            <label for="content" value="content" class="leading-7 text-sm text-gray-600">content</label>
            <textarea id="content" v-model=" form.content " type="textarea" placeholder="content" @keyup.enter=false name="content" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
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

  <!-- 名前修正モーダル -->
  <Modal :show="editProfileModalState" @close="closeEditProfileModal ">
    <form @submit.prevent="updateProfile">
      <div class="container mx-auto">
        <div class="bg-white rounded-lg p-8 md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
          <h2 class="text-lg font-medium text-gray-900 mb-4">名前を変更する</h2>
          <div class="relative mb-4">
            <label for="name" value="name" class="leading-7 text-sm text-gray-600">Name</label>
            <input id="name" v-model="editName" type="text" placeholder="name" @keyup.enter=false name="name" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>

          <div class="mt-6">
            <SecondaryButton @click="closeEditProfileModal"> Cancel </SecondaryButton>

            <PrimaryButton class="ml-3" :class="{ 'opacity-25': editName.processing }" :disabled="editName.processing">
              変更する
            </PrimaryButton>
          </div>
        </div>
      </div>
    </form>
  </Modal>

</template>

<style>

</style>

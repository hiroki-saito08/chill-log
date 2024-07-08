<script setup>
import { reactive, nextTick, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';
import Slick from 'vue-slick';

const slickOptions = ref({
  arrows: true,    //スライドの矢印ボタン
  dots: true,      //ドットマーク
  autoplay: true,  //自動スライド
  autoplaySpeed: 4000,  //自動スライド間隔(ms)
  pauseOnFocus: false,  //ドットマークを押すとスライドショーが止まるのを防ぐ
  prevArrow: '<button type="button" class="slick-prev"></button>',  //ひとつ前の画像に戻る矢印ボタン
  nextArrow: '<button type="button" class="slick-next"></button>'   //ひとつ先の画像に進む矢印ボタン
});

const props = defineProps({
  posts: Object,
  user: Array,
  errors: Object
});

const modalState = ref(false);
const form = useForm({
  user_id: props.user.id,
  status: 1, //下書き保存ボタンを追加したら、下書きの時0にする
  title: null,
  content: null,
  image: null
});

const openModal = () => {
  modalState.value = true;
}
const closeModal = () => {
  modalState.value = false;

  form.reset();
};

const storePost = () => {
  Inertia.post(route('post.store'), form);
  alert('投稿しました');
  closeModal();
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
      <ul>
        <li class="m-5">画像: {{user.img}}</li>
        <li class="m-5">ID: {{user.id}}</li>
        <li class="m-5">名前: {{user.name}}</li>
        <li class="m-5">メールアドレス: {{user.email}}</li>
        <li class="m-5">電話番号: {{user.phone}}</li>
        <li class="m-5">住所: {{user.address}}</li>
        <li class="m-5">誕生日: {{user.birthday}}</li>
        <li class="m-5">性別: {{user.gender}}</li>
      </ul>
    </div>
    <!-- <Link :href="route('profile.edit')" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5">プロフィールの修正画面</Link> -->
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

  <Link href="/">戻る</Link>
</template>

<style>

</style>

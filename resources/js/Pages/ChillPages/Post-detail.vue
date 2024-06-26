
<script setup>
import Header from '@/Components/Header.vue';
import { reactive, nextTick, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  post: Object,
  user: Array,
  errors: Object
});
const modalState = ref(false);
// 非ログインユーザーもいるため初期設定はnull
const form = useForm({
  post_id: props.post.id,
  user_id: null,
  star: null,
  comment_title: null,
  comment_content: null,
  image: null
});

const canReview = () => {
  if (props.user === null) {
    Inertia.get(route('login'));
  } else {
    form.user_id = props.user.id;
    openModal();
  }
}

const storePost = () => {
  Inertia.post(route('review.store'), form);
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
  <Head title="Post-detail" />
  <!-- メインビジュアルは後で写真を設定 -->
  <Header :authProps=props></Header>
  <div class="m-5">
    <!-- 検索バー -->
    <div class="mx-auto flex flex-wrap justify-around h-14 p-4 w-3/5 m-auto mt-5">
      <input type="" id="" name="" class="w-3/5 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      <button class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
    </div>
  </div>

  <div>
    <article class="p-5 border">
      <p class="pt-2 pb-2">{{ post.title }}</p>
      <div v-if="post.images">
        <div v-for=" image in post.images" :key="image.id">
          <div class="h-80">
            <img :src="image.path" alt="画像" class="w-full h-full object-cover">
          </div>
        </div>
      </div>
      <p class="pt-2 pb-2">{{ post.content }}</p>
    </article>
  </div>

  <button @click="canReview" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 ml-auto block">コメントする</button>

  <!-- レビュー一覧 -->
  <div>
    <article class="p-5 border">
      <div v-if="post.reviews">
        <div v-for=" review in post.reviews" :key="review.id">
          <article class="border">
            <div class="stars relative mb-4">
              <span>
                <input class="star5" type="radio" :checked="review.star == 5"><label>★</label>
                <input class="star4" type="radio" :checked="review.star == 4"><label>★</label>
                <input class="star3" type="radio" :checked="review.star == 3"><label>★</label>
                <input class="star2" type="radio" :checked="review.star == 2"><label>★</label>
                <input class="star1" type="radio" :checked="review.star == 1"><label>★</label>
              </span>
            </div>
            <div v-if="review.images">
              <div v-for=" image in review.images" :key="image.id">
                <div class="h-80">
                  <img :src="image.path" alt="画像" class="w-full h-full object-cover">
                </div>
              </div>
            </div>
            <p class="pt-2 pb-2">{{ review.comment_title }}</p>
            <p class="pt-2 pb-2">{{ review.comment_content }}</p>
          </article>
        </div>
      </div>
    </article>
  </div>

  <div class="m-5 flex justify-center">
    <Link class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" :href="route('posts')">投稿一覧へ</Link>
  </div>

  <!-- モーダルウィンドウ できれば機能切り出す -->
  <Modal :show="modalState" @close="closeModal">
    <form @submit.prevent="storePost">
      <div class="container mx-auto flex">
        <div class="bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
          <h2 class="text-lg font-medium text-gray-900 mb-4">コメントを投稿する</h2>

          <div class="stars relative mb-4">
            <!-- 星はCSSの関係で逆順 -->
            <span class="form-stars">
              <input id="star01" type="radio" name="star" value="5" v-model="form.star"><label for="star01">★</label>
              <input id="star02" type="radio" name="star" value="4" v-model="form.star"><label for="star02">★</label>
              <input id="star03" type="radio" name="star" value="3" v-model="form.star"><label for="star03">★</label>
              <input id="star04" type="radio" name="star" value="2" v-model="form.star"><label for="star04">★</label>
              <input id="star05" type="radio" name="star" value="1" v-model="form.star"><label for="star05">★</label>
            </span>
          </div>

          <div class="relative mb-4">
            <label for="comment_title" value="comment_title" class="leading-7 text-sm text-gray-600">Title</label>
            <input id="comment_title" v-model="form.comment_title" type="text" placeholder="title" @keyup.enter=false name="comment_title" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>

          <div class="relative mb-4">
            <label for="comment_content" value="comment_content" class="leading-7 text-sm text-gray-600">Content</label>
            <textarea id="comment_content" v-model="form.comment_content" type="textarea" placeholder="content" @keyup.enter=false name="comment_content" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
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
.stars span {
  display: flex;
  /* 要素をフレックスボックスにする */
  flex-direction: row-reverse;
  /* 星を逆順に並べる */
  justify-content: flex-end;
  /* 逆順なので、左寄せにする */
}

.stars input[type='radio'] {
  display: none;
  /* デフォルトのラジオボタンを非表示にする */
}

.stars label {
  color: #D2D2D2;
  /* 未選択の星をグレー色に指定 */
  font-size: 30px;
  /* 星の大きさを30pxに指定 */
  padding: 0 5px;
  /* 左右の余白を5pxに指定 */
}

.stars .form-stars label {
  cursor: pointer;
  /* カーソルが上に乗ったときに指の形にする */
}

.stars .form-stars label:hover,
.stars .form-stars label:hover~label,
.stars input[type='radio']:checked~label {
  color: #F8C601;
  /* 選択された星以降をすべて黄色にする */
}
</style>

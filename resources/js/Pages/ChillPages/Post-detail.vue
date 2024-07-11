
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
  errors: Object,
  review: Object,
  own_post: Boolean,
});
let commented = false;
const modalState = ref(false);
const editPostModalState = ref(false);
const userId = ref(null)
if (props.user !== null) {
  userId.value = props.user.id
}

// 非ログインユーザーもいるため初期設定はnull
const form = useForm({
  post_id: props.post.id,
  user_id: userId,
  star: null,
  comment_title: null,
  comment_content: null,
  image: null
});
const editPostForm = useForm({
  user_id: userId,
  status: props.post.status,
  title: props.post.title,
  content: props.post.content,
  image: props.post.image
});

const canReview = () => {
  if (props.user === null) {
    Inertia.get(route('login'));
  } else {
    // コメント済みの場合の処理
    if (props.review != null) {
      form.star = props.review.star;
      form.comment_title = props.review.comment_title;
      form.comment_content = props.review.comment_content;
      // form.image = props.review.image;
      commented = true;
    }

    openModal();
  }
}

// コメント削除
const deleteReview = () => {
  // 確認用ポップアップ
  let result = confirm('コメントを削除してよろしいですか？');

  if (result) {
    Inertia.delete(route('review.destroy', props.review.id));
    alert('コメントを削除しました');
  }

  closeEditPostModal();
}

const storePost = () => {
  // コメント済みの場合は修正に飛ばす
  if (commented) {
    // inertiaではputでfileを送れないらしいからこんな感じに変更
    Inertia.post(route('review.update', props.review.id ), {
      _method: 'put',
      form: form,
    });
    alert('コメントを更新しました');
  } else {
    Inertia.post(route('review.store'), form);
    alert('コメントを投稿しました');
  }
  closeModal();
}

const updatePost = () => {
  Inertia.post(route('post.update', props.post.id), {
    _method: 'put',
    form: editPostForm,
  });
  alert('投稿を更新しました');
  closeEditPostModal();
}

// 投稿削除
const deletePost = () => {
  // 確認用ポップアップ
  let result = confirm('投稿を削除してよろしいですか？');

  if (result) {
    Inertia.delete(route('post.destroy', props.post.id));
    alert('投稿を削除しました');
  }

  closeEditPostModal();
}

const onImageUploaded = (e) => {
  const image = e.target.files[0];
  form.image = image;
}
const onPostImageUploaded = (e) => {
  const postImage = e.target.files[0];
  editPostForm.image = postImage;
}

const openModal = () => {
  modalState.value = true;
}
const closeModal = () => {
  modalState.value = false;

  form.reset();
};

const openEditPostModal = () => {
  editPostModalState.value = true;
}
const closeEditPostModal = () => {
  editPostModalState.value = false;

  editPostForm.reset();
};

</script>

<template>
  <Head title="Post-detail" />
  <!-- メインビジュアルは後で写真を設定 -->
  <Header :authProps=props></Header>

  <div class="mt-10 w-9/12 m-auto">
    <article class="p-10 border mb-5">
      <h2 class="text-center text-xl font-bold">「{{ post.title }}」</h2>
      <h3 class="text-right text-lg pt-5 pb-5">{{ user.name }} さんの投稿</h3>

      <div v-if="post.images.length">
        <div v-for=" image in post.images" :key="image.id">
          <div class="h-svh">
            <img :src="image.path" alt="画像" class="w-full h-full object-cover">
          </div>
        </div>
      </div>
      <div v-else> 画像なし </div>

      <div class="mt-5 mb-5">
        <p class="pt-5 pb-5">{{ post.content }}</p>
      </div>

      <div class="flex justify-between pt-2 border-t">
        <div>コメント: {{ post.reviews_count }}件</div>
        <div>
          評価:
          <span v-if="post.rating[0]">{{ post.rating[0].avg_review }}</span>
          <span v-else> 0.00 </span>
        </div>
      </div>

      <!-- ログインユーザーの投稿の時に表示 -->
      <div class="flex flex-wrap justify-end">
        <button v-if="own_post" @click="openEditPostModal" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 block">編集</button>
        <button v-if="own_post" @click="deletePost" class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 block">削除</button>
      </div>
    </article>

    <button v-if="!own_post" @click="canReview" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg ml-auto block mt-10 mb-10">コメントする</button>
  </div>

  <!-- コメントー一覧 -->
  <div class="mt-10 w-2/3 m-auto">
    <h3 class="mt-5 mb-10 text-xl font-bold">コメント一覧</h3>

    <article>
      <div v-if="post.reviews">
        <div v-for=" review in post.reviews" :key="review.id">
          <article class="border p-5">
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
              <div v-for="image in review.images" :key="image.id">
                <div class="h-80 mb-5">
                  <img :src="image.path" alt="画像" class="w-full h-full object-cover">
                </div>
              </div>
            </div>
            <p class="pt-2 pb-4 text-xl font-bold">{{ review.comment_title }}</p>
            <p class="pt-2 pb-2">{{ review.comment_content }}</p>

            <h3 class="text-right text-lg pt-5 pb-5">{{ user.name }} さんの投稿</h3>

            <!-- ログインユーザーのコメントの時に表示 -->
            <div v-if="review.user_id == userId" class="flex flex-wrap justify-end">
              <button @click="canReview" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 block">編集</button>
              <button @click="deleteReview" class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 block">削除</button>
            </div>
          </article>
        </div>
      </div>
    </article>
  </div>

  <div class="m-10 flex justify-center">
    <Link class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" :href="route('posts')">投稿一覧へ</Link>
  </div>


  <!-- 編集用モーダルウィンドウ -->
  <Modal :show="editPostModalState" @close="closeEditPostModal">
    <form @submit.prevent="updatePost">
      <div class="container mx-auto flex">
        <div class="bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
          <h2 class="text-lg font-medium text-gray-900 mb-4">記事を編集する</h2>
          <div class="relative mb-4">
            <label for="title" value="title" class="leading-7 text-sm text-gray-600">Title</label>
            <input id="title" v-model="editPostForm.title" type="text" placeholder="title" @keyup.enter=false name="title" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>

          <div class="relative mb-4">
            <label for="content" value="content" class="leading-7 text-sm text-gray-600">content</label>
            <textarea id="content" v-model="editPostForm.content" type="textarea" placeholder="content" @keyup.enter=false name="content" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>

          <input id="image" @change="onPostImageUploaded" type="file" placeholder="image" name="image">

          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeEditPostModal"> Cancel </SecondaryButton>

            <PrimaryButton class="ml-3" :class="{ 'opacity-25': editPostForm.processing }" :disabled="editPostForm.processing">
              更新する
            </PrimaryButton>
          </div>
        </div>
      </div>
    </form>
  </Modal>

  <!-- コメント用モーダルウィンドウ -->
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

/* .stars .form-stars label:hover, */
/* .stars .form-stars label:hover~label, */
.stars input[type='radio']:checked~label {
  color: #F8C601;
  /* 選択された星以降をすべて黄色にする */
}
</style>

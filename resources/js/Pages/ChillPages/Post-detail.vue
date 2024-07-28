
<script setup>
import Header from '@/Components/Header.vue';
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';
import { GoogleMap } from 'vue3-google-map';

const props = defineProps({
  post: Object,
  user: Array,
  errors: Object,
  review: Object,
  own_post: Boolean,
  isFavorite: Boolean,
  favoriteId: Number
});

// GoogleMap コンポーネントで使用するデータ
const { VITE_GMAP_API_KEY } = import.meta.env;
const clickedLatLng = ref(null); // クリックした位置情報を保持する変数
const location = props.post.location.split(',')
const location_lat = Number(location[0])
const location_lng = Number(location[1])
const center = ref({ lat: location_lat, lng: location_lng }); // 取得した座標
const zoom = ref(16);
const errors = ref([]);

const commented = ref(false);
const modalState = ref(false);
const editPostModalState = ref(false);
const userId = ref(false)
const mapModalState = ref(false);

if (props.user !== null) {
  userId.value = props.user.id
}

// 非ログインユーザーもいるため初期設定はnull
const form = useForm({
  post_id: props.post.id,
  user_id: userId.value,
  star: null,
  comment_title: null,
  comment_content: null,
  image: null
});

const editPostForm = useForm({
  user_id: userId.value,
  status: props.post.status,
  title: props.post.title,
  content: props.post.content,
  image: props.post.image,
  deleteImage: false,
  location: {
    lat: location_lat,
    lng: location_lng
  }
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
      commented.value = true;
    }

    openModal();
  }
}

// マップ上をクリックしたときのイベントハンドラ
const onMapClick = (event) => {
  clickedLatLng.value = {
    lat: event.latLng.lat(),
    lng: event.latLng.lng()
  };
};

// 現在地を取得する関数
const getCurrentLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition((position) => {
      center.value = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
    });
  } else {
    alert('Geolocation is not supported by this browser.');
  }
};

const selectLocation = () => {
  editPostForm.location = clickedLatLng.value;
  closeMapModal();
}

// お気に入り登録
const canFavorite = () => {
  if (props.user === null) {
    Inertia.get(route('login'));
  } else {
    // お気に入り済みの場合の処理
    if (props.isFavorite) {
      Inertia.delete(route('favorite.destroy', props.favoriteId));
    } else {
      Inertia.post(route('favorite.store',
        {
          post_id: props.post.id,
          user_id: userId.value
        }))
    }
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

const storeComment = () => {
  // コメント済みの場合は修正に飛ばす
  if (commented) {
    // inertiaではputでfileを送れないらしいからこんな感じに変更
    if (checkCommentForm()) {
      Inertia.post(route('review.update', props.review.id ), {
        _method: 'put',
        form: form,
      });
      alert('コメントを更新しました');
      closeModal();
    }
  } else {
    if (checkCommentForm()) {
      Inertia.post(route('review.store'), form);
      alert('コメントを投稿しました');
      closeModal();
    }
  }
}

const updatePost = () => {
  if (checkForm()) {
    editPostForm.status = 1;
    Inertia.post(route('post.update', props.post.id), {
      _method: 'put',
      form: editPostForm,
    });
    alert('投稿を更新しました');
    closeEditPostModal();
  }
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

const openMapModal = () => {
  mapModalState.value = true;
}
const closeMapModal = () => {
  mapModalState.value = false;
}

const openEditPostModal = () => {
  editPostModalState.value = true;
}
const closeEditPostModal = () => {
  editPostModalState.value = false;

  editPostForm.reset();
};

// バリデーション
const checkForm = () => {
  errors.value = []

  // 投稿の編集の場合
  if (editPostForm.title && editPostForm.content && editPostForm.location.lat) {
    return true;
  }

  if (!editPostForm.title) {
    errors.value.push('Titleは必須です');
  }
  if (!editPostForm.content) {
    errors.value.push('Contentは必須です');
  }
  if (!editPostForm.location.lat) {
    errors.value.push('位置の選択は必須です');
  }

  return false;
}
// バリデーション
const checkCommentForm = () => {
  errors.value = []

  // コメントの場合
  if (form.comment_title && form.comment_content) {
    return true;
  }

  if (!form.comment_title) {
    errors.value.push('Titleは必須です');
  }
  if (!form.comment_content) {
    errors.value.push('Contentは必須です');
  }

  return false;
}

</script>

<template>
  <Head title="Post-detail" />
  <!-- メインビジュアルは後で写真を設定 -->
  <Header :authProps=props></Header>

  <div class="mt-10 w-9/12 m-auto">
    <article class="p-10 border mb-5">
      <h2 class="text-center text-xl font-bold">「{{ post.title }}」</h2>
      <h3 class="text-right text-lg pt-5 pb-5">{{ post.user.name }} さんの投稿</h3>

      <div v-if="post.images.length">
        <div v-for=" image in post.images" :key="image.id">
          <div class="h-svh">
            <img :src="image.path" alt="画像" class="w-full h-full object-cover">
          </div>
        </div>
      </div>
      <div v-else> 画像なし </div>

      <div class="mt-5 mb-5">
        <p class="pt-5 pb-5 whitespace-pre-wrap text-center">{{ post.content }}</p>
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

    <!-- マップ -->
    <div v-if="post.location">
      <GoogleMap :api-key="VITE_GMAP_API_KEY" style="width: 100%;
      height: 450px" :center="center" :zoom="zoom" />

      <!-- 取得した位置情報表示 -->
      <div class="m-5">
        <div class="mt-4 mb-4">
          <p><strong>座標:</strong></p>
          <p>緯度: {{ location_lat }}</p>
          <p>経度: {{ location_lng }}</p>
        </div>
      </div>
    </div>

    <div class="flex">
      <button v-if="!own_post" @click="canReview" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg ml-auto block">コメントする</button>
      <!-- お気に入り -->
      <button v-if="!own_post" @click="canFavorite">
        <a class="unfavorite-star" :class="{ 'favorite-star': props.isFavorite }">★</a>
      </button>
    </div>
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

            <h3 class="text-right text-lg pt-5 pb-5">{{ review.user.name }} さんの投稿</h3>

            <!-- ログインユーザーのコメントの時に表示 -->
            <div v-if="review.user_id == userId.value" class="flex flex-wrap justify-end">
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

          <p v-if="errors.length">
            <ul class="m-3">
              <li v-for="error in errors" :key="error" class="text-red-500 list-disc mb-3">{{ error }}</li>
            </ul>
          </p>

          <div class="relative mb-4">
            <label for="title" value="title" class="leading-7 text-sm text-gray-600">Title</label>
            <input id="title" v-model="editPostForm.title" type="text" placeholder="title" @keyup.enter=false name="title" maxlength="20" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>

          <div class="relative mb-4">
            <label for="content" value="content" class="leading-7 text-sm text-gray-600">content</label>
            <textarea id="content" v-model="editPostForm.content" type="textarea" placeholder="content" @keyup.enter=false name="content" maxlength="250" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>

          <div class="flex mb-5">
            <div>
              <input id="image" @change="onPostImageUploaded" type="file" placeholder="image" name="image" :disabled="editPostForm.deleteImage">
            </div>
            <div>
              <label for=" deleteImage" class="leading-7 pr-3">登録済みの画像を削除</label>
              <input id="deleteImage" v-model="editPostForm.deleteImage" @change="onPostImageUploaded" type="checkbox" name="deleteImage" :disabled="editPostForm.image" :class="{ 'opacity-25': editPostForm.image }">
            </div>
          </div>

          <button @click="openMapModal" class="text-white bg-indigo-500 border-0 py-2 px-6 text-lg w-2/5" type="button">位置を選択する</button>

          <div v-if="editPostForm.location.lat" class="mt-2 mb-2">
            <p>緯度: <input id="location" v-model="editPostForm.location.lat" type="text" name="location.lat" class="border-none"></p>
            <p>経度: <input id="location" v-model="editPostForm.location.lng" type="text" name="location.lng" class="border-none"></p>
          </div>

          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeEditPostModal"> Cancel </SecondaryButton>

            <PrimaryButton class="ml-3" :class="{ 'opacity-25': editPostForm.processing }" :disabled="editPostForm.processing">
              <span v-if="props.post.status">更新する</span>
              <span v-else>投稿する</span>
            </PrimaryButton>
          </div>
        </div>
      </div>
    </form>
  </Modal>

  <!-- 位置選択モーダル -->
  <Modal :show="mapModalState" @close="closeMapModal">

    <GoogleMap ref="mapRef" :api-key="VITE_GMAP_API_KEY" style="width: 100%;
      height: 450px" :center="center" :zoom="zoom" @click="onMapClick" />

    <!-- 取得した位置情報表示 -->
    <div class="m-5">

      <!-- 現在地取得ボタン -->
      <button class="block mb-5 border-b border-black" @click="getCurrentLocation">現在地を取得する</button>
      <div v-if="clickedLatLng" class="mt-4 mb-4">
        <p><strong>クリックした位置情報:</strong></p>
        <p>緯度: {{ clickedLatLng.lat }}</p>
        <p>経度: {{ clickedLatLng.lng }}</p>
      </div>

      <button @click="selectLocation" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">ここを選択する</button>
    </div>

  </Modal>

  <!-- コメント用モーダルウィンドウ -->
  <Modal :show="modalState" @close="closeModal">
    <form @submit.prevent="storeComment">
      <div class="container mx-auto flex">
        <div class="bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
          <h2 class="text-lg font-medium text-gray-900 mb-4">コメントを投稿する</h2>

          <p v-if="errors.length">
            <ul class="m-3">
              <li v-for="error in errors" :key="error" class="text-red-500 list-disc mb-3">{{ error }}</li>
            </ul>
          </p>

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
            <input id="comment_title" v-model="form.comment_title" type="text" placeholder="title" @keyup.enter=false name="comment_title" maxlength="20" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>

          <div class="relative mb-4">
            <label for="comment_content" value="comment_content" class="leading-7 text-sm text-gray-600">Content</label>
            <textarea id="comment_content" v-model="form.comment_content" type="textarea" placeholder="content" @keyup.enter=false name="comment_content" maxlength="250" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
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

/* favorite */
.unfavorite-star {
  color: #D2D2D2;
  font-size: 30px;
  padding: 0 5px;
}

.favorite-star {
  color: #F8C601;
  font-size: 30px;
  padding: 0 5px;
}
</style>

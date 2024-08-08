<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';
import { GoogleMap } from 'vue3-google-map';

const props = defineProps({
  user: Array,
});

// GoogleMap コンポーネントで使用するデータ
const { VITE_GMAP_API_KEY } = import.meta.env;
const center = ref({ lat: 35.6895, lng: 139.6917 }); // 東京の座標
const zoom = ref(10);
const clickedLatLng = ref(null); // クリックした位置情報を保持する変数
const mapRef = ref(null);
const errors = ref([]);

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

const modalState = ref(false);
const mapModalState = ref(false);
const editProfileModalState = ref(false);

const form = useForm({
  user_id: props.user.id,
  status: 1, //下書き保存ボタンを追加したら、下書きの時0にする
  title: null,
  content: null,
  image: null,
  location: {
    lat: null,
    lng: null
  }
});

const editName = ref(props.user.name);

const openModal = () => {
  modalState.value = true;
}
const openMapModal = () => {
  mapModalState.value = true;
}
const openEditProfileModal = () => {
  editProfileModalState.value = true;
}

const closeModal = () => {
  modalState.value = false;

  form.reset();
}
const closeMapModal = () => {
  mapModalState.value = false;
}
const closeEditProfileModal = () => {
  editProfileModalState.value = false;

  editName.value = '';
}

const storePost = () => {
  if (checkForm()) {
    Inertia.post(route('post.store'), form);
  }
}

// バリデーション
const checkForm = () => {
  errors.value = []

  if (form.title && form.content && form.location.lat) {
    return true;
  }

  if (!form.title) {
    errors.value.push('Titleは必須です');
  }
  if (!form.content) {
    errors.value.push('Contentは必須です');
  }
  if (!form.location.lat) {
    errors.value.push('位置の選択は必須です');
  }

  return false;
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

const selectLocation = () => {
  form.location = clickedLatLng.value;
  closeMapModal();
}

const save = () => {
  if (checkForm()) {
    form.status = 0;
    Inertia.post(route('post.save'), form);
  }
}

</script>

<template>
  <Head title="profile" />
  <Header :authProps=props></Header>

  <div class="w-2/3 md:w-1/2 m-auto mt-10 mb-20">
    <div class="mb-10">
      <h2 class="text-2xl font-bold mb-6">記事の投稿</h2>
      <button @click="openModal" class="w-full text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">投稿する</button>
    </div>

    <div class="mt-10 mb-10">
      <h2 class="text-2xl font-bold mb-6">ユーザー情報</h2>
      <ul>
        <li class="mt-5">ID: {{user.id}}</li>
        <li class="mt-5">名前: {{user.name}}</li>
      </ul>
    </div>

    <div class="text-center">
      <button @click="openEditProfileModal" class="w-full text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg mb-10">名前を変更する</button>

      <div class="mb-10">
        <Link :href="route('post.own')" class="w-full block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">自分の投稿一覧</Link>
      </div>

      <div class="mb-10">
        <Link :href="route('post.savePosts') " class="w-full block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">下書き一覧</Link>
      </div>

      <div class="mb-10">
        <Link :href="route('post.favorite') " class="w-full block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg mb-10">お気に入り投稿一覧</Link>
      </div>
    </div>
  </div>


  <!-- 記事投稿モーダル -->
  <Modal :show=" modalState " @close=" closeModal ">
    <form @submit.prevent=" storePost ">
      <div class=" container mx-auto flex">
        <div class="bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
          <h2 class="text-lg font-medium text-gray-900 mb-4">記事を投稿する</h2>

          <p v-if="errors.length">
            <ul class="m-3">
              <li v-for="error in errors" :key="error" class="text-red-500 list-disc mb-3">{{ error }}</li>
            </ul>
          </p>

          <div class="relative mb-4">
            <label for="title" value="title" class="leading-7 text-sm text-gray-600">Title</label>
            <input id="title" v-model=" form.title " type="text" placeholder="title" @keyup.enter=false name="title" maxlength="20" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>

          <div class="relative mb-4">
            <label for="content" value="content" class="leading-7 text-sm text-gray-600">Content</label>
            <textarea id="content" v-model=" form.content " type="textarea" placeholder="content" @keyup.enter=false name="content" maxlength="250" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>

          <div class="mb-5">
            <input id="image" @change="onImageUploaded" type="file" placeholder="image" name="image">
          </div>

          <button @click="openMapModal" class="text-white bg-indigo-500 border-0 py-2 px-6 text-lg w-2/5" type="button">位置を選択する</button>

          <div v-if="form.location.lat" class="mt-2 mb-2">
            <p>緯度: <input id="location" v-model="form.location.lat" type="text" name="location.lat" class="border-none"></p>
            <p>経度: <input id="location" v-model="form.location.lng" type="text" name="location.lng" class="border-none"></p>
          </div>

          <div class="mt-6 flex justify-end">
            <SecondaryButton class="ml-3" @click="save"> 下書きに保存する </SecondaryButton>

            <SecondaryButton class="ml-3" @click="closeModal"> Cancel </SecondaryButton>

            <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              投稿する
            </PrimaryButton>
          </div>
        </div>
      </div>
    </form>
  </Modal>

  <!-- 位置選択モーダル -->
  <Modal :show="mapModalState" @close="closeMapModal ">

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

  <!-- 名前修正モーダル -->
  <Modal :show="editProfileModalState" @close="closeEditProfileModal ">
    <form @submit.prevent="updateProfile">
      <div class="container mx-auto">
        <div class="bg-white rounded-lg p-8 md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
          <h2 class="text-lg font-medium text-gray-900 mb-4">名前を変更する</h2>
          <div class="relative mb-4">
            <label for="name" value="name" class="leading-7 text-sm text-gray-600">Name</label>
            <input id="name" v-model="editName" type="text" placeholder="name" @keyup.enter=false name="name" maxlength="10" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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

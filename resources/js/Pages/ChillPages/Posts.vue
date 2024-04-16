<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
  posts: Object
});
</script>

<template>
  <Head title="Posts" />
  <!-- メインビジュアルは後で写真を設定 -->
  <Header :authProps=props></Header>
  <div class="m-5">
    <!-- 検索バー -->
    <div class="mx-auto flex flex-wrap justify-around h-14 p-4 w-3/5 m-auto mt-5">
      <input type="" id="" name="" class="w-3/5 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      <button class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
    </div>
  </div>

  <!-- 投稿を最新から6件取得して表示する。残りは投稿一覧ページへ誘導する
  表示テンプレートは分けたい -->
  <template v-if="posts">
    <div class="grid grid-cols-2">
      <div v-for=" post in posts" :key="post.id" class="m-5">
        <Link :href="route('post.show', post.id)">
        <article class="p-5 border">
          <p class="pt-2 pb-2">{{ post.title }}</p>
          <div v-if="post.images">
            <div v-for=" image in post.images" :key="image.id">
              <!-- 画像は複数の時選択した画像を拡大表示できるようにする -->
              <div class="h-80">
                <img :src="image.path" alt="画像" class="w-full h-full object-cover">
              </div>
            </div>
          </div>
          <p class="pt-2 pb-2">{{ post.content }}</p>
          <div>{{ post.reviews_count }}件</div>
          <div>
            <div v-if="post.rating[0]">{{ post.rating[0].avg_review }}</div>
            <div v-else> 0.00 </div>
          </div>
        </article>
        </Link>
      </div>
    </div>
  </template>
</template>

  <style>

  </style>

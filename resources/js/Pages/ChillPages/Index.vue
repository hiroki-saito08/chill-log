<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
  posts: Object,
  canLogin: Boolean,
  canRegister: Boolean
});

console.log(props.posts);

</script>

<template>
  <Head title="TOP" />
  <!-- メインビジュアルは後で写真を設定 -->
  <div class="position: relative h-svh w-full bg-green-300">
    <Header :authProps=props></Header>
    <!-- 検索バー -->
    <div class="mx-auto flex flex-wrap justify-around h-14 p-4 w-3/5 m-auto mt-5">
      <input type="" id="" name="" class="w-3/5 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      <button class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
    </div>
  </div>

  <!-- 投稿を最新から5件くらい取得して表示する。
  表示テンプレートは分けたい -->
  <template v-if="posts">
    <div v-for=" post in posts" :key="post.id">
      <div v-if="post.images">
        <div v-for=" image in post.images" :key="image.id">


          <p>{{ image.path }}</p>
          <p>{{ image.name }}</p>
        </div>
      </div>
      <p>{{ post.title }}</p>
      <p>{{ post.content }}</p>
    </div>
  </template>
</template>

  <style>

  </style>

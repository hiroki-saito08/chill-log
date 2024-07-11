<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
  posts: Object
});
</script>

<template>
  <Head title="Posts" />
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
    <div class="grid grid-cols-3">
      <div v-for=" post in posts" :key="post.id" class="m-5">
        <Link :href="route('post.show', post.id)">

        <article class="p-5 border">
          <div class="pb-2 border-b">
            <h2 class="text-lg pt-2 pb-2 font-bold">「{{ post.title }}」</h2>
            <!-- <h2 class="font-bold">{{ post.user.name }} さんの投稿</h2> -->
          </div>
          <div class="h-80 pt-3 pb-3">
            <div v-if="post.images.length" class="h-full">
              <div v-for=" image in post.images" :key="image.id" class="h-full">
                <img :src="image.path" alt="画像" class="w-full h-full object-cover">
              </div>
            </div>
            <div v-else> 画像なし </div>
          </div>

          <div class="flex justify-between pt-2 border-t">
            <div>コメント: {{ post.reviews_count }}件</div>
            <div>
              評価:
              <span v-if="post.rating[0]">{{ post.rating[0].avg_review }}</span>
              <span v-else> 0.00 </span>
            </div>
          </div>
        </article>
        </Link>
      </div>
    </div>
  </template>

  <div class="m-5 mt-10 mb-10 flex justify-center">
    <Link class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" href="/">TOPに戻る</Link>
  </div>

</template>

  <style>

  </style>

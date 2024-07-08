<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
  posts: Object,
  popularPosts: Object
});

const mainBer = true;
const sideBer = true;
</script>

<template>
  <Head title="Top" />
  <!-- 追々はスライドショーにしたい -->
  <div class="position: relative h-svh w-full main_image">
    <div class="inner_musk">
      <Header :authProps=props></Header>
      <!-- 検索バー -->
      <div class="mx-auto flex flex-wrap justify-around h-14 p-4 w-3/5 m-auto mt-5">
        <input type="" id="" name="" class="w-3/5 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        <button class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
      </div>
    </div>
  </div>

  <div class="flex">
    <!-- メインバー -->
    <template v-if="mainBer">
      <div id="main-ber" class="p-5 bg-amber-100">
        <h2 class="text-2xl font-bold m-6">新規投稿</h2>
        <div v-if="posts" class="grid grid-cols-2">
          <div v-for=" post in posts" :key="post.id" class="">
            <Link :href="route('post.show', post.id)">

            <article class="article-border-position p-5 border border-black">
              <p class=" pt-2 pb-2 font-bold">{{ post.title }}</p>
              <div class="h-80">
                <div v-if="post.images" class="h-full">
                  <div v-for=" image in post.images" :key="image.id" class="h-full">
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
      </div>
    </template>

    <!-- サイドバー -->
    <template v-if="sideBer">
      <div id="side_ber" class="bg-yellow-200 h-auto p-5 border-l border-black">
        <h2 class=" text-2xl font-bold m-6">人気ランキング</h2>
        <div v-if="popularPosts" class="">
          <div v-for=" popularPost in popularPosts" :key="popularPost.id" class="">
            <Link :href="route('post.show', popularPost.id)">

            <article class="article-border-position p-5 border border-black">
              <p class=" pt-2 pb-2 font-bold">{{ popularPost.title }}</p>
              <div class="h-80">
                <div v-if="popularPost.images" class="h-full">
                  <div v-for=" image in popularPost.images" :key="image.id" class="h-full">
                    <img :src="image.path" alt="画像" class="w-full h-full object-cover">
                  </div>
                </div>
              </div>
              <p class="pt-2 pb-2">{{ popularPost.content }}</p>
              <div>{{ popularPost.reviews_count }}件</div>
              <div>
                <div v-if="popularPost.rating[0]">{{ popularPost.rating[0].avg_review }}</div>
                <div v-else> 0.00 </div>
              </div>
            </article>
            </Link>
          </div>
        </div>
      </div>
    </template>
  </div>

  <div class="mt-5 mb-10 flex justify-center">
    <Link class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" :href="route('posts')">投稿一覧へ</Link>
  </div>
</template>

<style>
.main_image {
    background-image: url("../images/top1.jpg");
    background-size: cover;
    background-position: top;
}
.main_image .inner_musk {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.3);
}
.header_text {
  color: white;
}

.article-border-position {
  margin-top: -1px;
  margin-left: -1px;
}
</style>

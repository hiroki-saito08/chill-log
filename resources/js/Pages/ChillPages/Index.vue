<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Search from '@/Components/Search.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  posts: Object,
  popularPosts: Object
});

const mainBer = true;
const sideBer = true;

</script>

<template>
  <Head title="Top" />
  <div class="position: relative h-svh w-full main_image mb-5">
    <div class="inner_musk">
      <Header :authProps=props page="top"></Header>
      <!-- 検索バー -->
      <Search></Search>
    </div>
  </div>

  <div class="md:flex">
    <!-- メインバー -->
    <template v-if="mainBer">
      <div id="main-ber" class="p-5">
        <h2 class="text-2xl font-bold mb-6 pl-3">新規投稿</h2>
        <div v-if="posts" class="md:grid grid-cols-2">
          <div v-for=" post in posts" :key="post.id" class="m-3">
            <Link :href="route('post.show', post.id)">

            <article class="p-5 border">
              <div class="pb-2 border-b">
                <h2 class="text-lg pt-2 pb-2 font-bold">「{{ post.title }}」</h2>
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
      </div>
    </template>

    <!-- サイドバー -->
    <template v-if="sideBer">
      <div id="side_ber" class="h-auto p-5">
        <h2 class=" text-2xl font-bold mb-8 pl-6">人気ランキング</h2>
        <div v-if="popularPosts" class="">
          <div v-for="(popularPost, i) in popularPosts" :key="popularPost.id" class="m-3">
            <Link :href="route('post.show', popularPost.id)">
            <h2 class="font-bold">{{ i+1 }} 位</h2>

            <article class="p-5">
              <div class="pb-2 border-b">
                <p class="pt-2 pb-2 font-bold">{{ popularPost.title }}</p>
              </div>
              <div class="h-80 pt-3 pb-3">
                <div v-if="popularPost.images.length" class=" h-full">
                  <div v-for=" image in popularPost.images" :key="image.id" class="h-full">
                    <img :src="image.path" alt="画像" class="w-full h-full object-cover">
                  </div>
                </div>
                <div v-else> 画像なし </div>
              </div>

              <div class="flex justify-between pt-2 border-t">
                <div>コメント: {{ popularPost.reviews_count }}件</div>
                <div>
                  評価:
                  <span v-if="popularPost.avg_review">{{ popularPost.avg_review }}</span>
                  <span v-else> 0.00 </span>
                </div>
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
    background-image: url("../../../../public/images/top1.JPG");
    background-size: cover;
    background-position: top;
}
.main_image .inner_musk {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.3);
}
</style>

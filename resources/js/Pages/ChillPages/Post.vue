
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
  post: Object,
  canLogin: Boolean,
  canRegister: Boolean
});

console.log(props.post);

</script>

<template>
  <Head title="投稿詳細画面" />
  <Header :authProps=props></Header>
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
  <Link href="/">戻る</Link>
</template>

<style></style>

<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  authProps: Array
})

const searchWord = ref("");

const sendSearch = () => {
  Inertia.post(route('posts.search'), {
    searchWord: searchWord.value,
  });
}
</script>

<template>
  <!-- 検索バー -->
  <div class="sm-search-area">
    <div class="sm-search-area-inner mx-auto md:flex md:flex-wrap justify-around h-14 md:w-3/5">
      <input type="text" id="searchWord" v-model="searchWord" name="searchWord" class="mx-auto w-3/5 block bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      <button @click="sendSearch" class="mx-auto block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
    </div>
  </div>
</template>

<style>
@media screen and (max-width:768px) {
.sm-search-area {
    height: 70%;
    display: flex;
    align-items: center;
  }
  .sm-search-area-inner {
    width: 100%;
    height: 40%;
  }
  .sm-search-area-inner input {
    margin-top: 50px;
    margin-bottom: 50px;
    height: 50px;
    width: 70%;
  }
}
</style>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  links: Array
})

const links = props.links

</script>
<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1 justify-center">
      <template v-for="(link, p) in links" :key="p">
        <div v-if="p === 0" class="mr-1 mb-1 px-4 py-3" />
        <div v-else-if="p === links.length -1" class="mr-1 mb-1 px-4 py-3" />
        <div v-else-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
        <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-yellow-400 focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-blue-700 text-white hover:bg-blue-600': link.active }" :href="link.url" v-html="link.label">
        </Link>
      </template>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  links: {
    type: Array,
    required: true
  }
})

function formatLabel(label) {
  if (/previous/i.test(label)) return '«'
  if (/next/i.test(label)) return '»'
  return label
}
</script>

<template>
  <div class="pagination-wrapper">
    <ul class="pagination">
      <li
        v-for="link in links"
        :key="link.label"
        :class="['page-item', { active: link.active, disabled: !link.url }]"
      >
        <Link
          v-if="link.url"
          :href="link.url"
          class="page-link"
          v-html="formatLabel(link.label)"
        />
        <span v-else class="page-link" v-html="formatLabel(link.label)"></span>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.pagination-wrapper {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}

.pagination .page-item {
  margin: 0 5px;
}

.pagination .page-link {
  padding: 8px 12px;
  background: #6C7A89;
  color: white;
  border-radius: 5px;
  text-decoration: none;
  font-weight: bold;
}

.pagination .page-item.active .page-link {
  background: #88B04B;
}

.pagination .page-item.disabled .page-link {
  background: #ccc;
  cursor: not-allowed;
}
</style>

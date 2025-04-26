<script setup>
import { ref } from 'vue'

const show = ref(false)
const message = ref('')
const type = ref('success') // 'success' or 'error'

function triggerToast(msg, toastType = 'success') {
  message.value = msg
  type.value = toastType
  show.value = true
  setTimeout(() => show.value = false, 3000)
}

defineExpose({ triggerToast })
</script>

<template>
  <div v-if="show" :class="['my-toast', type]" @click="show = false">
    {{ message }}
  </div>
</template>

<style scoped>
.my-toast {
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #48c78e;
  color: white;
  padding: 20px 30px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  z-index: 9999;
  cursor: pointer;
  transition: opacity 0.3s;
}
.my-toast.error {
  background-color: #f14668;
}
</style>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const showOptions = ref(false);
const currentUrl = window.location.href;
const encodedUrl = encodeURIComponent(currentUrl);

const toggleShareOptions = () => {
  showOptions.value = !showOptions.value;
  console.log(showOptions.value);
};

const copyToClipboard = async () => {
  try {
    await navigator.clipboard.writeText(currentUrl);
    alert('Link copied!');
    showOptions.value = false;
  } catch (err) {
    console.error('Copy failed:', err);
  }
};

const shareViaAPI = async () => {
  if (navigator.share) {
    try {
      await navigator.share({
        title: 'Check out this Chill Spot!',
        url: currentUrl,
      });
    } catch (error) {
      console.error('Share canceled or failed:', error);
    }
  } else {
    alert('Your browser does not support native sharing.');
  }
  showOptions.value = false;
};

// ポップアップ外をクリックで閉じる
const popup = ref(null);
const closeOnOutsideClick = (e) => {
  if (popup.value && popup.value.contains(e.target)) return;
  if (e.target.closest('.share-wrapper')) return;

  showOptions.value = false;
};

onMounted(() => {
  document.addEventListener('click', closeOnOutsideClick);
});
onBeforeUnmount(() => {
  document.removeEventListener('click', closeOnOutsideClick);
});
</script>

<template>
  <div class="share-wrapper">
    <button class="btn share-btn" @click="toggleShareOptions">Share</button>

    <div v-if="showOptions" class="share-popup" ref="popup">
      <a
        :href="`https://x.com/share?url=${encodedUrl}&text=Check out this chill spot!`"
        target="_blank"
        rel="noopener noreferrer"
        class="share-link"
      >X</a>

      <a
        :href="`https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`"
        target="_blank"
        rel="noopener noreferrer"
        class="share-link"
      >Facebook</a>

      <button class="share-link" @click="copyToClipboard">Copy Link</button>
      <button class="share-link" @click="shareViaAPI">Native Share</button>
    </div>
  </div>
</template>

<style scoped>
.share-wrapper {
  position: relative;
  display: inline-block;
}

.share-popup {
  position: absolute;
  top: 40px;
  right: 0;
  background: white;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  padding: 10px;
  z-index: 1000;
  display: flex;
  flex-direction: column;
  gap: 10px;
  min-width: 180px;
}

.share-link {
  text-align: left;
  padding: 8px 12px;
  border: none;
  background: none;
  color: #333;
  font-size: 15px;
  cursor: pointer;
  transition: background 0.2s;
  text-decoration: none;
}

.share-link:hover {
  background: #f4f4f4;
}

.share-btn {
  background-color: #88B04B;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
}
</style>

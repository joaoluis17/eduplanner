<template>
  <button
    v-if="isVisible"
    @click="scrollToTop"
    type="button"
    :class="[
      'fixed bottom-4 right-4 p-3 bg-green-300 text-white rounded-full shadow-lg hover:bg-green-700 focus:outline-none transition-opacity duration-300',
      customClass,
    ]"
    :aria-label="ariaLabel"
  >
    {{ label }}
  </button>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

interface Props {
  threshold?: number;
  label?: string;
  ariaLabel?: string;
  customClass?: string;
}

const props = defineProps<Props>();

const isVisible = ref(false);
const threshold = props.threshold ?? 300;
const label = props.label ?? 'Topo ↑';
const ariaLabel = props.ariaLabel ?? 'Voltar para o topo';
const customClass = props.customClass ?? '';

function checkScrollPosition() {
  isVisible.value = window.scrollY > threshold;
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

onMounted(() => {
  checkScrollPosition();
  window.addEventListener('scroll', checkScrollPosition, { passive: true });
});

onUnmounted(() => {
  window.removeEventListener('scroll', checkScrollPosition);
});
</script>

<style scoped>
button {
  opacity: 1;
}

button:hover {
  opacity: 0.85;
}

button[disabled] {
  cursor: not-allowed;
  opacity: 0.5;
}
</style>

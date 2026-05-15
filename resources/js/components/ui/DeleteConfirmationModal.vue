<script setup lang="ts">
const props = defineProps({
  visible: { type: Boolean, required: true },
  title: { type: String, default: 'Confirmar ação' },
  message: { type: String, required: true },
  confirmLabel: { type: String, default: 'Confirmar' },
  cancelLabel: { type: String, default: 'Cancelar' },
  isLoading: { type: Boolean, default: false },
});

const emit = defineEmits(['confirm', 'cancel']);

function onConfirm() {
  emit('confirm');
}

function onCancel() {
  emit('cancel');
}
</script>

<template>
  <div v-if="visible" @click.self="onCancel" @keydown.window.escape="onCancel" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 px-4 py-6">
    <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-700 dark:bg-slate-900" @click.stop>
      <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">{{ title }}</h2>
      <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ message }}</p>

      <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
        <button
          type="button"
          @click="onCancel"
          class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
        >
          {{ cancelLabel }}
        </button>

        <button
          type="button"
          @click="onConfirm"
          :disabled="isLoading"
          class="inline-flex items-center justify-center rounded-full bg-red-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-500 disabled:cursor-not-allowed disabled:opacity-50"
        >
          {{ confirmLabel }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
  modelValue: { type: String, default: '' },
  label: { type: String, default: '' },
  placeholder: { type: String, default: '' },
  name: { type: String, default: '' },
  rows: { type: Number, default: 4 },
});

const emit = defineEmits(['update:modelValue']);

function updateValue(value: string) {
  emit('update:modelValue', value);
}
</script>

<template>
  <div class="space-y-2">
    <label v-if="label" :for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-200">
      {{ label }}
    </label>
    <textarea
      :id="name"
      :name="name"
      :rows="rows"
      :placeholder="placeholder"
      :value="modelValue"
      @input="updateValue($event.target.value)"
      class="block w-full rounded-2xl border border-slate-200 bg-white px-3 py-2 text-slate-900 shadow-sm outline-none transition duration-150 ease-in-out focus:border-slate-400 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-slate-500 dark:focus:ring-slate-700"
    />
  </div>
</template>

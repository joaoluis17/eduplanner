<script setup lang="ts">
const props = defineProps({
  modelValue: { type: String, default: '' },
  label: { type: String, default: '' },
  placeholder: { type: String, default: '' },
  name: { type: String, default: '' },
  type: { type: String, default: 'text' },
  required: { type: Boolean, default: false },
  error: { type: String, default: '' },
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
    <input
      :id="name"
      :name="name"
      :type="type"
      :placeholder="placeholder"
      :required="required"
      :value="modelValue"
      @input="updateValue($event.target.value)"
      :class="[
        'block w-full rounded-2xl border px-3 py-2 text-slate-900 shadow-sm outline-none transition duration-150 ease-in-out focus:ring-2 dark:bg-slate-900 dark:text-slate-100 dark:focus:ring-slate-700',
        error ? 'border-red-500 focus:border-red-500 focus:ring-red-200 dark:border-red-500 dark:focus:border-red-400' : 'border-slate-200 focus:border-slate-400 focus:ring-slate-200 dark:border-slate-700 dark:focus:border-slate-500',
      ]"
    />
    <p v-if="error" class="mt-2 text-sm text-red-600 dark:text-red-300">{{ error }}</p>
  </div>
</template>

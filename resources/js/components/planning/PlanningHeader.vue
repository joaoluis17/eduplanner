<script setup lang="ts">
import BaseInput from '../ui/BaseInput.vue';

import type { WeeklyPlanning } from '../../types/WeeklyPlanning';

const props = defineProps({
  planning: { type: Object as () => WeeklyPlanning, required: true },
  fieldErrors: { type: Object as () => Record<string, string>, required: true },
});
</script>

<template>
  <div class="grid gap-4 lg:grid-cols-4">
    <BaseInput
      class="col-span-2"
      label="Escola"
      name="school_name"
      placeholder="Nome da escola"
      v-model="planning.school_name"
      required
      :error="fieldErrors.school_name"
    />
    <BaseInput
      label="Professor(a)"
      name="teacher_name"
      placeholder="Nome do professor(a)"
      v-model="planning.teacher_name"
      required
      :error="fieldErrors.teacher_name"
    />
    <BaseInput
      label="Segmento"
      name="segment"
      placeholder="Ex: Ensino Fundamental"
      v-model="planning.segment"
      required
      :error="fieldErrors.segment"
    />
    <BaseInput
      label="Data da semana"
      name="week_date"
      type="date"
      v-model="planning.week_date"
      required
      :error="fieldErrors.week_date"
    />
  </div>
</template>
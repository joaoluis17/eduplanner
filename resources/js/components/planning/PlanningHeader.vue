<script setup lang="ts">
import BaseInput from '../ui/BaseInput.vue';

import type { WeeklyPlanning } from '../../types/WeeklyPlanning';

const props = defineProps({
  planning: { type: Object as () => WeeklyPlanning, required: true },
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
    />
    <BaseInput
      label="Professor(a)"
      name="teacher_name"
      placeholder="Nome do professor(a)"
      v-model="planning.teacher_name"
    />
    <BaseInput
      label="Segmento"
      name="segment"
      placeholder="Ex: Ensino Fundamental"
      v-model="planning.segment"
    />
    <BaseInput
      label="Data da semana"
      name="week_date"
      type="date"
      v-model="planning.week_date"
    />
  </div>
</template>
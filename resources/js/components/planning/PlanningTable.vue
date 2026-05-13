<script setup lang="ts">
import BaseTextarea from '../ui/BaseTextarea.vue';
import type { WeeklyPlanning } from '../../types/WeeklyPlanning';

const props = defineProps({
  planning: { type: Object as () => WeeklyPlanning, required: true },
});

const days = [
  { key: 'monday', label: 'Segunda' },
  { key: 'tuesday', label: 'Terça' },
  { key: 'wednesday', label: 'Quarta' },
  { key: 'thursday', label: 'Quinta' },
  { key: 'friday', label: 'Sexta' },
];

function fieldName(day: string, field: string) {
  return `${day}_${field}` as const;
}
</script>

<template>
  <div class="space-y-4">
    <div
      v-for="day in days"
      :key="day.key"
      class="rounded-3xl border border-slate-200 bg-slate-50 p-4 shadow-sm dark:border-slate-700 dark:bg-slate-950"
    >
      <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">{{ day.label }}</h3>

      <div class="mt-4 grid gap-4 lg:grid-cols-2">
        <BaseTextarea
          label="Leitura"
          :name="fieldName(day.key, 'reading')"
          placeholder="Descrição da leitura"
          rows="3"
          v-model="props.planning[`${day.key}_reading`]"
        />

        <BaseTextarea
          label="Objetivos de aprendizagem"
          :name="fieldName(day.key, 'learning_objectives')"
          placeholder="Objetivos para o dia"
          rows="3"
          v-model="props.planning[`${day.key}_learning_objectives`]"
        />

        <BaseTextarea
          label="Proposta pedagógica"
          :name="fieldName(day.key, 'pedagogical_proposal')"
          placeholder="Resumo das atividades"
          rows="3"
          v-model="props.planning[`${day.key}_pedagogical_proposal`]"
        />

        <BaseTextarea
          label="Desenvolvimento"
          :name="fieldName(day.key, 'development')"
          placeholder="Como o conteúdo será desenvolvido"
          rows="3"
          v-model="props.planning[`${day.key}_development`]"
        />

        <BaseTextarea
          label="Horário de especialistas"
          :name="fieldName(day.key, 'specialists_schedule')"
          placeholder="Atividades com especialistas"
          rows="3"
          v-model="props.planning[`${day.key}_specialists_schedule`]"
        />
      </div>
    </div>
  </div>
</template>
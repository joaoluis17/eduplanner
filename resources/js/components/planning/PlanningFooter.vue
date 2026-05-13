<script setup lang="ts">
import BaseTextarea from '../ui/BaseTextarea.vue';
import type { WeeklyPlanning } from '../../types/WeeklyPlanning';

const props = defineProps({
  planning: { type: Object as () => WeeklyPlanning, required: true },
});
</script>

<template>
  <div class="space-y-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-950">
    <div class="grid gap-4 lg:grid-cols-3">
      <BaseTextarea
        label="Relatório semanal"
        name="weekly_report"
        placeholder="Observações gerais da semana"
        rows="4"
        v-model="planning.weekly_report"
      />
      <BaseTextarea
        label="Solicitação de materiais"
        name="materials_request"
        placeholder="Materiais necessários"
        rows="4"
        v-model="planning.materials_request"
      />
      <BaseTextarea
        label="Feedback da coordenação"
        name="coordinator_feedback"
        placeholder="Comentários da coordenação"
        rows="4"
        v-model="planning.coordinator_feedback"
      />
    </div>
  </div>
</template>
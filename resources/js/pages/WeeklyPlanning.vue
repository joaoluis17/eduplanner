<template>
  <Layout>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
          <h1 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">
            Planejamento Semanal
          </h1>
          <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
            Edite as metas e atividades para a próxima semana.
          </p>
        </div>
      </div>

      <div class="mt-6 space-y-6">
        <div
          v-if="notification"
          class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
        >
          {{ notification }}
        </div>

        <PlanningHeader :planning="planning" />
        <PlanningTable :planning="planning" />
        <PlanningFooter :planning="planning" />
      </div>
      <button
          type="button"
          @click="handleSave"
          :disabled="loading"
          class="inline-flex items-center justify-center rounded-full right-10 bg-slate-900 px-5 py-2.5 mt-2 text-sm font-semibold text-white transition hover:bg-slate-700 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-slate-100 dark:text-slate-950 dark:hover:bg-slate-200"
        >
          {{ loading ? 'Salvando...' : 'Salvar plano' }}
        </button>

      <BackToTopButton />
    </div>
  </Layout>
</template>

<script setup lang="ts">
import { onMounted, reactive, ref } from 'vue';

import BackToTopButton from '../components/BackToTopButton.vue';
import Layout from '../components/Layout.vue';
import PlanningFooter from '../components/planning/PlanningFooter.vue';
import PlanningHeader from '../components/planning/PlanningHeader.vue';
import PlanningTable from '../components/planning/PlanningTable.vue';
import { createEmptyWeeklyPlanning, type WeeklyPlanning } from '../types/WeeklyPlanning';
import { listWeeklyPlannings, saveWeeklyPlanning } from '../services/weeklyPlanningService';

const planning = reactive<WeeklyPlanning>(createEmptyWeeklyPlanning());
const loading = ref(false);
const notification = ref('');

async function loadLatestPlanning() {
  loading.value = true;
  notification.value = '';

  try {
    const items = await listWeeklyPlannings();
    if (items.length > 0) {
      Object.assign(planning, items[0]);
    }
  } catch (error) {
    notification.value = 'Não foi possível carregar o planejamento. Tente novamente.';
  } finally {
    loading.value = false;
  }
}

async function handleSave() {
  loading.value = true;
  notification.value = '';

  try {
    const saved = await saveWeeklyPlanning(planning);
    Object.assign(planning, saved);
    notification.value = 'Planejamento salvo com sucesso.';
  } catch (error) {
    notification.value = 'Erro ao salvar o planejamento. Verifique a conexão e tente novamente.';
  } finally {
    loading.value = false;
  }
}

onMounted(loadLatestPlanning);
</script>

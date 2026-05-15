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
          <p>{{ notification }}</p>
          <ul v-if="validationErrors.length" class="mt-3 list-disc space-y-1 pl-5 text-sm text-slate-700 dark:text-slate-200">
            <li v-for="(error, index) in validationErrors" :key="index">{{ error }}</li>
          </ul>
        </div>

        <PlanningHeader :planning="planning" :field-errors="fieldErrors" />
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
import { loadWeeklyPlanning, saveWeeklyPlanning } from '../services/weeklyPlanningService';

const planning = reactive<WeeklyPlanning>(createEmptyWeeklyPlanning());
const loading = ref(false);
const notification = ref('');
const validationErrors = ref<string[]>([]);
const fieldErrors = ref<Record<string, string>>({
  school_name: '',
  teacher_name: '',
  segment: '',
  week_date: '',
});
const initialPlanId = Number(new URLSearchParams(window.location.search).get('id'));

async function loadPlanningById(id: number) {
  loading.value = true;
  notification.value = '';

  try {
    const saved = await loadWeeklyPlanning(id);
    Object.assign(planning, saved);
  } catch (error) {
    notification.value = 'Não foi possível carregar o plano selecionado. Verifique se ele existe.';
  } finally {
    loading.value = false;
  }
}

function clearFieldErrors() {
  fieldErrors.value = {
    school_name: '',
    teacher_name: '',
    segment: '',
    week_date: '',
  };
}

function validateRequiredFields() {
  validationErrors.value = [];
  clearFieldErrors();

  if (!planning.school_name.trim()) {
    validationErrors.value.push('O nome da escola é obrigatório.');
    fieldErrors.value.school_name = 'Preencha o nome da escola.';
  }
  if (!planning.teacher_name.trim()) {
    validationErrors.value.push('O nome do professor é obrigatório.');
    fieldErrors.value.teacher_name = 'Preencha o nome do professor.';
  }
  if (!planning.segment.trim()) {
    validationErrors.value.push('O segmento é obrigatório.');
    fieldErrors.value.segment = 'Preencha o segmento.';
  }
  if (!planning.week_date.trim()) {
    validationErrors.value.push('A data da semana é obrigatória.');
    fieldErrors.value.week_date = 'Preencha a data da semana.';
  }

  if (validationErrors.value.length > 0) {
    notification.value = 'Preencha os campos obrigatórios antes de salvar.';
    return false;
  }

  return true;
}

async function handleSave() {
  validationErrors.value = [];
  clearFieldErrors();

  if (!validateRequiredFields()) {
    return;
  }

  loading.value = true;
  notification.value = '';

  try {
    const saved = await saveWeeklyPlanning(planning);
    Object.assign(planning, saved);
    notification.value = 'Planejamento salvo com sucesso.';
    window.location.href = '/planning-list';
  } catch (error) {
    const apiError = error as Error & { errors?: Record<string, string[]> };
    if (apiError.errors) {
      validationErrors.value = Object.values(apiError.errors).flat();
      clearFieldErrors();
      for (const [field, messages] of Object.entries(apiError.errors)) {
        if (field in fieldErrors.value) {
          fieldErrors.value[field] = messages.join(' ');
        }
      }
      notification.value = 'Corrija os dados obrigatórios e tente novamente.';
    } else {
      notification.value = 'Erro ao salvar o planejamento. Verifique a conexão e tente novamente.';
    }
  } finally {
    loading.value = false;
  }
}

onMounted(() => {
  if (Number.isFinite(initialPlanId) && initialPlanId > 0) {
    loadPlanningById(initialPlanId);
  }
});
</script>

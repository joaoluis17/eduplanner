<template>
  <Layout>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
          <h1 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">
            Lista de Planejamentos
          </h1>
          <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
            Aqui estão todos os planos salvos.
          </p>
        </div>

        <Link
          href="/weekly-planning"
          class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-950 dark:hover:bg-slate-200"
        >
          Criar novo Planejamento Semanal
        </Link>
      </div>

      <div class="mt-6 space-y-6">
        <div
          v-if="notification"
          class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"
        >
          {{ notification }}
        </div>

        <div v-if="loading" class="rounded-2xl border border-slate-200 bg-white p-6 text-sm text-slate-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
          Carregando planejamentos...
        </div>

        <div v-else-if="plans.length === 0" class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-sm text-slate-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
          Nenhum planejamento salvo ainda. Salve um plano e ele aparecerá aqui.
        </div>

        <div v-else class="grid gap-4 md:grid-cols-2">
          <div v-for="plan in plans" :key="plan.id" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md dark:border-slate-700 dark:bg-slate-900">
            <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
              <div class="min-w-0">
                <p class="text-sm uppercase tracking-wide text-slate-500 dark:text-slate-400">{{ plan.segment || 'Segmento não informado' }}</p>
                <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100 truncate">{{ plan.school_name || 'Nome da escola não informado' }}</h2>
              </div>
              <div class="flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                  {{ formatDate(plan.week_date) }}
                </span>
                <button
                  type="button"
                  @click="openDetails(plan)"
                  class="rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-950 dark:hover:bg-slate-200"
                >
                  Detalhes
                </button>
                <button
                  type="button"
                  @click="handleEdit(plan.id!)"
                  class="rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-blue-500"
                >
                  Editar
                </button>
                <button
                  type="button"
                  @click="handleDelete(plan.id!)"
                  :disabled="loading"
                  title="Excluir plano"
                  class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white transition hover:bg-red-500 disabled:cursor-not-allowed disabled:opacity-50"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                    <path fill="currentColor" d="M9 3V4H4V6H5V19A2 2 0 0 0 7 21H17A2 2 0 0 0 19 19V6H20V4H15V3H9ZM7 6H17V19H7ZM9 8V17H11V8ZM13 8V17H15V8Z" />
                  </svg>
                </button>
              </div>
            </div>

            <div class="grid gap-4 text-sm text-slate-700 dark:text-slate-300 sm:grid-cols-2">
              <p><span class="font-semibold">Professor:</span> {{ plan.teacher_name || 'Não informado' }}</p>
              <p><span class="font-semibold">Observação semanal:</span> {{ plan.weekly_report || 'Sem relatório' }}</p>
              <p><span class="font-semibold">Solicitação de materiais:</span> {{ plan.materials_request || 'Sem solicitações' }}</p>
            </div>
          </div>
        </div>
      </div>

      <div v-if="selectedPlan" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 px-4 py-6">
        <div class="w-full max-w-3xl overflow-hidden rounded-3xl bg-white shadow-2xl dark:bg-slate-900">
          <div class="flex items-start justify-between gap-4 border-b border-slate-200 p-6 dark:border-slate-700">
            <div>
              <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">{{ selectedPlan.segment || 'Segmento não informado' }}</p>
              <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">{{ selectedPlan.school_name || 'Nome da escola não informado' }}</h2>
              <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ formatDate(selectedPlan.week_date) }}</p>
            </div>
            <button
              type="button"
              @click="closeDetails"
              class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
            >
              ×
            </button>
          </div>

          <div class="p-6 text-sm text-slate-700 dark:text-slate-300">
            <div class="grid gap-4 sm:grid-cols-2">
              <div>
                <p class="font-semibold text-slate-900 dark:text-slate-100">Professor</p>
                <p>{{ selectedPlan.teacher_name || 'Não informado' }}</p>
              </div>
              <div>
                <p class="font-semibold text-slate-900 dark:text-slate-100">Observação semanal</p>
                <p>{{ selectedPlan.weekly_report || 'Sem relatório' }}</p>
              </div>
              <div>
                <p class="font-semibold text-slate-900 dark:text-slate-100">Solicitação de materiais</p>
                <p>{{ selectedPlan.materials_request || 'Sem solicitações' }}</p>
              </div>
              <div>
                <p class="font-semibold text-slate-900 dark:text-slate-100">Data</p>
                <p>{{ formatDate(selectedPlan.week_date) }}</p>
              </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
              <div>
                <p class="font-semibold text-slate-900 dark:text-slate-100">Segunda</p>
                <p><span class="font-semibold">Leitura:</span> {{ selectedPlan.monday_reading || '—' }}</p>
                <p><span class="font-semibold">Objetivos:</span> {{ selectedPlan.monday_learning_objectives || '—' }}</p>
                <p><span class="font-semibold">Proposta:</span> {{ selectedPlan.monday_pedagogical_proposal || '—' }}</p>
              </div>
              <div>
                <p class="font-semibold text-slate-900 dark:text-slate-100">Terça</p>
                <p><span class="font-semibold">Leitura:</span> {{ selectedPlan.tuesday_reading || '—' }}</p>
                <p><span class="font-semibold">Objetivos:</span> {{ selectedPlan.tuesday_learning_objectives || '—' }}</p>
                <p><span class="font-semibold">Proposta:</span> {{ selectedPlan.tuesday_pedagogical_proposal || '—' }}</p>
              </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
              <div>
                <p class="font-semibold text-slate-900 dark:text-slate-100">Quarta</p>
                <p><span class="font-semibold">Leitura:</span> {{ selectedPlan.wednesday_reading || '—' }}</p>
                <p><span class="font-semibold">Objetivos:</span> {{ selectedPlan.wednesday_learning_objectives || '—' }}</p>
                <p><span class="font-semibold">Proposta:</span> {{ selectedPlan.wednesday_pedagogical_proposal || '—' }}</p>
              </div>
              <div>
                <p class="font-semibold text-slate-900 dark:text-slate-100">Quinta</p>
                <p><span class="font-semibold">Leitura:</span> {{ selectedPlan.thursday_reading || '—' }}</p>
                <p><span class="font-semibold">Objetivos:</span> {{ selectedPlan.thursday_learning_objectives || '—' }}</p>
                <p><span class="font-semibold">Proposta:</span> {{ selectedPlan.thursday_pedagogical_proposal || '—' }}</p>
              </div>
            </div>

            <div class="mt-6">
              <p class="font-semibold text-slate-900 dark:text-slate-100">Sexta</p>
              <p><span class="font-semibold">Leitura:</span> {{ selectedPlan.friday_reading || '—' }}</p>
              <p><span class="font-semibold">Objetivos:</span> {{ selectedPlan.friday_learning_objectives || '—' }}</p>
              <p><span class="font-semibold">Proposta:</span> {{ selectedPlan.friday_pedagogical_proposal || '—' }}</p>
            </div>

            <div class="mt-6 flex justify-end">
              <button
                type="button"
                @click="closeDetails"
                class="inline-flex rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-950 dark:hover:bg-slate-200"
              >
                Fechar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Layout from '../components/Layout.vue';
import type { WeeklyPlanning } from '../types/WeeklyPlanning';
import { deleteWeeklyPlanning, listWeeklyPlannings } from '../services/weeklyPlanningService';

const plans = ref<WeeklyPlanning[]>([]);
const loading = ref(false);
const notification = ref('');
const selectedPlan = ref<WeeklyPlanning | null>(null);

async function loadPlannings() {
  loading.value = true;
  notification.value = '';

  try {
    plans.value = await listWeeklyPlannings();
  } catch (error) {
    notification.value = 'Não foi possível carregar a listagem de planos. Tente novamente.';
  } finally {
    loading.value = false;
  }
}

function openDetails(plan: WeeklyPlanning) {
  selectedPlan.value = plan;
}

function closeDetails() {
  selectedPlan.value = null;
}

async function handleDelete(id: number) {
  const confirmed = window.confirm('Deseja realmente excluir este plano?');
  if (!confirmed) {
    return;
  }

  loading.value = true;
  notification.value = '';

  try {
    await deleteWeeklyPlanning(id);
    notification.value = 'Plano excluído com sucesso.';
    if (selectedPlan.value?.id === id) {
      selectedPlan.value = null;
    }
    await loadPlannings();
  } catch (error) {
    notification.value = 'Não foi possível excluir o plano. Tente novamente.';
  } finally {
    loading.value = false;
  }
}

function handleEdit(id: number) {
  window.location.href = `/weekly-planning?id=${id}`;
}

function formatDate(dateString: string) {
  if (!dateString) {
    return 'Sem data';
  }

  const date = new Date(dateString);
  if (Number.isNaN(date.getTime())) {
    return 'Sem data';
  }

  return new Intl.DateTimeFormat('pt-BR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  }).format(date);
}

onMounted(loadPlannings);
</script>

<template>
  <Layout>
    <div class="min-h-screen bg-slate-50 px-4 py-12 text-slate-800 dark:bg-slate-950 dark:text-slate-100">
      <div class="mx-auto max-w-3xl rounded-3xl border border-slate-200 bg-white p-10 shadow-lg dark:border-slate-700 dark:bg-slate-900">
        <h1 class="text-4xl font-semibold">EduPlanner</h1>
        <p class="mt-4 text-slate-600 dark:text-slate-400">
          Sua aplicação de planejamento semanal está pronta. Clique abaixo para abrir o planejador ou para ver a listagem de planos.
        </p>

        <div class="md:inline-flex space-x-2">
          <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <Link
              href="/weekly-planning"
              class="inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-950 dark:hover:bg-slate-200"
            >
              Ir para Planejamento Semanal
            </Link>
          </div>

          <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <Link
              href="/planning-list"
              class="inline-flex items-center justify-center rounded-full bg-blue-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-950 dark:hover:bg-slate-200"
            >
              Ir para Listagem de Planos
            </Link>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Layout from '../components/Layout.vue';
</script>

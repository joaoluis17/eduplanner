<template>
  <header class="bg-white shadow-sm border-b border-slate-200 dark:bg-slate-900 dark:border-slate-700">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 justify-between items-center">
        <!-- Logo Button -->
        <button
          @click="goToHome"
          class="flex items-center gap-2 text-slate-900 dark:text-slate-100 hover:text-slate-600 dark:hover:text-slate-300 transition-colors"
        >
          <img
            src="../../css/assets/logo-eduplanner.svg"
            alt="EduPlanner Logo"
            class="h-8 w-8"
          >
          <span class="font-semibold text-lg">EduPlanner</span>
        </button>

        <!-- Navigation -->
        <nav class="flex items-center space-x-4">
          <Link
            href="/weekly-planning"
            class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100 px-3 py-2 rounded-md text-sm font-medium transition-colors"
          >
            Planejamento Semanal
          </Link>
          <Link
            href="/planning-list"
            class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100 px-3 py-2 rounded-md text-sm font-medium transition-colors"
          >
            Lista de Planejamentos
          </Link>
        </nav>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

function goToHome() {
  // Navigate to home/dashboard page
  window.location.href = '/';
}
</script>
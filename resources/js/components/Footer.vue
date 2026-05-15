<template>
  <footer class="bg-white shadow-sm border-t border-slate-200 dark:bg-slate-900 dark:border-slate-700">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-4 py-4 md:flex-row md:items-center md:justify-between">
        <!-- Navigation -->
        <nav class="flex flex-wrap justify-center gap-2 md:gap-4">
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
        
        <!-- Direitos -->
        <p class="text-slate-500 dark:text-slate-400 text-sm text-center md:text-left">
          &copy; {{ new Date().getFullYear() }} EduPlanner. Todos os direitos reservados.
        </p>

        <!-- Logo Button -->
        <button
          @click="goToHome"
          class="mx-auto flex items-center gap-2 text-slate-900 dark:text-slate-100 hover:text-slate-600 dark:hover:text-slate-300 transition-colors duration-300 ease-in-out md:mx-0"
        >
          <img
            src="../../css/assets/logo-eduplanner.svg"
            alt="EduPlanner Logo"
            class="h-8 w-8 transition-transform duration-300 ease-in-out group-hover:scale-110"
          >
          <span class="font-semibold text-lg transition-colors duration-300 ease-in-out">EduPlanner</span>
        </button>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

function goToHome() {
  // Navigate to home/dashboard page
  window.location.href = '/';
}
</script>
<template>
  <header class="bg-white shadow-sm border-b border-slate-200 dark:bg-slate-900 dark:border-slate-700">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-3 py-3 md:flex-row md:h-16 md:justify-between md:items-center">
        <!-- Logo Button -->
        <div class="flex items-center justify-between">
          <button
            @click="goToHome"
            class="group flex items-center gap-2 text-slate-900 dark:text-slate-100 hover:text-slate-600 dark:hover:text-slate-300 transition-colors duration-300 ease-in-out"
          >
            <img
              src="../../css/assets/logo-eduplanner.svg"
              alt="EduPlanner Logo"
              class="h-8 w-8 transition-transform duration-300 ease-in-out group-hover:scale-110"
            >
            <span class="font-semibold text-lg transition-colors duration-300 ease-in-out">EduPlanner</span>
          </button>

          <button
            type="button"
            @click="toggleMenu"
            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-700 transition hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700 md:hidden"
            aria-label="Abrir menu"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
              <path fill="currentColor" d="M4 6H20V8H4V6ZM4 11H20V13H4V11ZM4 16H20V18H4V16Z" />
            </svg>
          </button>
        </div>

        <!-- Navigation -->
        <nav class="hidden flex-wrap justify-center gap-2 md:flex md:gap-4 md:flex-row">
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

        <div v-if="menuOpen" class="mt-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-lg dark:border-slate-700 dark:bg-slate-900 md:hidden">
          <nav class="flex flex-col gap-2">
            <Link
              href="/weekly-planning"
              class="block rounded-lg px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-slate-100"
              @click="toggleMenu"
            >
              Planejamento Semanal
            </Link>
            <Link
              href="/planning-list"
              class="block rounded-lg px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-slate-100"
              @click="toggleMenu"
            >
              Lista de Planejamentos
            </Link>
          </nav>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const menuOpen = ref(false);

function goToHome() {
  // Navigate to home/dashboard page
  window.location.href = '/';
}

function toggleMenu() {
  menuOpen.value = !menuOpen.value;
}
</script>
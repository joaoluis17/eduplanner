<template>
  <div>
    <Header />
    <main class="min-h-screen bg-slate-50 dark:bg-slate-800">
      <slot />
    </main>
  </div>
</template>

<script setup lang="ts">
import Header from './Header.vue';
</script>
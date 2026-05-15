<template>
  <div>
    <Header />
    <main class="min-h-screen bg-slate-50 dark:bg-slate-800">
      <slot />
    </main>
    <Footer />
  </div>
</template>

<script setup lang="ts">
import Footer from './Footer.vue';
import Header from './Header.vue';
</script>
<template>
  <div>
    <slot />
  </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue';

onMounted(() => {
  document.body.classList.add('hold-transition', 'login-page');
});

onUnmounted(() => {
  document.body.classList.remove('hold-transition', 'login-page');
});
</script>

<style scoped>
/* Additional custom styling for auth pages if needed */
</style>

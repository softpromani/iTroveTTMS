<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Faculties</h1>
    <DataTable :resource="'faculties'" :columns="columns" />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import DataTable from '@/Components/DataTable.vue';

const columns = ref([
  { key: 'id', label: 'ID' },
  { key: 'employee_code', label: 'Code' },
  { key: 'user.name', label: 'Name' },
  { key: 'department.name', label: 'Department' },
  { key: 'designation', label: 'Designation' },
  { key: 'actions', label: 'Actions', sortable: false, searchable: false },
]);
</script>

<style scoped>
/* Premium glassmorphism container */
div {
  background: rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(12px);
  border-radius: 12px;
  padding: 1.5rem;
}
</style>

<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Programs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Programs</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Manage Programs</h3>
            <Link href="/admin/programs/create" class="btn btn-primary btn-sm">Add New Program</Link>
          </div>
          <div class="card-body p-3">
            <DataTable :url="route('admin.programs.datatable')" :columns="columns">
              <template #actions="{ row }">
                <Link :href="`/admin/programs/${row.id}/edit`" class="btn btn-info btn-sm mr-1">
                  <i class="fas fa-pencil-alt"></i>
                </Link>
                <button @click="emitDelete(row.id)" class="btn btn-danger btn-sm">
                  <i class="fas fa-trash"></i>
                </button>
              </template>
            </DataTable>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import DataTable from '@/Components/DataTable.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

const columns = [
  { key: 'id', label: 'ID', searchable: true, sortable: true },
  { key: 'name', label: 'Name', searchable: true, sortable: true },
  { key: 'type', label: 'Program Type', searchable: true, sortable: true },
  { key: 'duration', label: 'Duration (Years)', searchable: false, sortable: true },
  { key: 'status', label: 'Status', searchable: false, sortable: true },
  { key: 'actions', label: 'Actions', sortable: false, searchable: false },
];

const emitDelete = (id) => {
  if (confirm('Are you sure you want to delete this item?')) {
    router.delete(`/admin/programs/${id}`);
  }
};
</script>

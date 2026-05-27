<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Time Slots</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><Link href="/admin">Home</Link></li>
              <li class="breadcrumb-item active">Time Slots</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Manage Time Slots</h3>
            <Link href="/admin/timetable-slots/create" class="btn btn-primary btn-sm">Add New Slot</Link>
          </div>
          <div class="card-body p-3">
            <DataTable :url="route('admin.timetable-slots.datatable')" :columns="columns">
              <template #actions="{ row }">
                <Link :href="`/admin/timetable-slots/${row.id}/edit`" class="btn btn-info btn-sm mr-1">
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
  { key: 'day', label: 'Day', searchable: true, sortable: true },
  { key: 'start_time', label: 'Start Time', searchable: false, sortable: true },
  { key: 'end_time', label: 'End Time', searchable: false, sortable: true },
  { key: 'slot_type', label: 'Type', searchable: true, sortable: true },
  { key: 'actions', label: 'Actions', sortable: false, searchable: false },
];

const emitDelete = (id) => {
  if (confirm('Are you sure you want to delete this time slot?')) {
    router.delete(`/admin/timetable-slots/${id}`);
  }
};
</script>

<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><Link href="/admin">Home</Link></li>
              <li class="breadcrumb-item active">Sections</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card bg-white my-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Manage Sections</h3>
            <Link href="/admin/sections/create" class="btn btn-primary btn-sm">Add New Section</Link>
          </div>
          <div class="card-body p-3">
            <DataTable :url="route('admin.sections.datatable')" :columns="columns" />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import DataTable from '@/Components/DataTable.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

const columns = [
  { key: 'id', label: 'ID', searchable: true, sortable: true },
  { key: 'name', label: 'Name', searchable: true, sortable: true },
  { key: 'program.name', label: 'Program', searchable: false, sortable: false },
  { key: 'semester.academic_year', label: 'Semester', searchable: false, sortable: false },
  { key: 'batch_year', label: 'Batch Year', searchable: false, sortable: true },
  { key: 'student_strength', label: 'Strength', searchable: false, sortable: true },
  { key: 'actions', label: 'Actions', searchable: false, sortable: false },
];
</script>

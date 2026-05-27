<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Elective Groups</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><Link href="/admin">Home</Link></li>
              <li class="breadcrumb-item active">Elective Groups</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary glassmorphism">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Groups</h3>
            <Link href="/admin/elective-groups/create" class="btn btn-success btn-sm">Create Group</Link>
          </div>
          <div class="card-body">
            <DataTable :url="route('admin.elective-groups.datatable')" :columns="columns" />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../../../../Layouts/AdminLayout.vue';
import DataTable from '../../../../Components/DataTable.vue';

defineOptions({ layout: AdminLayout });

const columns = [
  { data: 'id', title: 'ID' },
  { data: 'name', title: 'Name' },
  { data: 'description', title: 'Description' },
  { data: 'min_credits', title: 'Min Credits' },
  { data: 'max_credits', title: 'Max Credits' },
  { data: 'action', title: 'Actions', orderable: false, searchable: false },
];
</script>

<style scoped>
.glassmorphism { background: rgba(255,255,255,0.25); backdrop-filter: blur(12px); border-radius:12px; box-shadow:0 4px 30px rgba(0,0,0,0.1); }
</style>

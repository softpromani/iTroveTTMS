<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Department</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item"><Link href="/admin/departments">Departments</Link></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Department Details</h3>
          </div>
          <form @submit.prevent="submit">
            <div class="card-body">
              <div class="form-group">
                <label for="program_id">Program</label>
                <select id="program_id" v-model="form.program_id" class="form-control" :class="{ 'is-invalid': form.errors.program_id }">
                  <option value="" disabled>Select Program</option>
                  <option v-for="program in programs" :key="program.id" :value="program.id">
                    {{ program.name }}
                  </option>
                </select>
                <span class="error invalid-feedback">{{ form.errors.program_id }}</span>
              </div>
              <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" id="name" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.name }" placeholder="Enter Department Name">
                <span class="error invalid-feedback">{{ form.errors.name }}</span>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary" :disabled="form.processing">Update</button>
              <Link href="/admin/departments" class="btn btn-default float-right">Cancel</Link>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

const props = defineProps({
  department: Object,
  programs: Array,
});

const form = useForm({
  program_id: props.department.program_id,
  name: props.department.name,
  hod_id: props.department.hod_id,
});

const submit = () => {
  form.put(`/admin/departments/${props.department.id}`);
};
</script>

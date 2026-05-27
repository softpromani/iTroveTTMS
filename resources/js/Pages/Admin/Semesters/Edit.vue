<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Semester</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item"><Link href="/admin/semesters">Semesters</Link></li>
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
            <h3 class="card-title">Edit Semester Details</h3>
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
              
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="academic_year">Academic Year</label>
                  <input type="text" id="academic_year" v-model="form.academic_year" class="form-control" :class="{ 'is-invalid': form.errors.academic_year }">
                  <span class="error invalid-feedback">{{ form.errors.academic_year }}</span>
                </div>
                <div class="col-md-6 form-group">
                  <label for="name">Semester Name</label>
                  <input type="text" id="name" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.name }">
                  <span class="error invalid-feedback">{{ form.errors.name }}</span>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 form-group">
                  <label for="start_date">Start Date</label>
                  <input type="date" id="start_date" v-model="form.start_date" class="form-control" :class="{ 'is-invalid': form.errors.start_date }">
                  <span class="error invalid-feedback">{{ form.errors.start_date }}</span>
                </div>
                <div class="col-md-4 form-group">
                  <label for="end_date">End Date</label>
                  <input type="date" id="end_date" v-model="form.end_date" class="form-control" :class="{ 'is-invalid': form.errors.end_date }">
                  <span class="error invalid-feedback">{{ form.errors.end_date }}</span>
                </div>
                <div class="col-md-4 form-group">
                  <label for="duration_weeks">Duration (Weeks)</label>
                  <input type="number" id="duration_weeks" v-model="form.duration_weeks" class="form-control" :class="{ 'is-invalid': form.errors.duration_weeks }" min="1">
                  <span class="error invalid-feedback">{{ form.errors.duration_weeks }}</span>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary" :disabled="form.processing">Update</button>
              <Link href="/admin/semesters" class="btn btn-default float-right">Cancel</Link>
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
  semester: Object,
  programs: Array,
});

const form = useForm({
  program_id: props.semester.program_id,
  academic_year: props.semester.academic_year,
  name: props.semester.name,
  start_date: props.semester.start_date ? props.semester.start_date.substring(0, 10) : '',
  end_date: props.semester.end_date ? props.semester.end_date.substring(0, 10) : '',
  duration_weeks: props.semester.duration_weeks,
});

const submit = () => {
  form.put(`/admin/semesters/${props.semester.id}`);
};
</script>

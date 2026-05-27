<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item"><Link href="/admin/sections">Sections</Link></li>
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
            <h3 class="card-title">Edit Section Details</h3>
          </div>
          <form @submit.prevent="submit">
            <div class="card-body">
              <div class="form-group">
                <label for="program_id">Program</label>
                <select id="program_id" v-model="form.program_id" class="form-control" :class="{'is-invalid': form.errors.program_id}">
                  <option value="" disabled>Select Program</option>
                  <option v-for="program in programs" :key="program.id" :value="program.id">
                    {{ program.name }}
                  </option>
                </select>
                <span class="error invalid-feedback">{{ form.errors.program_id }}</span>
              </div>
              <div class="form-group">
                <label for="semester_id">Semester</label>
                <select id="semester_id" v-model="form.semester_id" class="form-control" :class="{'is-invalid': form.errors.semester_id}">
                  <option value="" disabled>Select Semester</option>
                  <option v-for="semester in semesters" :key="semester.id" :value="semester.id">
                    {{ semester.academic_year }}
                  </option>
                </select>
                <span class="error invalid-feedback">{{ form.errors.semester_id }}</span>
              </div>
              <div class="form-group">
                <label for="name">Section Name</label>
                <input type="text" id="name" v-model="form.name" class="form-control" :class="{'is-invalid': form.errors.name}" placeholder="Enter Section Name" />
                <span class="error invalid-feedback">{{ form.errors.name }}</span>
              </div>
              <div class="form-group">
                <label for="batch_year">Batch Year</label>
                <input type="number" id="batch_year" v-model="form.batch_year" class="form-control" :class="{'is-invalid': form.errors.batch_year}" placeholder="e.g., 2024" />
                <span class="error invalid-feedback">{{ form.errors.batch_year }}</span>
              </div>
              <div class="form-group">
                <label for="student_strength">Student Strength</label>
                <input type="number" id="student_strength" v-model="form.student_strength" class="form-control" :class="{'is-invalid': form.errors.student_strength}" placeholder="Number of students" />
                <span class="error invalid-feedback">{{ form.errors.student_strength }}</span>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary" :disabled="form.processing">Update</button>
              <Link href="/admin/sections" class="btn btn-default float-right">Cancel</Link>
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
  section: Object,
  programs: Array,
  semesters: Array,
});

const form = useForm({
  program_id: props.section.program_id,
  semester_id: props.section.semester_id,
  name: props.section.name,
  batch_year: props.section.batch_year,
  student_strength: props.section.student_strength,
});

const submit = () => {
  form.put(`/admin/sections/${props.section.id}`);
};
</script>

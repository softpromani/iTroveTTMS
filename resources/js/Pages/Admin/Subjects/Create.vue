<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Subject</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item"><Link href="/admin/subjects">Subjects</Link></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Subject Details</h3>
          </div>
          <form @submit.prevent="submit">
            <div class="card-body">
              <div class="form-group">
                <label for="department_id">Department</label>
                <select id="department_id" v-model="form.department_id" class="form-control" :class="{ 'is-invalid': form.errors.department_id }">
                  <option value="" disabled>Select Department</option>
                  <option v-for="dept in departments" :key="dept.id" :value="dept.id">
                    {{ dept.name }}
                  </option>
                </select>
                <span class="error invalid-feedback">{{ form.errors.department_id }}</span>
              </div>
              
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="subject_code">Subject Code</label>
                  <input type="text" id="subject_code" v-model="form.subject_code" class="form-control" :class="{ 'is-invalid': form.errors.subject_code }" placeholder="e.g., CS101">
                  <span class="error invalid-feedback">{{ form.errors.subject_code }}</span>
                </div>
                <div class="col-md-6 form-group">
                  <label for="subject_name">Subject Name</label>
                  <input type="text" id="subject_name" v-model="form.subject_name" class="form-control" :class="{ 'is-invalid': form.errors.subject_name }" placeholder="Enter Subject Name">
                  <span class="error invalid-feedback">{{ form.errors.subject_name }}</span>
                </div>
              </div>

              <div class="row">
                <div class="col-md-3 form-group">
                  <label for="credits">Credits</label>
                  <input type="number" id="credits" v-model="form.credits" class="form-control" :class="{ 'is-invalid': form.errors.credits }" min="1">
                  <span class="error invalid-feedback">{{ form.errors.credits }}</span>
                </div>
                <div class="col-md-3 form-group">
                  <label for="lecture_hours">Lecture Hours</label>
                  <input type="number" id="lecture_hours" v-model="form.lecture_hours" class="form-control" :class="{ 'is-invalid': form.errors.lecture_hours }" min="0">
                  <span class="error invalid-feedback">{{ form.errors.lecture_hours }}</span>
                </div>
                <div class="col-md-3 form-group">
                  <label for="tutorial_hours">Tutorial Hours</label>
                  <input type="number" id="tutorial_hours" v-model="form.tutorial_hours" class="form-control" :class="{ 'is-invalid': form.errors.tutorial_hours }" min="0">
                  <span class="error invalid-feedback">{{ form.errors.tutorial_hours }}</span>
                </div>
                <div class="col-md-3 form-group">
                  <label for="practical_hours">Practical Hours</label>
                  <input type="number" id="practical_hours" v-model="form.practical_hours" class="form-control" :class="{ 'is-invalid': form.errors.practical_hours }" min="0">
                  <span class="error invalid-feedback">{{ form.errors.practical_hours }}</span>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary" :disabled="form.processing">Save</button>
              <Link href="/admin/subjects" class="btn btn-default float-right">Cancel</Link>
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
  departments: Array,
});

const form = useForm({
  department_id: '',
  subject_code: '',
  subject_name: '',
  credits: 3,
  lecture_hours: 3,
  tutorial_hours: 0,
  practical_hours: 0,
});

const submit = () => {
  form.post('/admin/subjects');
};
</script>

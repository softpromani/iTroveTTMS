<template>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Faculty</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><Link href="/admin">Home</Link></li>
              <li class="breadcrumb-item"><Link href="/admin/faculties">Faculties</Link></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary glassmorphism">
          <div class="card-header">
            <h3 class="card-title">Faculty Details</h3>
          </div>
          <form @submit.prevent="submit">
            <div class="card-body">
              <div class="form-group">
                <label for="user_id">User</label>
                <select class="form-control" id="user_id" v-model="form.user_id" required>
                  <option value="" disabled>Select User</option>
                  <option v-for="user in users" :key="user.id" :value="user.id">
                    {{ user.name }} ({{ user.email }})
                  </option>
                </select>
                <span class="text-danger" v-if="form.errors.user_id">{{ form.errors.user_id }}</span>
              </div>

              <div class="form-group">
                <label for="department_id">Department (Optional)</label>
                <select class="form-control" id="department_id" v-model="form.department_id">
                  <option value="">Select Department</option>
                  <option v-for="department in departments" :key="department.id" :value="department.id">
                    {{ department.name }}
                  </option>
                </select>
                <span class="text-danger" v-if="form.errors.department_id">{{ form.errors.department_id }}</span>
              </div>

              <div class="form-group">
                <label for="employee_code">Employee Code</label>
                <input type="text" class="form-control" id="employee_code" v-model="form.employee_code" placeholder="Enter Employee Code" required />
                <span class="text-danger" v-if="form.errors.employee_code">{{ form.errors.employee_code }}</span>
              </div>

              <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" id="designation" v-model="form.designation" placeholder="e.g. Professor" />
                <span class="text-danger" v-if="form.errors.designation">{{ form.errors.designation }}</span>
              </div>

              <div class="form-group">
                <label for="qualification">Qualification</label>
                <input type="text" class="form-control" id="qualification" v-model="form.qualification" placeholder="e.g. Ph.D., M.Tech" />
                <span class="text-danger" v-if="form.errors.qualification">{{ form.errors.qualification }}</span>
              </div>

              <div class="form-group">
                <label for="expertise">Expertise</label>
                <input type="text" class="form-control" id="expertise" v-model="form.expertise" placeholder="e.g. Data Science" />
                <span class="text-danger" v-if="form.errors.expertise">{{ form.errors.expertise }}</span>
              </div>

              <div class="form-group">
                <label for="max_teaching_hours_per_week">Max Teaching Hours / Week</label>
                <input type="number" class="form-control" id="max_teaching_hours_per_week" v-model="form.max_teaching_hours_per_week" min="1" required />
                <span class="text-danger" v-if="form.errors.max_teaching_hours_per_week">{{ form.errors.max_teaching_hours_per_week }}</span>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary" :disabled="form.processing">Create Faculty</button>
              <Link href="/admin/faculties" class="btn btn-default float-right">Cancel</Link>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

const props = defineProps({
  users: Array,
  departments: Array,
});

const form = useForm({
  user_id: '',
  department_id: '',
  employee_code: '',
  designation: '',
  qualification: '',
  expertise: '',
  max_teaching_hours_per_week: 40,
});

const submit = () => {
  form.post('/admin/faculties', {
    preserveScroll: true,
    onSuccess: () => {
      // Inertia will handle redirect if the controller returns a redirect.
    },
  });
};
</script>

<style scoped>
.glassmorphism {
  background: rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(12px);
  border-radius: 12px;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
}
</style>

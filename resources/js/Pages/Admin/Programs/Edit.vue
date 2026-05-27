<template>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Program</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><Link href="/admin">Home</Link></li>
                <li class="breadcrumb-item"><Link href="/admin/programs">Programs</Link></li>
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
              <h3 class="card-title">Edit Program Details</h3>
            </div>
            <form @submit.prevent="submit">
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Program Name</label>
                  <input type="text" class="form-control" id="name" v-model="form.name" required>
                  <span class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
                </div>
                
                <div class="form-group">
                  <label for="type">Program Type</label>
                  <select class="form-control" id="type" v-model="form.type" required>
                    <option v-for="(label, value) in programTypes" :key="value" :value="value">{{ label }}</option>
                  </select>
                  <span class="text-danger" v-if="form.errors.type">{{ form.errors.type }}</span>
                </div>

                <div class="form-group">
                  <label for="duration">Duration (Years)</label>
                  <input type="number" class="form-control" id="duration" v-model="form.duration" min="1" required>
                  <span class="text-danger" v-if="form.errors.duration">{{ form.errors.duration }}</span>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="status" v-model="form.status" :checked="form.status">
                    <label class="custom-control-label" for="status">Active Status</label>
                  </div>
                  <span class="text-danger" v-if="form.errors.status">{{ form.errors.status }}</span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" :disabled="form.processing">Update Program</button>
                <Link href="/admin/programs" class="btn btn-default float-right">Cancel</Link>
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
  program: Object,
  programTypes: Array,
});

const form = useForm({
  name: props.program.name,
  type: props.program.type,
  duration: props.program.duration,
  status: Boolean(props.program.status)
});

const submit = () => {
  form.put(`/admin/programs/${props.program.id}`);
};
</script>

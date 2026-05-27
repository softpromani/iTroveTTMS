<template>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Create Timetable Entry</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><Link href="/admin">Home</Link></li>
                <li class="breadcrumb-item"><Link href="/admin/timetable-entries">Timetable Entries</Link></li>
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
              <h3 class="card-title">Entry Details</h3>
            </div>
            <form @submit.prevent="submit">
              <div class="card-body">
                
                <div v-if="Object.keys(form.errors).length > 0" class="alert alert-danger">
                  <ul class="mb-0">
                    <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
                  </ul>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="semester_id">Semester</label>
                    <select class="form-control" id="semester_id" v-model="form.semester_id" required>
                      <option value="" disabled>Select Semester</option>
                      <option v-for="semester in semesters" :key="semester.id" :value="semester.id">{{ semester.name }}</option>
                    </select>
                  </div>
                  
                  <div class="col-md-6 form-group">
                    <label for="section_id">Section</label>
                    <select class="form-control" id="section_id" v-model="form.section_id" required>
                      <option value="" disabled>Select Section</option>
                      <option v-for="section in sections" :key="section.id" :value="section.id">{{ section.name }}</option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="subject_id">Subject</label>
                    <select class="form-control" id="subject_id" v-model="form.subject_id" required>
                      <option value="" disabled>Select Subject</option>
                      <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{ subject.subject_name }} ({{ subject.subject_code }})</option>
                    </select>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="faculty_id">Faculty</label>
                    <select class="form-control" id="faculty_id" v-model="form.faculty_id" required>
                      <option value="" disabled>Select Faculty</option>
                      <option v-for="faculty in faculties" :key="faculty.id" :value="faculty.id">{{ faculty.user?.name }} ({{ faculty.employee_code }})</option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="room_id">Room</label>
                    <select class="form-control" id="room_id" v-model="form.room_id" required>
                      <option value="" disabled>Select Room</option>
                      <option v-for="room in rooms" :key="room.id" :value="room.id">{{ room.room_no }} - {{ room.building }}</option>
                    </select>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="timetable_slot_id">Time Slot</label>
                    <select class="form-control" id="timetable_slot_id" v-model="form.timetable_slot_id" required>
                      <option value="" disabled>Select Slot</option>
                      <option v-for="slot in timetableSlots" :key="slot.id" :value="slot.id">{{ slot.day }} | {{ slot.start_time }} - {{ slot.end_time }}</option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="date">Specific Date (Optional)</label>
                    <input type="date" class="form-control" id="date" v-model="form.date">
                    <small class="form-text text-muted">Leave blank for regular weekly schedule.</small>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" v-model="form.status" required>
                      <option value="active">Active</option>
                      <option value="cancelled">Cancelled</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" :disabled="form.processing">Create Entry</button>
                <Link href="/admin/timetable-entries" class="btn btn-default float-right">Cancel</Link>
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
  semesters: Array,
  sections: Array,
  subjects: Array,
  faculties: Array,
  rooms: Array,
  timetableSlots: Array
});

const form = useForm({
  semester_id: '',
  section_id: '',
  subject_id: '',
  faculty_id: '',
  room_id: '',
  timetable_slot_id: '',
  date: '',
  status: 'active'
});

const submit = () => {
  form.post('/admin/timetable-entries');
};
</script>

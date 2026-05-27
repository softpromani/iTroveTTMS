<template>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Time Slot</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><Link href="/admin">Home</Link></li>
                <li class="breadcrumb-item"><Link href="/admin/timetable-slots">Time Slots</Link></li>
                <li class="breadcrumb-item active">Edit</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Slot Details</h3>
            </div>
            <form @submit.prevent="submit">
              <div class="card-body">
                <div class="form-group">
                  <label for="day">Day</label>
                  <select class="form-control" id="day" v-model="form.day" required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                  </select>
                  <span class="text-danger" v-if="form.errors.day">{{ form.errors.day }}</span>
                </div>

                <div class="form-group">
                  <label for="start_time">Start Time</label>
                  <input type="time" class="form-control" id="start_time" v-model="form.start_time" required>
                  <span class="text-danger" v-if="form.errors.start_time">{{ form.errors.start_time }}</span>
                </div>

                <div class="form-group">
                  <label for="end_time">End Time</label>
                  <input type="time" class="form-control" id="end_time" v-model="form.end_time" required>
                  <span class="text-danger" v-if="form.errors.end_time">{{ form.errors.end_time }}</span>
                </div>

                <div class="form-group">
                  <label for="slot_type">Slot Type</label>
                  <select class="form-control" id="slot_type" v-model="form.slot_type" required>
                    <option value="lecture">Lecture</option>
                    <option value="lab">Lab</option>
                    <option value="break">Break</option>
                  </select>
                  <span class="text-danger" v-if="form.errors.slot_type">{{ form.errors.slot_type }}</span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-info" :disabled="form.processing">Update Slot</button>
                <Link href="/admin/timetable-slots" class="btn btn-default float-right">Cancel</Link>
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
  timetableSlot: Object
});

const form = useForm({
  day: props.timetableSlot.day,
  start_time: props.timetableSlot.start_time.substring(0, 5),
  end_time: props.timetableSlot.end_time.substring(0, 5),
  slot_type: props.timetableSlot.slot_type
});

const submit = () => {
  form.put(`/admin/timetable-slots/${props.timetableSlot.id}`);
};
</script>

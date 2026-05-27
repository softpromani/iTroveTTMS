<template>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Room</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><Link href="/admin">Home</Link></li>
                <li class="breadcrumb-item"><Link href="/admin/rooms">Rooms</Link></li>
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
              <h3 class="card-title">Room Details</h3>
            </div>
            <form @submit.prevent="submit">
              <div class="card-body">
                <div class="form-group">
                  <label for="room_no">Room Number</label>
                  <input type="text" class="form-control" id="room_no" v-model="form.room_no" placeholder="Enter Room Number" required>
                  <span class="text-danger" v-if="form.errors.room_no">{{ form.errors.room_no }}</span>
                </div>
                
                <div class="form-group">
                  <label for="building">Building</label>
                  <input type="text" class="form-control" id="building" v-model="form.building" placeholder="Enter Building Name (e.g. Block A)">
                  <span class="text-danger" v-if="form.errors.building">{{ form.errors.building }}</span>
                </div>

                <div class="form-group">
                  <label for="capacity">Capacity</label>
                  <input type="number" class="form-control" id="capacity" v-model="form.capacity" min="1" required>
                  <span class="text-danger" v-if="form.errors.capacity">{{ form.errors.capacity }}</span>
                </div>

                <div class="form-group">
                  <label for="type">Room Type</label>
                  <select class="form-control" id="type" v-model="form.type" required>
                    <option value="lecture">Lecture Room</option>
                    <option value="lab">Laboratory</option>
                    <option value="smart_room">Smart Room</option>
                  </select>
                  <span class="text-danger" v-if="form.errors.type">{{ form.errors.type }}</span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-info" :disabled="form.processing">Update Room</button>
                <Link href="/admin/rooms" class="btn btn-default float-right">Cancel</Link>
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
  room: Object
});

const form = useForm({
  room_no: props.room.room_no,
  building: props.room.building || '',
  capacity: props.room.capacity,
  type: props.room.type
});

const submit = () => {
  form.put(`/admin/rooms/${props.room.id}`);
};
</script>

<template>
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4" style="font-family: 'Inter', sans-serif;">Timetable Calendar</h1>
    <FullCalendar
      :options="calendarOptions"
      class="shadow-lg rounded-lg overflow-hidden bg-white bg-opacity-80 backdrop-filter backdrop-blur-sm"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import axios from 'axios';

const calendarOptions = ref({
  plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
  initialView: 'timeGridWeek',
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay'
  },
  events: [],
  editable: true,
  eventDrop: onEventDrop,
  eventResize: onEventResize,
});

function fetchEvents() {
  axios.get(route('timetable.calendar.entries'))
    .then(response => {
      calendarOptions.value.events = response.data;
    })
    .catch(err => console.error('Failed to load calendar events', err));
}

function onEventDrop(info) {
  // For simplicity, just refetch events after drop – more advanced handling can be added later.
  // In a real implementation you would send an update to the server with the new date.
  fetchEvents();
}

function onEventResize(info) {
  fetchEvents();
}

onMounted(() => {
  fetchEvents();
});
</script>

<style scoped>
/* Premium glassmorphism background */
.container {
  background: rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(10px);
  border-radius: 12px;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
}
</style>

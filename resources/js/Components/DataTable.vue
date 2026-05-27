<template>
  <div class="data-table-wrapper bg-white p-3 rounded shadow-sm">
    <div class="row mb-3">
      <div class="col-sm-12 col-md-6 d-flex align-items-center">
        <!-- Optional: Show entries dropdown could go here -->
      </div>
      <div class="col-sm-12 col-md-6 d-flex justify-content-end">
        <div class="dataTables_filter">
          <label class="font-weight-normal mb-0 d-flex align-items-center">
            Search:
            <input v-model="search" @input="onSearch" type="search" class="form-control form-control-sm ml-2" placeholder="" />
          </label>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover bg-white shadow-sm rounded mb-0 text-nowrap">
        <thead>
          <tr>
            <th v-for="col in columns" :key="col.key" @click="sort(col)" class="cursor-pointer">
              <div class="d-flex justify-content-between align-items-center">
                {{ col.label }}
                <span v-if="col.sortable" class="text-muted ml-1">
                  <i v-if="sortBy === col.key && sortDir === 'asc'" class="fas fa-sort-up text-dark"></i>
                  <i v-else-if="sortBy === col.key && sortDir === 'desc'" class="fas fa-sort-down text-dark"></i>
                  <i v-else class="fas fa-sort text-light-gray" style="opacity: 0.3"></i>
                </span>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="data.length === 0">
            <td :colspan="columns.length" class="text-center py-4 text-muted">No data available in table</td>
          </tr>
          <tr v-for="row in data" :key="row.id">
            <td v-for="col in columns" :key="col.key" class="align-middle">
              <template v-if="col.key === 'actions'">
                <slot name="actions" :row="row">
                  <Link :href="`/admin/programs/${row.id}/edit`" class="btn btn-info btn-sm mr-1">
                    <i class="fas fa-pencil-alt"></i>
                  </Link>
                  <button @click="emitDelete(row.id)" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                  </button>
                </slot>
              </template>
              <template v-else>{{ row[col.key] }}</template>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="row mt-3">
      <div class="col-sm-12 col-md-5 d-flex align-items-center">
        <div class="text-muted text-sm">
          Showing {{ meta.from || 0 }} to {{ meta.to || 0 }} of {{ meta.total }} entries
        </div>
      </div>
      <div class="col-sm-12 col-md-7 d-flex justify-content-end">
        <ul class="pagination pagination-sm m-0">
          <li class="page-item" :class="{ disabled: !meta.prev_page_url }">
            <button class="btn btn-outline-primary btn-sm" @click="prevPage" :disabled="!meta.prev_page_url">Previous</button>
          </li>
          <li class="page-item" :class="{ disabled: !meta.next_page_url }">
            <button class="page-link" @click="nextPage" :disabled="!meta.next_page_url">Next</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
  url: { type: String, required: true },
  columns: { type: Array, required: true },
});

const data = ref([]);
const meta = ref({ total: 0, per_page: 20, current_page: 1, last_page: 1, from: 0, to: 0, prev_page_url: null, next_page_url: null });
const search = ref('');
const sortBy = ref(null);
const sortDir = ref('asc');

let searchTimeout = null;

const fetchData = async () => {
  const params = new URLSearchParams();
  params.append('page', meta.value.current_page);
  params.append('per_page', meta.value.per_page);
  if (search.value) params.append('search', search.value);
  if (sortBy.value) {
    params.append('sort_by', sortBy.value);
    params.append('sort_dir', sortDir.value);
  }
  const response = await axios.get(`${props.url}?${params.toString()}`);
  const json = response.data;
  data.value = json.data;
  meta.value = json.meta;
};

const onSearch = () => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    meta.value.current_page = 1; // Reset to first page on search
    fetchData();
  }, 300); // 300ms debounce
};

const sort = (col) => {
  if (!col.sortable) return;
  if (sortBy.value === col.key) {
    sortDir.value = sortDir.value === 'asc' ? 'desc' : 'asc';
  } else {
    sortBy.value = col.key;
    sortDir.value = 'asc';
  }
  fetchData();
};

const prevPage = () => {
  if (meta.value.current_page > 1) {
    meta.value.current_page--;
    fetchData();
  }
};

const nextPage = () => {
  if (meta.value.current_page < meta.value.last_page) {
    meta.value.current_page++;
    fetchData();
  }
};

const emitDelete = (id) => {
  if (confirm('Are you sure you want to delete this item?')) {
    router.delete(`${props.url.replace('/datatable', '')}/${id}`);
  }
};

onMounted(fetchData);
watch(() => props.url, fetchData);
</script>

<style scoped>
.data-table .input-search {
  padding: 0.375rem 0.75rem;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  background-color: #fff;
  color: #495057;
  outline: none;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.data-table .input-search:focus {
  border-color: #80bdff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
.table th {
  background-color: #f8f9fa;
  color: #333;
  font-weight: 600;
  cursor: pointer;
  border-bottom: 2px solid #dee2e6;
}
.table th:hover {
  background-color: #e9ecef;
}
</style>

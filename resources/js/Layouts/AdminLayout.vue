<template>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark custom-it-navbar">
    <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <Link href="/admin" class="nav-link">Home</Link>
        </li>
      </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- User Profile Dropdown -->
<li class="nav-item dropdown" v-if="$page.props && $page.props.auth && $page.props.auth.user">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-user-circle"></i>
          <span class="d-none d-sm-inline-block ml-1">{{ $page.props.auth.user.name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="/admin/profile">
            <i class="fas fa-user mr-2"></i> My Profile
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" @click.prevent="$inertia.post('/logout')">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
      
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <!-- Fullscreen -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <Link href="/admin" class="brand-link">
        <span class="brand-text font-weight-light pl-3">AdminLTE 3</span>
      </Link>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <Link href="/admin" class="nav-link" :class="{'active': $page.url === '/admin'}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </Link>
            </li>

            <li class="nav-header">ACADEMICS</li>
            <li class="nav-item">
              <Link href="/admin/programs" class="nav-link" :class="{'active': $page.url.startsWith('/admin/programs')}">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>Programs</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/sections" class="nav-link" :class="{'active': $page.url.startsWith('/admin/sections')}">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>Sections</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/departments" class="nav-link" :class="{'active': $page.url.startsWith('/admin/departments')}">
                <i class="nav-icon fas fa-building"></i>
                <p>Departments</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/subjects" class="nav-link" :class="{'active': $page.url.startsWith('/admin/subjects')}">
                <i class="nav-icon fas fa-book"></i>
                <p>Subjects</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/semesters" class="nav-link" :class="{'active': $page.url.startsWith('/admin/semesters')}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Semesters</p>
              </Link>
            </li>

            <li class="nav-header">FACULTY & INFRASTRUCTURE</li>
            <li class="nav-item">
              <Link href="/admin/faculties" class="nav-link" :class="{'active': $page.url.startsWith('/admin/faculties')}">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>Faculties</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/rooms" class="nav-link" :class="{'active': $page.url.startsWith('/admin/rooms')}">
                <i class="nav-icon fas fa-door-open"></i>
                <p>Rooms</p>
              </Link>
            </li>

            <li class="nav-header">TIMETABLE ENGINE</li>
            <li class="nav-item">
              <Link href="/admin/timetable-slots" class="nav-link" :class="{'active': $page.url.startsWith('/admin/timetable-slots')}">
                <i class="nav-icon fas fa-clock"></i>
                <p>Time Slots</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/timetable-entries" class="nav-link" :class="{'active': $page.url.startsWith('/admin/timetable-entries')}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Timetable Entries</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/timetable-calendar" class="nav-link" :class="{'active': $page.url.startsWith('/admin/timetable-calendar')}">
                <i class="nav-icon fas fa-calendar"></i>
                <p>Calendar</p>
              </Link>
            </li>

            <li class="nav-header">CBCS & ELECTIVES</li>
            <li class="nav-item">
              <Link href="/admin/elective-groups" class="nav-link" :class="{'active': $page.url.startsWith('/admin/elective-groups')}">
                <i class="nav-icon fas fa-th-list"></i>
                <p>Elective Groups</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/elective-subjects" class="nav-link" :class="{'active': $page.url.startsWith('/admin/elective-subjects')}">
                <i class="nav-icon fas fa-book-open"></i>
                <p>Elective Subjects</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/admin/student-electives" class="nav-link" :class="{'active': $page.url.startsWith('/admin/student-electives')}">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>My Electives</p>
              </Link>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Main content slot injected here -->
    <slot />

    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';

onMounted(() => {
  document.body.classList.add('hold-transition', 'sidebar-mini', 'layout-fixed');
});

onUnmounted(() => {
  document.body.classList.remove('hold-transition', 'sidebar-mini', 'layout-fixed');
});
</script>

<style scoped>
.wrapper {
  min-height: 100vh;
}
</style>

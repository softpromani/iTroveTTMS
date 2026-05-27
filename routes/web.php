<?php

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Inertia\Inertia;

// Auth routes (custom, no Breeze)
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/', function () {
    return view('welcome');
});

// Admin dashboard route
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard');
    });

    // Sections routes
    Route::get('sections/datatable', [\App\Http\Controllers\SectionController::class, 'datatable'])->name('sections.datatable');
    Route::resource('sections', \App\Http\Controllers\SectionController::class);

    Route::get('programs/datatable', [\App\Http\Controllers\ProgramController::class, 'datatable'])->name('programs.datatable');
    Route::resource('programs', \App\Http\Controllers\ProgramController::class);

    Route::get('departments/datatable', [\App\Http\Controllers\DepartmentController::class, 'datatable'])->name('departments.datatable');
    Route::resource('departments', \App\Http\Controllers\DepartmentController::class);

    Route::get('subjects/datatable', [\App\Http\Controllers\SubjectController::class, 'datatable'])->name('subjects.datatable');
    Route::resource('subjects', \App\Http\Controllers\SubjectController::class);

    Route::get('semesters/datatable', [\App\Http\Controllers\SemesterController::class, 'datatable'])->name('semesters.datatable');
    Route::resource('semesters', \App\Http\Controllers\SemesterController::class);

    Route::get('faculties/datatable', [\App\Http\Controllers\FacultyController::class, 'datatable'])->name('faculties.datatable');
    Route::resource('faculties', \App\Http\Controllers\FacultyController::class);

    Route::get('rooms/datatable', [\App\Http\Controllers\RoomController::class, 'datatable'])->name('rooms.datatable');
    Route::resource('rooms', \App\Http\Controllers\RoomController::class);
    Route::get('timetable-slots/datatable', [\App\Http\Controllers\TimetableSlotController::class, 'datatable'])->name('timetable-slots.datatable');
    Route::resource('timetable-slots', \App\Http\Controllers\TimetableSlotController::class);

    Route::get('timetable-entries/datatable', [\App\Http\Controllers\TimetableEntryController::class, 'datatable'])->name('timetable-entries.datatable');
    Route::resource('timetable-entries', \App\Http\Controllers\TimetableEntryController::class);
    // CBCS & Electives routes
    Route::resource('elective-groups', \App\Http\Controllers\ElectiveGroupController::class);
    Route::resource('elective-subjects', \App\Http\Controllers\ElectiveSubjectController::class);
    Route::resource('student-electives', \App\Http\Controllers\StudentElectiveController::class);
    // Optional datatable routes if needed
    Route::get('elective-groups/datatable', [\App\Http\Controllers\ElectiveGroupController::class, 'datatable'])->name('elective-groups.datatable');
    Route::get('elective-subjects/datatable', [\App\Http\Controllers\ElectiveSubjectController::class, 'datatable'])->name('elective-subjects.datatable');
    Route::get('student-electives/datatable', [\App\Http\Controllers\StudentElectiveController::class, 'datatable'])->name('student-electives.datatable');
    // Timetable entries routes (index, create, store, edit, update, destroy)
    // Timetable calendar UI
    Route::get('timetable-calendar', [\App\Http\Controllers\TimetableCalendarController::class, 'index'])->name('timetable.calendar');
    // JSON feed for FullCalendar
    Route::get('timetable-calendar/entries', [\App\Http\Controllers\TimetableCalendarController::class, 'apiEntries'])->name('timetable.calendar.entries');
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimetableEntryController extends Controller
{
    use \App\Traits\HasDataTable;

    public function index()
    {
        return \Inertia\Inertia::render('Admin/TimetableEntries/Index');
    }

    public function datatable(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\TimetableEntry::with([
            'semester', 'section', 'subject', 'faculty.user', 'room', 'timetableSlot'
        ]);
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'semester.name', 'label' => 'Semester', 'searchable' => true, 'sortable' => true],
            ['key' => 'section.name', 'label' => 'Section', 'searchable' => true, 'sortable' => true],
            ['key' => 'subject.subject_name', 'label' => 'Subject', 'searchable' => true, 'sortable' => true],
            ['key' => 'faculty.user.name', 'label' => 'Faculty', 'searchable' => true, 'sortable' => true],
            ['key' => 'room.room_no', 'label' => 'Room', 'searchable' => true, 'sortable' => true],
            ['key' => 'timetableSlot.day', 'label' => 'Day', 'searchable' => true, 'sortable' => true],
            ['key' => 'timetableSlot.start_time', 'label' => 'Start Time', 'searchable' => false, 'sortable' => true],
            ['key' => 'status', 'label' => 'Status', 'searchable' => true, 'sortable' => true],
        ];
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Admin/TimetableEntries/Create', [
            'semesters' => \App\Models\Semester::all(),
            'sections' => \App\Models\Section::all(),
            'subjects' => \App\Models\Subject::all(),
            'faculties' => \App\Models\Faculty::with('user')->get(),
            'rooms' => \App\Models\Room::all(),
            'timetableSlots' => \App\Models\TimetableSlot::all(),
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'faculty_id' => 'required|exists:faculties,id',
            'room_id' => 'required|exists:rooms,id',
            'timetable_slot_id' => 'required|exists:timetable_slots,id',
            'date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        // Basic overlap conflict checks
        $facultyConflict = \App\Models\TimetableEntry::where('faculty_id', $validated['faculty_id'])
            ->where('timetable_slot_id', $validated['timetable_slot_id'])
            ->where('status', 'active')
            ->exists();
            
        $roomConflict = \App\Models\TimetableEntry::where('room_id', $validated['room_id'])
            ->where('timetable_slot_id', $validated['timetable_slot_id'])
            ->where('status', 'active')
            ->exists();

        $sectionConflict = \App\Models\TimetableEntry::where('section_id', $validated['section_id'])
            ->where('timetable_slot_id', $validated['timetable_slot_id'])
            ->where('status', 'active')
            ->exists();

        if ($facultyConflict) return back()->withErrors(['faculty_id' => 'Faculty is already assigned to another class during this slot.']);
        if ($roomConflict) return back()->withErrors(['room_id' => 'Room is already occupied during this slot.']);
        if ($sectionConflict) return back()->withErrors(['section_id' => 'Section already has a class scheduled during this slot.']);

        \App\Models\TimetableEntry::create($validated);
        return redirect()->route('admin.timetable-entries.index')->with('success', 'Timetable entry created successfully.');
    }

    public function edit(\App\Models\TimetableEntry $timetableEntry)
    {
        return \Inertia\Inertia::render('Admin/TimetableEntries/Edit', [
            'timetableEntry' => $timetableEntry,
            'semesters' => \App\Models\Semester::all(),
            'sections' => \App\Models\Section::all(),
            'subjects' => \App\Models\Subject::all(),
            'faculties' => \App\Models\Faculty::with('user')->get(),
            'rooms' => \App\Models\Room::all(),
            'timetableSlots' => \App\Models\TimetableSlot::all(),
        ]);
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\TimetableEntry $timetableEntry)
    {
        $validated = $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'faculty_id' => 'required|exists:faculties,id',
            'room_id' => 'required|exists:rooms,id',
            'timetable_slot_id' => 'required|exists:timetable_slots,id',
            'date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        $timetableEntry->update($validated);
        return redirect()->route('admin.timetable-entries.index')->with('success', 'Timetable entry updated successfully.');
    }

    public function destroy(\App\Models\TimetableEntry $timetableEntry)
    {
        $timetableEntry->delete();
        return redirect()->route('admin.timetable-entries.index')->with('success', 'Timetable entry deleted successfully.');
    }
}

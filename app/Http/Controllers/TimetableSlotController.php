<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimetableSlotController extends Controller
{
    use \App\Traits\HasDataTable;

    public function index()
    {
        return \Inertia\Inertia::render('Admin/TimetableSlots/Index');
    }

    public function datatable(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\TimetableSlot::query();
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'day', 'label' => 'Day', 'searchable' => true, 'sortable' => true],
            ['key' => 'start_time', 'label' => 'Start Time', 'searchable' => false, 'sortable' => true],
            ['key' => 'end_time', 'label' => 'End Time', 'searchable' => false, 'sortable' => true],
            ['key' => 'slot_type', 'label' => 'Type', 'searchable' => true, 'sortable' => true],
        ];
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Admin/TimetableSlots/Create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_type' => 'required|string',
        ]);

        \App\Models\TimetableSlot::create($validated);
        return redirect()->route('admin.timetable-slots.index')->with('success', 'Time slot created successfully.');
    }

    public function edit(\App\Models\TimetableSlot $timetableSlot)
    {
        return \Inertia\Inertia::render('Admin/TimetableSlots/Edit', [
            'timetableSlot' => $timetableSlot,
        ]);
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\TimetableSlot $timetableSlot)
    {
        $validated = $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_type' => 'required|string',
        ]);

        $timetableSlot->update($validated);
        return redirect()->route('admin.timetable-slots.index')->with('success', 'Time slot updated successfully.');
    }

    public function destroy(\App\Models\TimetableSlot $timetableSlot)
    {
        $timetableSlot->delete();
        return redirect()->route('admin.timetable-slots.index')->with('success', 'Time slot deleted successfully.');
    }
}

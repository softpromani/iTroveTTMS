<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Program;
use App\Traits\HasDataTable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SemesterController extends Controller
{
    use HasDataTable;

    public function index()
    {
        return Inertia::render('Admin/Semesters/Index');
    }

    public function datatable(Request $request)
    {
        $query = Semester::with('program');
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'academic_year', 'label' => 'Academic Year', 'searchable' => true, 'sortable' => true],
            ['key' => 'name', 'label' => 'Name', 'searchable' => true, 'sortable' => true],
            ['key' => 'program.name', 'label' => 'Program', 'searchable' => false, 'sortable' => false, 'render' => fn($row) => $row->program->name ?? ''],
            ['key' => 'start_date', 'label' => 'Start Date', 'searchable' => false, 'sortable' => true, 'render' => fn($row) => $row->start_date ? $row->start_date->format('Y-m-d') : ''],
            ['key' => 'end_date', 'label' => 'End Date', 'searchable' => false, 'sortable' => true, 'render' => fn($row) => $row->end_date ? $row->end_date->format('Y-m-d') : ''],
            ['key' => 'actions', 'label' => 'Actions', 'searchable' => false, 'sortable' => false],
        ];
        
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        $programs = Program::all();
        return Inertia::render('Admin/Semesters/Create', [
            'programs' => $programs
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'academic_year' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'duration_weeks' => 'required|integer|min:1',
        ]);

        Semester::create($validated);
        return redirect()->route('admin.semesters.index')->with('success', 'Semester created successfully.');
    }

    public function edit(Semester $semester)
    {
        $programs = Program::all();
        return Inertia::render('Admin/Semesters/Edit', [
            'semester' => $semester,
            'programs' => $programs
        ]);
    }

    public function update(Request $request, Semester $semester)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'academic_year' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'duration_weeks' => 'required|integer|min:1',
        ]);

        $semester->update($validated);
        return redirect()->route('admin.semesters.index')->with('success', 'Semester updated successfully.');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->route('admin.semesters.index')->with('success', 'Semester deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Program;
use App\Models\Semester;
use App\Traits\HasDataTable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    use HasDataTable;

    public function index()
    {
        return Inertia::render('Admin/Sections/Index');
    }

    public function datatable(Request $request)
    {
        $query = Section::with('program', 'semester');
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'name', 'label' => 'Name', 'searchable' => true, 'sortable' => true],
            ['key' => 'program.name', 'label' => 'Program', 'searchable' => false, 'sortable' => false, 'render' => fn($row) => $row->program->name ?? ''],
            ['key' => 'semester.academic_year', 'label' => 'Semester', 'searchable' => false, 'sortable' => false, 'render' => fn($row) => $row->semester->academic_year ?? ''],
            ['key' => 'batch_year', 'label' => 'Batch Year', 'searchable' => false, 'sortable' => true],
            ['key' => 'student_strength', 'label' => 'Strength', 'searchable' => false, 'sortable' => true],
            ['key' => 'actions', 'label' => 'Actions', 'searchable' => false, 'sortable' => false],
        ];

        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        $programs = Program::all();
        $semesters = Semester::all();
        return Inertia::render('Admin/Sections/Create', [
            'programs' => $programs,
            'semesters' => $semesters,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'semester_id' => 'required|exists:semesters,id',
            'name' => 'required|string|max:255',
            'batch_year' => 'required|integer',
            'student_strength' => 'required|integer|min:1',
        ]);

        Section::create($validated);
        return redirect()->route('admin.sections.index')->with('success', 'Section created successfully.');
    }

    public function edit(Section $section)
    {
        $programs = Program::all();
        $semesters = Semester::all();
        return Inertia::render('Admin/Sections/Edit', [
            'section' => $section,
            'programs' => $programs,
            'semesters' => $semesters,
        ]);
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'semester_id' => 'required|exists:semesters,id',
            'name' => 'required|string|max:255',
            'batch_year' => 'required|integer',
            'student_strength' => 'required|integer|min:1',
        ]);

        $section->update($validated);
        return redirect()->route('admin.sections.index')->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Section deleted successfully.');
    }
}

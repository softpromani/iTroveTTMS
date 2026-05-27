<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Department;
use App\Traits\HasDataTable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
{
    use HasDataTable;

    public function index()
    {
        return Inertia::render('Admin/Subjects/Index');
    }

    public function datatable(Request $request)
    {
        $query = Subject::with('department');
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'subject_code', 'label' => 'Code', 'searchable' => true, 'sortable' => true],
            ['key' => 'subject_name', 'label' => 'Name', 'searchable' => true, 'sortable' => true],
            ['key' => 'department.name', 'label' => 'Department', 'searchable' => false, 'sortable' => false, 'render' => fn($row) => $row->department->name ?? ''],
            ['key' => 'credits', 'label' => 'Credits', 'searchable' => false, 'sortable' => true],
            ['key' => 'actions', 'label' => 'Actions', 'searchable' => false, 'sortable' => false],
        ];
        
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        $departments = Department::all();
        return Inertia::render('Admin/Subjects/Create', [
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'subject_code' => 'required|string|max:255|unique:subjects',
            'subject_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
            'lecture_hours' => 'required|integer|min:0',
            'tutorial_hours' => 'required|integer|min:0',
            'practical_hours' => 'required|integer|min:0',
        ]);

        Subject::create($validated);
        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        $departments = Department::all();
        return Inertia::render('Admin/Subjects/Edit', [
            'subject' => $subject,
            'departments' => $departments
        ]);
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'subject_code' => 'required|string|max:255|unique:subjects,subject_code,' . $subject->id,
            'subject_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
            'lecture_hours' => 'required|integer|min:0',
            'tutorial_hours' => 'required|integer|min:0',
            'practical_hours' => 'required|integer|min:0',
        ]);

        $subject->update($validated);
        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}

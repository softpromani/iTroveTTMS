<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use App\Traits\HasDataTable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    use HasDataTable;

    public function index()
    {
        return Inertia::render('Admin/Departments/Index');
    }

    public function datatable(Request $request)
    {
        $query = Department::with('program', 'hod');
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'name', 'label' => 'Name', 'searchable' => true, 'sortable' => true],
            ['key' => 'program.name', 'label' => 'Program', 'searchable' => false, 'sortable' => false, 'render' => fn($row) => $row->program->name ?? ''],
            ['key' => 'hod.name', 'label' => 'HOD', 'searchable' => false, 'sortable' => false, 'render' => fn($row) => $row->hod->name ?? 'Unassigned'],
            ['key' => 'actions', 'label' => 'Actions', 'searchable' => false, 'sortable' => false],
        ];
        
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        $programs = Program::all();
        return Inertia::render('Admin/Departments/Create', [
            'programs' => $programs
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'name' => 'required|string|max:255',
            'hod_id' => 'nullable|exists:users,id'
        ]);

        Department::create($validated);
        return redirect()->route('admin.departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        $programs = Program::all();
        return Inertia::render('Admin/Departments/Edit', [
            'department' => $department,
            'programs' => $programs
        ]);
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'name' => 'required|string|max:255',
            'hod_id' => 'nullable|exists:users,id'
        ]);

        $department->update($validated);
        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully.');
    }
}

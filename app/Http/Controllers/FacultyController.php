<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyController extends Controller
{
    use \App\Traits\HasDataTable;

    public function index()
    {
        return \Inertia\Inertia::render('Admin/Faculties/Index');
    }

    public function datatable(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Faculty::with(['user', 'department']);
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'employee_code', 'label' => 'Code', 'searchable' => true, 'sortable' => true],
            ['key' => 'user.name', 'label' => 'Name', 'searchable' => true, 'sortable' => true],
            ['key' => 'department.name', 'label' => 'Department', 'searchable' => true, 'sortable' => true],
            ['key' => 'designation', 'label' => 'Designation', 'searchable' => true, 'sortable' => true],
        ];
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Admin/Faculties/Create', [
            'users' => \App\Models\User::all(),
            'departments' => \App\Models\Department::all(),
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'nullable|exists:departments,id',
            'employee_code' => 'required|string|unique:faculties,employee_code',
            'qualification' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'expertise' => 'nullable|string|max:255',
            'max_teaching_hours_per_week' => 'required|integer|min:1',
        ]);

        \App\Models\Faculty::create($validated);
        return redirect()->route('admin.faculties.index')->with('success', 'Faculty created successfully.');
    }

    public function edit(\App\Models\Faculty $faculty)
    {
        return \Inertia\Inertia::render('Admin/Faculties/Edit', [
            'faculty' => $faculty,
            'users' => \App\Models\User::all(),
            'departments' => \App\Models\Department::all(),
        ]);
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Faculty $faculty)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'nullable|exists:departments,id',
            'employee_code' => 'required|string|unique:faculties,employee_code,' . $faculty->id,
            'qualification' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'expertise' => 'nullable|string|max:255',
            'max_teaching_hours_per_week' => 'required|integer|min:1',
        ]);

        $faculty->update($validated);
        return redirect()->route('admin.faculties.index')->with('success', 'Faculty updated successfully.');
    }

    public function destroy(\App\Models\Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('admin.faculties.index')->with('success', 'Faculty deleted successfully.');
    }
}

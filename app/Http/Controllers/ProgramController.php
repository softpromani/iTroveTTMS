<?php

namespace App\Http\Controllers;

use App\Enums\ProgramType;
use App\Models\Program;
use App\Traits\HasDataTable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    use HasDataTable;

    public function index()
    {
        // Return the page; the DataTable component will fetch data via the datatable endpoint.
        return Inertia::render('Admin/Programs/Index');
    }

    /**
     * Server‑side datatable endpoint.
     * Returns JSON for the reusable DataTable component.
     */
    public function datatable(Request $request)
    {
        $query = Program::query();
        $columns = [
            ['key' => 'id',   'label' => 'ID',   'searchable' => true,  'sortable' => true],
            ['key' => 'name', 'label' => 'Name', 'searchable' => true,  'sortable' => true],
            ['key' => 'type', 'label' => 'Program Type', 'searchable' => true, 'sortable' => true],
            ['key' => 'duration', 'label' => 'Duration (Years)', 'searchable' => false, 'sortable' => true],
            ['key' => 'status', 'label' => 'Status', 'searchable' => false, 'sortable' => true,
                'render' => fn($row) => $row->status ? 'Active' : 'Inactive'],
        ];
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        $programTypes = ProgramType::options();
        return Inertia::render('Admin/Programs/Create', [
            'programTypes' => $programTypes,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'duration' => 'required|integer|min:1',
            'status' => 'boolean'
        ]);

        Program::create($validated);
        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');
    }

    public function edit(Program $program)
    {
        $programTypes = ProgramType::options();
        return Inertia::render('Admin/Programs/Edit', [
            'program' => $program,
            'programTypes' => $programTypes,
        ]);
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'duration' => 'required|integer|min:1',
            'status' => 'boolean'
        ]);

        $program->update($validated);
        return redirect()->route('admin.programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted successfully.');
    }
}

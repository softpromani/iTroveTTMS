<?php

namespace App\Http\Controllers;

use App\Models\ElectiveGroup;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ElectiveGroupController extends Controller
{
    use \App\Traits\HasDataTable;

    public function index()
    {
        return Inertia::render('Admin/Electives/Groups/Index');
    }

    public function datatable(Request $request)
    {
        $query = ElectiveGroup::query();
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'name', 'label' => 'Name', 'searchable' => true, 'sortable' => true],
            ['key' => 'description', 'label' => 'Description', 'searchable' => true, 'sortable' => false],
            ['key' => 'min_credits', 'label' => 'Min Credits', 'searchable' => false, 'sortable' => true],
            ['key' => 'max_credits', 'label' => 'Max Credits', 'searchable' => false, 'sortable' => true],
        ];
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        return Inertia::render('Admin/Electives/Groups/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_credits' => 'required|integer|min:0',
            'max_credits' => 'required|integer|min:0|gte:min_credits',
        ]);
        ElectiveGroup::create($validated);
        return redirect()->route('admin.elective-groups.index')
            ->with('success', 'Elective group created successfully.');
    }

    public function edit(ElectiveGroup $electiveGroup)
    {
        return Inertia::render('Admin/Electives/Groups/Edit', ['group' => $electiveGroup]);
    }

    public function update(Request $request, ElectiveGroup $electiveGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_credits' => 'required|integer|min:0',
            'max_credits' => 'required|integer|min:0|gte:min_credits',
        ]);
        $electiveGroup->update($validated);
        return redirect()->route('admin.elective-groups.index')
            ->with('success', 'Elective group updated successfully.');
    }

    public function destroy(ElectiveGroup $electiveGroup)
    {
        $electiveGroup->delete();
        return redirect()->route('admin.elective-groups.index')
            ->with('success', 'Elective group deleted successfully.');
    }
}
?>

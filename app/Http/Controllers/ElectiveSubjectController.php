<?php

namespace App\Http\Controllers;

use App\Models\ElectiveSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ElectiveSubjectController extends Controller
{
    use \App\Traits\HasDataTable;

    public function index()
    {
        return Inertia::render('Admin/Electives/Subjects/Index');
    }

    public function datatable(Request $request)
    {
        $query = ElectiveSubject::with(['electiveGroup', 'subject']);
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'electiveGroup.name', 'label' => 'Group', 'searchable' => true, 'sortable' => true],
            ['key' => 'subject.name', 'label' => 'Subject', 'searchable' => true, 'sortable' => true],
            ['key' => 'mandatory_flag', 'label' => 'Mandatory', 'searchable' => false, 'sortable' => true],
        ];
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        return Inertia::render('Admin/Electives/Subjects/Create', [
            'electiveGroups' => \App\Models\ElectiveGroup::all(),
            'subjects' => Subject::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'elective_group_id' => 'required|exists:elective_groups,id',
            'subject_id' => 'required|exists:subjects,id',
            'mandatory_flag' => 'required|boolean',
        ]);
        ElectiveSubject::create($validated);
        return redirect()->route('admin.elective-subjects.index')
            ->with('success', 'Elective subject added successfully.');
    }

    public function edit(ElectiveSubject $electiveSubject)
    {
        return Inertia::render('Admin/Electives/Subjects/Edit', [
            'electiveSubject' => $electiveSubject,
            'electiveGroups' => \App\Models\ElectiveGroup::all(),
            'subjects' => Subject::all(),
        ]);
    }

    public function update(Request $request, ElectiveSubject $electiveSubject)
    {
        $validated = $request->validate([
            'elective_group_id' => 'required|exists:elective_groups,id',
            'subject_id' => 'required|exists:subjects,id',
            'mandatory_flag' => 'required|boolean',
        ]);
        $electiveSubject->update($validated);
        return redirect()->route('admin.elective-subjects.index')
            ->with('success', 'Elective subject updated successfully.');
    }

    public function destroy(ElectiveSubject $electiveSubject)
    {
        $electiveSubject->delete();
        return redirect()->route('admin.elective-subjects.index')
            ->with('success', 'Elective subject deleted successfully.');
    }
}
?>

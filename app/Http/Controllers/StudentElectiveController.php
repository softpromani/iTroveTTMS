<?php

namespace App\Http\Controllers;

use App\Models\ElectiveSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentElectiveController extends Controller
{
    /**
     * Display a listing of the student's electives.
     */
    public function index()
    {
        $student = Auth::user();
        // Load elective subjects with their related subject details
        $electives = $student->electives()
            ->with('subject')
            ->get();
        return inertia('Student/Electives/Index', ['electives' => $electives]);
    }

    /**
     * Store a newly selected elective for the authenticated student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'elective_subject_id' => 'required|exists:elective_subjects,id',
        ]);

        $student = Auth::user();
        $elective = ElectiveSubject::with('subject')->findOrFail($validated['elective_subject_id']);
        $currentCredits = $student->totalElectiveCredits();
        $newTotal = $currentCredits + ($elective->subject->credits ?? 0);
        $maxCredits = 18; // default limit

        if ($newTotal > $maxCredits) {
            return redirect()->back()->with('error', "Adding this elective exceeds the maximum allowed credits of {$maxCredits}.");
        }

        // Attach the elective subject via the pivot table student_electives
        $student->electives()->attach($validated['elective_subject_id']);

        return redirect()->back()->with('success', 'Elective selected successfully.');
    }

    /**
     * Remove an elective from the student's list.
     */
    public function destroy($id)
    {
        $student = Auth::user();
        $student->electives()->detach($id);

        return redirect()->back()->with('success', 'Elective removed successfully.');
    }
}

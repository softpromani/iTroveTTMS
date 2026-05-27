<?php

namespace App\Http\Controllers;

use App\Models\TimetableEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TimetableCalendarController extends Controller
{
    /**
     * Show the calendar UI.
     */
    public function index()
    {
        return Inertia::render('Admin/Timetable/Calendar');
    }

    /**
     * Return timetable entries as JSON for FullCalendar.
     */
    public function apiEntries(Request $request)
    {
        $entries = TimetableEntry::with([
            'semester',
            'section',
            'subject',
            'faculty.user',
            'room',
            'timetableSlot'
        ])->get();

        // Transform to FullCalendar event format
        $events = $entries->map(function ($entry) {
            $slot = $entry->timetableSlot;
            $title = $entry->subject->subject_name . ' - ' . $entry->faculty->user->name;
            // Combine date (or use today if null) with slot times
            $date = $entry->date ?? now()->format('Y-m-d');
            $start = $date . 'T' . $slot->start_time;
            $end   = $date . 'T' . $slot->end_time;
            return [
                'id' => $entry->id,
                'title' => $title,
                'start' => $start,
                'end'   => $end,
                'extendedProps' => [
                    'room' => $entry->room->room_no ?? '',
                    'section' => $entry->section->name ?? '',
                    'status' => $entry->status,
                ],
            ];
        });

        return response()->json($events);
    }
}
?>

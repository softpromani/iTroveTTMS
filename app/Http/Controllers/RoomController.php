<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    use \App\Traits\HasDataTable;

    public function index()
    {
        return \Inertia\Inertia::render('Admin/Rooms/Index');
    }

    public function datatable(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Room::query();
        $columns = [
            ['key' => 'id', 'label' => 'ID', 'searchable' => true, 'sortable' => true],
            ['key' => 'room_no', 'label' => 'Room No', 'searchable' => true, 'sortable' => true],
            ['key' => 'building', 'label' => 'Building', 'searchable' => true, 'sortable' => true],
            ['key' => 'capacity', 'label' => 'Capacity', 'searchable' => false, 'sortable' => true],
            ['key' => 'type', 'label' => 'Type', 'searchable' => true, 'sortable' => true],
        ];
        return $this->applyDataTable($request, $query, $columns);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Admin/Rooms/Create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'room_no' => 'required|string|max:255|unique:rooms',
            'building' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'type' => 'required|string|in:lecture,lab,smart_room',
        ]);

        \App\Models\Room::create($validated);
        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(\App\Models\Room $room)
    {
        return \Inertia\Inertia::render('Admin/Rooms/Edit', [
            'room' => $room,
        ]);
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Room $room)
    {
        $validated = $request->validate([
            'room_no' => 'required|string|max:255|unique:rooms,room_no,' . $room->id,
            'building' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'type' => 'required|string|in:lecture,lab,smart_room',
        ]);

        $room->update($validated);
        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(\App\Models\Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}

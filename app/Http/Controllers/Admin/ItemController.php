<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;   // Don't forget to import the Item Model
use App\Models\Room;   // Don't forget to import the Room Model
use App\Models\Student; // Don't forget to import the Student Model if you use it for assigned_to_student_id

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with(['room', 'assignedToStudent'])->latest()->paginate(10); // Eager load room and student
        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
public function create(Request $request)
{
    $rooms = Room::orderBy('room_number')->get();
    $selectedRoomId = $request->query('room_id');
    $room = Room::find($selectedRoomId);

    $students = collect();

    if ($room) {
        $students = Student::where('type', 'asrama')
            ->where('gender', strtolower($room->gender_type))
            ->whereHas('currentRoomPlacement', function ($query) use ($room) {
                $query->whereNull('end_date')
                      ->where('room_id', $room->id); // Sudah menempati kamar aktif ini
            })
            ->orderBy('name')
            ->get();
    }

    return view('admin.items.create', compact('rooms', 'students', 'selectedRoomId'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'serial_number' => 'nullable|string|unique:items,serial_number|max:255',
            'condition' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'acquisition_date' => 'nullable|date',
            'status' => 'required|in:Tersedia,Dipinjam,Rusak,Hilang',
            'room_id' => 'nullable|exists:rooms,id',
            'assigned_to_student_id' => 'nullable|exists:students,id',
        ]);

        Item::create($validatedData);

        // Redirect back to the room's show page if the item was added from there,
        // otherwise, redirect to the items index
        if ($request->has('room_id') && $request->room_id) {
             return redirect()->route('admin.rooms.show', $request->room_id)->with('success', 'Barang inventaris berhasil ditambahkan ke kamar!');
        }
        return redirect()->route('admin.items.index')->with('success', 'Barang inventaris berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // Example: load item with its room and assigned student for display
        $item->load(['room', 'assignedToStudent']);
        return view('admin.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Item $item)
{
    $rooms = Room::orderBy('room_number')->get();
    $room = $item->room;
    $students = collect();

    if ($room) {
        $students = Student::where('type', 'asrama')
            ->where('gender', strtolower($room->gender_type))
            ->whereHas('currentRoomPlacement', function ($query) use ($room) {
                $query->whereNull('end_date')
                      ->where('room_id', $room->id); // Hanya santri aktif di kamar ini
            })
            ->orderBy('name')
            ->get();
    }

    return view('admin.items.edit', compact('item', 'rooms', 'students'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'serial_number' => 'nullable|string|unique:items,serial_number,' . $item->id . '|max:255', // unique validation, excluding current item
            'condition' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'acquisition_date' => 'nullable|date',
            'status' => 'required|in:Tersedia,Dipinjam,Rusak,Hilang',
            'room_id' => 'nullable|exists:rooms,id',
            'assigned_to_student_id' => 'nullable|exists:students,id',
        ]);

        $item->update($validatedData);

        return redirect()->route('admin.items.index')->with('success', 'Barang inventaris berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Barang inventaris berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Pastikan ini ada


class RoomController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Middleware untuk melindungi seluruh controller berdasarkan izin
        $this->middleware('permission:view rooms')->only(['index', 'show']);
        $this->middleware('permission:create rooms')->only(['create', 'store']);
        $this->middleware('permission:edit rooms')->only(['edit', 'update']);  
        $this->middleware('permission:delete rooms')->only(['destroy']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::orderBy('room_number')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number',
            'capacity' => 'required|integer|min:1',
            // --- PERBAIKAN DI SINI ---
            'gender_type' => ['required', 'string', Rule::in(['laki-laki', 'perempuan'])],
            // --- AKHIR PERBAIKAN ---
            'status' => ['required', 'string', Rule::in(['available', 'full', 'renovation', 'inactive'])],
            'description' => 'nullable|string|max:1000',
        ]);

        Room::create($validatedData);

        // Catat Audit Trail
        record_audit(
            'create_room',
            'Menambah Kamar Baru: ' . $validatedData['room_number'],
            auth()->user()->id ?? null,
            auth()->user()->name ?? 'Guest',
            $request->ip(),
            $request->userAgent()
        );

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validatedData = $request->validate([
            'room_number' => ['required', 'string', 'max:255', Rule::unique('rooms', 'room_number')->ignore($room->id)],
            'capacity' => 'required|integer|min:1',
            // --- PERBAIKAN DI SINI ---
            'gender_type' => ['required', 'string', Rule::in(['laki-laki', 'perempuan'])],
            // --- AKHIR PERBAIKAN ---
            'status' => ['required', 'string', Rule::in(['available', 'full', 'renovation', 'inactive'])],
            'description' => 'nullable|string|max:1000',
        ]);

        $room->update($validatedData);

        // Catat Audit Trail
        record_audit(
            'update_room',
            'Memperbarui Kamar: ' . $room->room_number,
            auth()->user()->id ?? null,
            auth()->user()->name ?? 'Guest',
            $request->ip(),
            $request->userAgent()
        );

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // TODO: Tambahkan validasi di sini sebelum menghapus kamar
        // Contoh: Cek apakah ada santri yang masih menempati kamar ini
        // if ($room->placements()->whereNull('end_date')->exists()) {
        //     return redirect()->back()->with('error', 'Tidak bisa menghapus kamar karena masih ada santri yang menempati.');
        // }

        $room->delete();

        // Catat Audit Trail
        record_audit(
            'delete_room',
            'Menghapus Kamar: ' . $room->room_number,
            auth()->user()->id ?? null,
            auth()->user()->name ?? 'Guest',
            $request->ip(),
            $request->userAgent()
        );

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus!');
    }
}
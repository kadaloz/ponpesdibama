<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\StudentRoomPlacement;
use App\Models\Student;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB; // Untuk transaksi database

class RoomController extends Controller
{
    /**
     * Create a new controller instance.
     */
public function __construct()
{
    $this->middleware('permission:view rooms')->only(['index', 'show']);
    $this->middleware('permission:create rooms')->only(['create', 'store']);
    $this->middleware('permission:edit rooms')->only(['edit', 'update']);
    $this->middleware('permission:delete rooms')->only(['destroy']);
    $this->middleware('permission:assign students to room')->only(['assignForm', 'assignStudents']); // <-- This is likely the culprit
    $this->middleware('permission:assign items to room')->only(['assignItemsForm', 'assignItems']);
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
            'gender_type' => ['required', 'string', Rule::in(['laki-laki', 'perempuan'])],
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
        // Memuat santri yang saat ini menempati kamar ini (is_active = true, end_date = null)
        $room->load(['currentStudents' => function($query) {
            $query->wherePivotNull('end_date'); // Hanya yang aktif
        }, 'items']); // Muat juga item jika diperlukan

        // Untuk mengisi currentOccupancy dengan jumlah santri yang aktif
        $room->current_occupancy = $room->currentStudents->count();

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
            'gender_type' => ['required', 'string', Rule::in(['laki-laki', 'perempuan'])],
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
        // Cek apakah ada santri yang masih menempati kamar ini
        if ($room->currentStudents()->wherePivotNull('end_date')->exists()) {
             return redirect()->back()->with('error', 'Tidak bisa menghapus kamar karena masih ada santri yang menempati.');
        }

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

    /**
     * Show the form for assigning students to a room.
     */
    public function assignForm(Room $room)
    {
        // Dapatkan jenis kelamin yang diizinkan untuk kamar ini
        $roomGender = $room->gender_type; // Misal: 'laki-laki' atau 'perempuan'

        // Muat santri yang saat ini menghuni kamar ini (untuk inisialisasi checkbox)
        $currentRoomStudentIds = $room->currentStudents->pluck('id')->toArray();

        // Query untuk santri yang tersedia untuk kamar ini:
        // 1. Santri yang belum memiliki penempatan kamar aktif (is_active = true, end_date = null)
        // 2. Santri yang saat ini aktif di kamar ini (agar checkbox-nya tetap dicentang)
        // 3. Santri yang saat ini aktif di kamar lain (untuk dinonaktifkan di UI, agar bisa dipindahkan)
        // 4. Filter berdasarkan jenis kelamin kamar
        $availableStudents = Student::with(['currentRoomPlacement.room'])
            ->where(function ($query) use ($room, $roomGender) {
                // Santri yang belum punya penempatan aktif
                $query->whereDoesntHave('currentRoomPlacement', function ($q) {
                    $q->whereNull('end_date'); // Hanya yang aktif
                });

                // Santri yang aktif di kamar ini
                $query->orWhereHas('currentRoomPlacement', function ($q) use ($room) {
                    $q->where('room_id', $room->id)
                      ->whereNull('end_date'); // Pastikan hanya yang aktif di kamar ini
                });

                // Santri yang aktif di kamar lain (agar bisa ditampilkan tapi didisable)
                $query->orWhereHas('currentRoomPlacement', function ($q) use ($room) {
                    $q->where('room_id', '!=', $room->id)
                      ->whereNull('end_date'); // Pastikan hanya yang aktif di kamar lain
                });
            })
            // Filter berdasarkan jenis kelamin kamar (jika kamar bukan "campur")
            ->when($roomGender, function ($query) use ($roomGender) {
                // Sesuaikan 'gender' dengan nama kolom di tabel 'students'
                // dan nilai 'Laki-laki'/'Perempuan' dengan data di DB Anda.
                if ($roomGender === 'laki-laki') {
                    $query->where('gender', 'laki-laki'); // Atau 'Laki-laki'
                } elseif ($roomGender === 'perempuan') {
                    $query->where('gender', 'perempuan'); // Atau 'Perempuan'
                }
                // Jika ada 'Campur', tidak perlu filter jenis kelamin
            })
            ->orderBy('name')
            ->get();

        return view('admin.rooms.assign', compact('room', 'availableStudents', 'currentRoomStudentIds'));
    }

    /**
     * Handle the logic for assigning students to a room.
     */
public function assignStudents(Request $request, Room $room)
{
    $validatedData = $request->validate([
        'student_ids' => ['nullable'],
        'student_ids.*' => ['exists:students,id'],
    ]);

    $selectedStudentIds = is_array($request->student_ids)
        ? array_filter($request->student_ids)
        : [];

    if (count($selectedStudentIds) > $room->capacity) {
    return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: jumlah santri melebihi kapasitas maksimal kamar (' . $room->capacity . ').');
    }


    try {
        DB::beginTransaction();

        // 🧹 Hapus penempatan lama di kamar ini jika santri tidak dipilih lagi
        StudentRoomPlacement::where('room_id', $room->id)
            ->where('is_active', true)
            ->whereNotIn('student_id', $selectedStudentIds)
            ->each(function ($placement) use ($request) {
                record_audit(
                    'delete_placement',
                    "Menghapus penempatan Santri {$placement->student->name} dari Kamar {$placement->room->room_number}. Start: {$placement->start_date}",
                    auth()->id(),
                    auth()->user()->name ?? 'Guest',
                    $request->ip(),
                    $request->userAgent()
                );
                $placement->delete();
            });

        foreach ($selectedStudentIds as $studentId) {
            $student = Student::find($studentId);

            if ($room->gender_type !== 'campur' && $student->gender !== $room->gender_type) {
                throw new \Exception("Santri {$student->name} memiliki jenis kelamin tidak sesuai dengan kamar.");
            }

            // 🔥 Hapus semua penempatan aktif santri untuk mencegah duplikasi
            StudentRoomPlacement::where('student_id', $studentId)
                ->where('is_active', true)
                ->each(function ($oldPlacement) use ($request) {
                    record_audit(
                        'delete_placement',
                        "Menghapus penempatan aktif milik Santri {$oldPlacement->student->name} dari Kamar {$oldPlacement->room->room_number}. Start: {$oldPlacement->start_date}",
                        auth()->id(),
                        auth()->user()->name ?? 'Guest',
                        $request->ip(),
                        $request->userAgent()
                    );
                    $oldPlacement->delete();
                });

            // ⚡ Buat penempatan baru
            StudentRoomPlacement::create([
                'student_id' => $studentId,
                'room_id' => $room->id,
                'start_date' => now()->toDateString(),
                'is_active' => true,
            ]);
        }

        $room->updateCurrentOccupancy();
        $room->refresh();
        $room->status = ($room->current_occupancy >= $room->capacity) ? 'full' : 'available';
        $room->save();

        record_audit(
            'assign_students_to_room',
            'Memperbarui penghuni kamar ' . $room->room_number,
            auth()->id(),
            auth()->user()->name ?? 'Guest',
            $request->ip(),
            $request->userAgent()
        );

        DB::commit();
        return redirect()->route('admin.rooms.show', $room)->with('success', 'Penghuni kamar berhasil diperbarui.');

    } catch (\Exception $e) {
        DB::rollBack();
        record_audit(
            'assign_students_to_room_failed',
            'Gagal memperbarui penghuni kamar: ' . $e->getMessage(),
            auth()->id(),
            auth()->user()->name ?? 'Guest',
            $request->ip(),
            $request->userAgent()
        );
        return redirect()->back()->with('error', $e->getMessage());
    }
}



public function removeStudent(Room $room, Student $student)
{
    // Akhiri penempatan aktif santri di kamar ini
    StudentRoomPlacement::where('student_id', $student->id)
        ->where('room_id', $room->id)
        ->whereNull('end_date')
        ->update(['end_date' => now()]);

    // Audit Trail
    record_audit(
        'remove_student_from_room',
        "Mengeluarkan santri {$student->name} dari kamar {$room->room_number}",
        auth()->id(),
        auth()->user()->name ?? 'Guest',
        request()->ip(),
        request()->userAgent()
    );

    return redirect()->back()->with('success', "Santri {$student->name} berhasil dikeluarkan dari kamar.");
}





    /**
     * Show the form for assigning items to a room.
     */
    public function assignItemsForm(Room $room)
    {
        // Load items currently in this room
        $room->load('items');

        // Get all items that are not assigned to any room or are assigned to this room
        $availableItems = Item::whereDoesntHave('room')
                               ->orWhereHas('room', function ($query) use ($room) {
                                   $query->where('room_id', $room->id);
                               })
                               ->orderBy('name')
                               ->get();

        $currentRoomItemIds = $room->items->pluck('id')->toArray();

        return view('admin.rooms.assign-items', compact('room', 'availableItems', 'currentRoomItemIds'));
    }

    /**
     * Handle the logic for assigning items to a room.
     */
    public function assignItems(Request $request, Room $room)
    {
        $request->validate([
            'item_ids' => 'nullable|array',
            'item_ids.*' => 'exists:items,id',
        ]);

        $selectedItemIds = $request->input('item_ids', []);

        DB::transaction(function () use ($room, $selectedItemIds) {
            // Detach items that are no longer selected for this room
            $room->items()->sync($selectedItemIds);

            // Update item room_id for newly assigned items
            foreach ($selectedItemIds as $itemId) {
                Item::where('id', $itemId)->update(['room_id' => $room->id]);
            }

            // For items that were in this room but are no longer selected, set their room_id to null
            $previousItemIds = $room->items->pluck('id')->toArray();
            $itemsToUnassign = array_diff($previousItemIds, $selectedItemIds);
            if (!empty($itemsToUnassign)) {
                Item::whereIn('id', $itemsToUnassign)->update(['room_id' => null]);
            }

            // Catat Audit Trail
            record_audit(
                'assign_items_to_room',
                'Memperbarui inventaris kamar ' . $room->room_number,
                auth()->user()->id ?? null,
                auth()->user()->name ?? 'Guest',
                $request->ip(),
                $request->userAgent()
            );
        });

        return redirect()->route('admin.rooms.show', $room)->with('success', 'Inventaris kamar berhasil diperbarui.');
    }
}
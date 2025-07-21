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
        // Middleware untuk melindungi seluruh controller berdasarkan izin
        $this->middleware('permission:view rooms')->only(['index', 'show']);
        $this->middleware('permission:create rooms')->only(['create', 'store']);
        $this->middleware('permission:edit rooms')->only(['edit', 'update']);
        $this->middleware('permission:delete rooms')->only(['destroy']);
        // Tambahkan middleware untuk assignForm dan assignStudents
        $this->middleware('permission:assign students to room')->only(['assignForm', 'assignStudents']);
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
                    $query->where('gender', 'L'); // Atau 'Laki-laki'
                } elseif ($roomGender === 'perempuan') {
                    $query->where('gender', 'P'); // Atau 'Perempuan'
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
            'student_ids' => ['nullable', 'array'],
            'student_ids.*' => ['exists:students,id'],
        ]);

        $selectedStudentIds = $validatedData['student_ids'] ?? [];

        // Dapatkan jenis kelamin yang diizinkan untuk kamar ini
        $roomGender = $room->gender_type;

        // Gunakan transaksi database untuk memastikan atomicity
        DB::transaction(function () use ($room, $selectedStudentIds, $roomGender) {
            // 1. NONAKTIFKAN penempatan santri yang TIDAK lagi dipilih untuk kamar ini
            // (Ini menangani santri yang DIKELUARKAN dari kamar ini)
            StudentRoomPlacement::where('room_id', $room->id)
                ->whereNull('end_date') // Hanya yang aktif
                ->whereNotIn('student_id', $selectedStudentIds)
                ->update(['end_date' => now()]);

            // 2. PROSES santri yang DIPILIH dari formulir
            foreach ($selectedStudentIds as $studentId) {
                $student = Student::find($studentId);

                // Validasi jenis kelamin santri dengan kamar
                if ($roomGender && $roomGender !== 'campur') { // Asumsi jika ada 'campur' tidak perlu filter
                    // Sesuaikan ini dengan nilai gender di DB Anda ('L'/'P', atau 'laki-laki'/'perempuan')
                    $studentGender = ($student->gender === 'L') ? 'laki-laki' : 'perempuan';

                    if ($studentGender !== $roomGender) {
                        // Jika jenis kelamin tidak cocok, batalkan transaksi dan kembalikan error
                        throw new \Exception("Gagal: Santri {$student->name} (" . ($studentGender === 'laki-laki' ? 'Laki-laki' : 'Perempuan') . ") tidak sesuai dengan jenis kamar (" . ($roomGender === 'laki-laki' ? 'Laki-laki' : 'Perempuan') . ").");
                    }
                }

                // Nonaktifkan penempatan aktif santri di kamar LAIN (jika ada)
                StudentRoomPlacement::where('student_id', $studentId)
                    ->where('room_id', '!=', $room->id) // Bukan kamar ini
                    ->whereNull('end_date') // Hanya yang aktif
                    ->update(['end_date' => now()]);

                // Cek apakah santri sudah aktif di kamar ini
                $existingActivePlacement = StudentRoomPlacement::where('student_id', $studentId)
                    ->where('room_id', $room->id)
                    ->whereNull('end_date')
                    ->first();

                if (!$existingActivePlacement) {
                    // Jika tidak ada penempatan aktif di kamar ini, buat yang baru
                    StudentRoomPlacement::create([
                        'student_id' => $studentId,
                        'room_id' => $room->id,
                        'start_date' => now(),
                        'end_date' => null, // Aktif
                    ]);
                }
                // Jika sudah ada penempatan aktif di kamar ini, tidak perlu melakukan apa-apa
                // karena end_date-nya sudah null (aktif)
            }

            // 3. Update current_occupancy dan status kamar
            $room->updateCurrentOccupancy(); // Panggil method ini untuk update occupancy
            if ($room->current_occupancy >= $room->capacity) {
                $room->status = 'full';
            } else {
                $room->status = 'available';
            }
            $room->save();

            // Catat Audit Trail
            record_audit(
                'assign_students_to_room',
                'Memperbarui penghuni kamar ' . $room->room_number,
                auth()->user()->id ?? null,
                auth()->user()->name ?? 'Guest',
                $request->ip(),
                $request->userAgent()
            );
        });

        // Tangani jika ada exception dari transaksi
        try {
            DB::commit(); // Pastikan commit jika transaksi berhasil
            return redirect()->route('admin.rooms.show', $room)->with('success', 'Penghuni kamar berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika ada error
            // Catat Audit Trail untuk kegagalan
            record_audit(
                'assign_students_to_room_failed',
                'Gagal memperbarui penghuni kamar ' . $room->room_number . ': ' . $e->getMessage(),
                auth()->user()->id ?? null,
                auth()->user()->name ?? 'Guest',
                $request->ip(),
                $request->userAgent()
            );
            return redirect()->back()->with('error', $e->getMessage());
        }
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
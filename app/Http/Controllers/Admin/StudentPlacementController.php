<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Room;
use App\Models\StudentRoomPlacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Untuk transaksi database
use Illuminate\Validation\Rule;

class StudentPlacementController extends Controller
{
    public function __construct()
    {
        // Middleware untuk melindungi seluruh controller berdasarkan izin
       
    }

    /**
     * Display a listing of active student placements.
     * Menampilkan daftar semua penempatan santri yang sedang aktif.
     */
    public function index()
    {
        $activePlacements = StudentRoomPlacement::active()
                            ->with('student', 'room')
                            ->orderBy('start_date', 'desc')
                            ->paginate(10);

        // Rooms juga bisa digunakan untuk filter di view jika diperlukan
        $rooms = Room::all(); 

        return view('admin.placements.index', compact('activePlacements', 'rooms'));
    }

    /**
     * Show the form for creating a new placement.
     * Menampilkan form untuk menempatkan santri baru.
     */
    public function create()
    {
       // Hanya santri dengan tipe 'asrama' DAN belum memiliki penempatan aktif
        $students = Student::doesntHave('currentRoomPlacement')
                            ->where('type', 'asrama')
                            ->orderBy('name')
                            ->get();

        // Kamar yang masih tersedia (status 'available') atau yang masih ada kapasitasnya
        // Kami hanya mengambil yang 'available' untuk pilihan kamar baru.
        $availableRooms = Room::where('status', 'available')
                            // Anda bisa menambahkan logika di sini jika kamar 'full' tetapi masih ada slot,
                            // misalnya $room->currentOccupancy() < $room->capacity.
                            // Namun, jika 'full' berarti benar-benar tidak ada slot, maka cukup 'available'.
                            ->get();

        return view('admin.placements.create', compact('students', 'availableRooms'));
    }

    /**
     * Store a newly created placement in storage.
     * Menyimpan penempatan santri baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
                // Pastikan santri belum punya penempatan aktif
                Rule::unique('student_room_placements')->where(function ($query) {
                    return $query->where('is_active', true);
                }),
            ],
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date|before_or_equal:today',
        ]);

        $student = Student::findOrFail($validatedData['student_id']);
        $room = Room::findOrFail($validatedData['room_id']);

        // Validasi: Tipe Santri Harus 'asrama'
        if (strtolower($student->type) !== 'asrama') { 
        // ATAU, jika Anda yakin hanya 'Asrama' dan 'asrama' yang ada:
        if ($student->type !== 'asrama' && $student->type !== 'Asrama') {
            return redirect()->back()->withInput()->with('error', 'Santri ini bukan tipe asrama dan tidak bisa ditempatkan di kamar.');
        }}
        

        // Validasi: Jenis kelamin santri harus sesuai dengan jenis kamar
        if ($student->gender !== $room->gender_type) {
            return redirect()->back()->withInput()->with('error', 'Jenis kelamin santri tidak sesuai dengan jenis kamar.');
        }

        // Validasi: Kapasitas kamar
        $currentOccupancy = $room->currentOccupancy();
        if ($currentOccupancy >= $room->capacity) {
            return redirect()->back()->withInput()->with('error', 'Kamar sudah penuh. Pilih kamar lain.');
        }

        DB::beginTransaction();
        try {
            // Non-aktifkan penempatan sebelumnya jika ada.
            // Ini akan mengakhiri penempatan aktif santri, bahkan saat membuat penempatan baru.
            // Pertimbangkan apakah ini perilaku yang diinginkan. Jika santri hanya bisa punya 1 penempatan aktif, ini benar.
            $student->placements()->update(['is_active' => false, 'end_date' => now()]);

            // Buat penempatan baru
            $placement = $student->placements()->create([
                'room_id' => $validatedData['room_id'],
                'start_date' => $validatedData['start_date'],
                'is_active' => true,
            ]);

            // Catat Audit Trail
            record_audit(
                'create_placement',
                'Menempatkan Santri ' . $student->name . ' ke Kamar ' . $room->room_number,
                auth()->user()->id ?? null,
                auth()->user()->name ?? 'Guest',
                $request->ip(),
                $request->userAgent()
            );

            DB::commit();
            return redirect()->route('admin.placements.index')->with('success', 'Santri berhasil ditempatkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menempatkan santri: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing an existing placement.
     * Mengelola pindah kamar atau mengakhiri penempatan.
     */
    public function edit(StudentRoomPlacement $placement)
    {
        // Pastikan ini adalah penempatan aktif
        if (!$placement->is_active) {
            return redirect()->back()->with('error', 'Penempatan ini sudah tidak aktif dan tidak bisa diedit.');
        }

        $student = $placement->student;
        // Kamar yang masih tersedia (status 'available') atau kamar yang sedang ditempati santri ini
        // Kamar 'full' akan ditampilkan jika santri sedang di dalamnya, agar bisa tetap diedit atau pindah.
        $availableRooms = Room::where('status', 'available')
                                ->orWhere('id', $placement->room_id) // Sertakan kamar yang sedang ditempati santri ini
                                ->get();

        return view('admin.placements.edit', compact('placement', 'student', 'availableRooms'));
    }

    /**
     * Update the specified placement in storage (for moving or ending a placement).
     * Memperbarui penempatan (misalnya pindah kamar atau mengakhiri penempatan).
     */
public function update(Request $request, StudentRoomPlacement $placement)
{
    $validatedData = $request->validate([
        'new_room_id' => ['nullable', 'exists:rooms,id'],
        'end_date' => ['nullable', 'date', 'after_or_equal:' . $placement->start_date],
        'action' => ['required', Rule::in(['move_room', 'end_placement'])],
    ]);

    DB::beginTransaction();
    try {
        $student = $placement->student;
        $oldRoom = $placement->room;
        $message = '';

        // 🔧 Cegah duplikat: bersihkan entri tak aktif selain baris ini
        StudentRoomPlacement::where('student_id', $placement->student_id)
            ->where('is_active', 0)
            ->where('id', '<>', $placement->id)
            ->update([
                'updated_at' => now()
            ]);

        if ($validatedData['action'] == 'move_room') {
            if (empty($validatedData['new_room_id'])) {
                return redirect()->back()->withInput()->with('error', 'Pilih kamar baru untuk pindah.');
            }

            $newRoom = Room::findOrFail($validatedData['new_room_id']);

            if ($student->gender != $newRoom->gender_type) {
                return redirect()->back()->withInput()->with('error', 'Jenis kelamin santri tidak sesuai dengan jenis kamar baru.');
            }

            if ($newRoom->id != $oldRoom->id && $newRoom->currentOccupancy() >= $newRoom->capacity) {
                return redirect()->back()->withInput()->with('error', 'Kamar baru sudah penuh. Pilih kamar lain.');
            }

            // Nonaktifkan penempatan aktif milik santri
            StudentRoomPlacement::where('student_id', $student->id)
                ->where('is_active', true)
                ->update([
                    'end_date' => now()->toDateString(),
                    'is_active' => false,
                ]);

            // Cek apakah sudah ada penempatan aktif di kamar tujuan
            $existingPlacement = StudentRoomPlacement::where('student_id', $student->id)
                ->where('room_id', $newRoom->id)
                ->where('is_active', true)
                ->first();

            if ($existingPlacement) {
                $existingPlacement->update([
                    'start_date' => $existingPlacement->start_date ?? now()->toDateString(),
                    'updated_at' => now()
                ]);
            } else {
                StudentRoomPlacement::create([
                    'student_id' => $student->id,
                    'room_id' => $newRoom->id,
                    'start_date' => now()->toDateString(),
                    'is_active' => true,
                ]);
            }

            $oldRoom->refresh(); 
            $newRoom->refresh(); 

            $oldRoom->update(['status' => $oldRoom->currentOccupancy() < $oldRoom->capacity ? 'available' : $oldRoom->status]);
            $newRoom->update(['status' => $newRoom->currentOccupancy() >= $newRoom->capacity ? 'full' : 'available']);

            record_audit('move_placement', "Memindahkan Santri {$student->name} dari Kamar {$oldRoom->room_number} ke Kamar {$newRoom->room_number}", auth()->id(), auth()->user()->name ?? 'Guest', $request->ip(), $request->userAgent());

            $message = 'Santri berhasil dipindahkan kamar.';

        } elseif ($validatedData['action'] == 'end_placement') {
            if (empty($validatedData['end_date'])) {
                return redirect()->back()->withInput()->with('error', 'Tanggal keluar harus diisi untuk mengakhiri penempatan.');
            }

            $placement->update([
                'end_date' => $validatedData['end_date'],
                'is_active' => false,
            ]);

            $oldRoom->refresh();

            if ($oldRoom->currentOccupancy() < $oldRoom->capacity || $oldRoom->currentOccupancy() === 0) {
                $oldRoom->update(['status' => 'available']);
            }

            record_audit('end_placement', "Mengakhiri penempatan Santri {$student->name} dari Kamar {$oldRoom->room_number} pada {$validatedData['end_date']}", auth()->id(), auth()->user()->name ?? 'Guest', $request->ip(), $request->userAgent());

            $message = 'Penempatan santri berhasil diakhiri.';
        }

        DB::commit();
        return redirect()->route('admin.placements.index')->with('success', $message);

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui penempatan: ' . $e->getMessage());
    }
}



    /**
     * Remove the specified placement from storage.
     * (Hanya untuk kasus emergency, lebih baik diakhiri/dipindahkan daripada dihapus)
     */
    public function removePlacement(StudentRoomPlacement $placement)
    {
        DB::beginTransaction();
        try {
            $studentName = $placement->student->name ?? 'N/A';
            $roomNumber = $placement->room->room_number ?? 'N/A';
            $room = $placement->room; // Simpan referensi kamar sebelum dihapus

            $placement->delete();

            // Refresh data kamar setelah penghapusan penempatan
            $room->refresh(); 

            // Update status kamar yang terkait jika penempatan aktif dihapus
            if ($room->currentOccupancy() < $room->capacity && $room->status === 'full') {
                 $room->update(['status' => 'available']);
            } elseif ($room->currentOccupancy() === 0 && $room->status !== 'available') {
                $room->update(['status' => 'available']);
            }

            // Catat Audit Trail
            record_audit(
                'delete_placement',
                'Menghapus penempatan Santri ' . $studentName . ' dari Kamar ' . $roomNumber . ' (Aksi Darurat)',
                auth()->user()->id ?? null,
                auth()->user()->name ?? 'Guest',
                $request->ip(),
                $request->userAgent()
            );

            DB::commit();
            return redirect()->back()->with('success', 'Penempatan santri berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus penempatan: ' . $e->getMessage());
        }
    }

    /**
     * Display all placements (active and history) for a specific student.
     */
    public function showStudentPlacement(Student $student)
    {
        $placements = $student->placements()->with('room')->orderBy('start_date', 'desc')->get();
        return view('admin.placements.student_history', compact('student', 'placements'));
    }

    /**
     * Display all students currently in a specific room.
     */
    public function showPlacementsInRoom(Room $room)
    {
        $activePlacements = $room->currentStudents()->with('student')->get();
        return view('admin.placements.room_occupancy', compact('room', 'activePlacements'));
    }
}
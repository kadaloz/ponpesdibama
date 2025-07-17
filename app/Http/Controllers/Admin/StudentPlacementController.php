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

        $rooms = Room::all(); // Untuk filter atau informasi tambahan di view

        return view('admin.placements.index', compact('activePlacements', 'rooms'));
    }

    /**
     * Show the form for creating a new placement.
     * Menampilkan form untuk menempatkan santri baru.
     */
    public function create()
    {
        // Santri yang belum memiliki penempatan aktif
        $students = Student::doesntHave('currentPlacement')->orderBy('name')->get();
        // Kamar yang masih tersedia atau belum penuh
        $availableRooms = Room::where('status', 'available')->orWhere('status', 'full')->get();

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

        // Validasi tambahan: Pastikan jenis kelamin kamar sesuai dengan santri
        if ($student->gender != $room->gender_type) {
            return redirect()->back()->withInput()->with('error', 'Jenis kelamin santri tidak sesuai dengan jenis kamar.');
        }

        // Validasi tambahan: Cek kapasitas kamar
        $currentOccupancy = $room->currentOccupancy(); // Menggunakan helper dari model Room
        if ($currentOccupancy >= $room->capacity) {
            return redirect()->back()->withInput()->with('error', 'Kamar sudah penuh. Pilih kamar lain.');
        }

        DB::beginTransaction();
        try {
            // Jika santri sudah punya penempatan (harusnya tidak terjadi karena Rule::unique, tapi sebagai safeguard)
            $existingActivePlacement = StudentRoomPlacement::active()->where('student_id', $student->id)->first();
            if ($existingActivePlacement) {
                // Akhiri penempatan lama (pindah kamar)
                $existingActivePlacement->update([
                    'end_date' => now()->toDateString(),
                    'is_active' => false,
                ]);
            }

            // Buat penempatan baru
            StudentRoomPlacement::create([
                'student_id' => $student->id,
                'room_id' => $room->id,
                'start_date' => $validatedData['start_date'],
                'is_active' => true,
            ]);

            // Update status kamar jika kapasitasnya penuh
            if ($room->currentOccupancy() + 1 >= $room->capacity) { // +1 karena santri baru akan masuk
                $room->update(['status' => 'full']);
            } elseif ($room->status === 'full' && $room->currentOccupancy() + 1 < $room->capacity) {
                 // Jika sebelumnya penuh tapi sekarang ada ruang lagi (misal pindah kamar dari penuh ke kamar ini)
                $room->update(['status' => 'available']);
            }


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
        // Kamar yang masih tersedia atau belum penuh, tidak termasuk kamar yang sedang ditempati santri ini (jika santri ini mau pindah kamar)
        $availableRooms = Room::where('status', 'available')
                                ->orWhere('status', 'full')
                                ->get(); // Ambil semua dan filter nanti jika perlu

        return view('admin.placements.edit', compact('placement', 'student', 'availableRooms'));
    }

    /**
     * Update the specified placement in storage (for moving or ending a placement).
     * Memperbarui penempatan (misalnya pindah kamar atau mengakhiri penempatan).
     */
    public function update(Request $request, StudentRoomPlacement $placement)
    {
        // Validasi untuk pindah kamar atau mengakhiri penempatan
        $validatedData = $request->validate([
            'new_room_id' => ['nullable', 'exists:rooms,id'], // ID kamar baru jika pindah
            'end_date' => ['nullable', 'date', 'after_or_equal:' . $placement->start_date], // Untuk mengakhiri penempatan
            'action' => ['required', Rule::in(['move_room', 'end_placement'])], // Aksi yang diinginkan
        ]);

        DB::beginTransaction();
        try {
            $student = $placement->student;
            $oldRoom = $placement->room;

            if ($validatedData['action'] == 'move_room') {
                if (empty($validatedData['new_room_id'])) {
                     return redirect()->back()->withInput()->with('error', 'Pilih kamar baru untuk pindah.');
                }
                $newRoom = Room::findOrFail($validatedData['new_room_id']);

                // Validasi jenis kelamin kamar baru
                if ($student->gender != $newRoom->gender_type) {
                    return redirect()->back()->withInput()->with('error', 'Jenis kelamin santri tidak sesuai dengan jenis kamar baru.');
                }

                // Validasi kapasitas kamar baru
                if ($newRoom->id != $oldRoom->id && $newRoom->currentOccupancy() >= $newRoom->capacity) {
                    return redirect()->back()->withInput()->with('error', 'Kamar baru sudah penuh. Pilih kamar lain.');
                }

                // Akhiri penempatan lama
                $placement->update([
                    'end_date' => now()->toDateString(), // Tanggal berakhirnya penempatan lama
                    'is_active' => false,
                ]);

                // Buat penempatan baru
                StudentRoomPlacement::create([
                    'student_id' => $student->id,
                    'room_id' => $newRoom->id,
                    'start_date' => now()->toDateString(), // Tanggal mulai penempatan baru
                    'is_active' => true,
                ]);

                // Update status kamar lama
                $oldRoom->update(['status' => 'available']); // Asumsi kamar lama jadi tersedia lagi

                // Update status kamar baru
                if ($newRoom->currentOccupancy() + 1 >= $newRoom->capacity) { // +1 karena santri baru masuk
                    $newRoom->update(['status' => 'full']);
                } elseif ($newRoom->status === 'full' && $newRoom->currentOccupancy() + 1 < $newRoom->capacity) {
                    $newRoom->update(['status' => 'available']); // Jika pindah ke kamar yang sebelumnya penuh tapi sekarang ada ruang
                }


                // Catat Audit Trail
                record_audit(
                    'move_placement',
                    'Memindahkan Santri ' . $student->name . ' dari Kamar ' . $oldRoom->room_number . ' ke Kamar ' . $newRoom->room_number,
                    auth()->user()->id ?? null,
                    auth()->user()->name ?? 'Guest',
                    $request->ip(),
                    $request->userAgent()
                );
                $message = 'Santri berhasil dipindahkan kamar.';

            } elseif ($validatedData['action'] == 'end_placement') {
                if (empty($validatedData['end_date'])) {
                     return redirect()->back()->withInput()->with('error', 'Tanggal keluar harus diisi untuk mengakhiri penempatan.');
                }
                // Akhiri penempatan saat ini
                $placement->update([
                    'end_date' => $validatedData['end_date'],
                    'is_active' => false,
                ]);

                // Update status kamar yang ditinggalkan jika diperlukan
                if ($oldRoom->currentOccupancy() === 0) { // Jika tidak ada santri lagi
                    $oldRoom->update(['status' => 'available']);
                }

                // Catat Audit Trail
                record_audit(
                    'end_placement',
                    'Mengakhiri penempatan Santri ' . $student->name . ' dari Kamar ' . $oldRoom->room_number . ' pada ' . $validatedData['end_date'],
                    auth()->user()->id ?? null,
                    auth()->user()->name ?? 'Guest',
                    $request->ip(),
                    $request->userAgent()
                );
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
            $placement->delete();

            // Update status kamar yang terkait jika penempatan aktif dihapus
            $room = $placement->room;
            if ($room && $room->currentOccupancy() < $room->capacity && $room->status === 'full') {
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
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\StudentRoomPlacement; // Pastikan ini ada jika Anda ingin memeriksa penempatan santri
use App\Models\Student; // Pastikan ini ada jika Anda ingin memeriksa santri
use App\Models\Item; // Pastikan ini ada jika Anda ingin memeriksa barang
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Pastikan ini ada
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
        // Untuk admin, detail biasanya di halaman edit. Redirect saja.
        // Jika ingin menampilkan detail, bisa buat view khusus
        // return view('admin.rooms.show', compact('room'));
        $room->load(['currentStudents', 'items']); // Pastikan 'items' juga dimuat jika Anda ingin menampilkannya
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

     public function assignForm(Room $room)
    {
        // Muat santri yang saat ini menghuni kamar ini (untuk ditampilkan di formulir)
        $room->load('currentStudents.student'); // Load relasi student di dalam currentStudents

        // Dapatkan semua santri yang saat ini tidak memiliki kamar aktif
        // ATAU santri yang sudah ada di kamar ini (untuk memungkinkan penghapusan)
        $availableStudents = Student::whereDoesntHave('currentPlacement')
                                    ->orWhereHas('currentPlacement', function ($query) use ($room) {
                                        $query->where('room_id', $room->id);
                                    })
                                    ->orderBy('name')
                                    ->get();

        return view('admin.rooms.assign', compact('room', 'availableStudents'));
    }

    /**
     * Tangani logika penyimpanan penetapan santri ke kamar.
     */
    public function assignStudents(Request $request, Room $room)
    {
        $request->validate([
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        $selectedStudentIds = $request->input('student_ids', []); // ID santri yang dipilih dari formulir

        // Gunakan transaksi database untuk memastikan semua operasi berhasil atau tidak sama sekali
        DB::transaction(function () use ($room, $selectedStudentIds) {
            // Nonaktifkan semua penempatan aktif yang ADA DI KAMAR INI
            StudentRoomPlacement::where('room_id', $room->id)
                                ->where('is_active', true)
                                ->update(['is_active' => false, 'end_date' => now()]);

            // Nonaktifkan penempatan aktif santri yang tidak lagi dipilih
            // Ini penting jika santri dipindahkan dari kamar lain ke kamar ini
            // atau jika mereka dihapus dari kamar ini dan tidak dimasukkan ke kamar lain
            StudentRoomPlacement::whereIn('student_id',
                                    StudentRoomPlacement::where('is_active', true)
                                                        ->pluck('student_id')
                                                        ->diff($selectedStudentIds) // Santri yang aktif tapi tidak dipilih lagi
                                    )
                                ->update(['is_active' => false, 'end_date' => now()]);


            // Aktifkan atau buat penempatan baru untuk santri yang dipilih
            foreach ($selectedStudentIds as $studentId) {
                // Cari penempatan aktif yang sudah ada untuk santri ini di kamar ini
                // Atau penempatan tidak aktif yang masih bisa diaktifkan kembali
                $placement = StudentRoomPlacement::firstOrNew([
                    'student_id' => $studentId,
                    'room_id' => $room->id,
                    'is_active' => true, // Coba cari yang sudah aktif di kamar ini
                ]);

                // Jika tidak ditemukan yang aktif di kamar ini, cari yang tidak aktif untuk santri ini
                if (!$placement->exists) {
                     $placement = StudentRoomPlacement::where('student_id', $studentId)
                                                      ->where('room_id', $room->id) // Cari di kamar yang sama
                                                      ->orderByDesc('end_date') // Ambil yang terbaru jika ada beberapa riwayat
                                                      ->firstOrNew();
                }

                $placement->room_id = $room->id;
                $placement->student_id = $studentId;
                $placement->start_date = $placement->start_date ?? now(); // Jika baru, set start_date
                $placement->end_date = null; // Aktifkan kembali (tidak ada end_date)
                $placement->is_active = true;
                $placement->save();

                // Pastikan kamar diperbarui statusnya jika kapasitas terpenuhi
                if ($room->currentOccupancy() >= $room->capacity) {
                    $room->status = 'full';
                } else {
                    $room->status = 'available';
                }
                $room->save();
            }

            // Update status kamar jika ada santri yang dikeluarkan dan kamar jadi available
            if (count($selectedStudentIds) < $room->capacity && $room->status == 'full') {
                 $room->status = 'available';
                 $room->save();
            } elseif (count($selectedStudentIds) == 0 && $room->status != 'available') {
                 $room->status = 'available'; // Jika semua santri dikeluarkan
                 $room->save();
            }
        });


        return redirect()->route('admin.rooms.show', $room)->with('success', 'Penghuni kamar berhasil diperbarui.');
    }
}
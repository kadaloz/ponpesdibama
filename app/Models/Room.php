<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student; // Pastikan ini di-import
use App\Models\StudentRoomPlacement; // Pastikan ini di-import
use App\Models\Item; // Pastikan ini di-import

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'capacity',
        'gender_type',
        'status',
        'description',
        'current_occupancy', // <<< Pastikan kolom ini ada di tabel 'rooms' dan di fillable
    ];

    // Relasi ke semua entri penempatan santri (termasuk yang sudah tidak aktif)
    public function placements()
    {
        return $this->hasMany(StudentRoomPlacement::class);
    }

    /**
     * Relasi untuk mendapatkan santri yang saat ini menempati kamar ini.
     * Menggunakan belongsToMany karena ini adalah many-to-many melalui tabel pivot.
     */
    public function currentStudents()
    {
        return $this->belongsToMany(Student::class, 'student_room_placements')
                    ->wherePivotNull('end_date') // Filter hanya yang aktif (end_date is NULL)
                    ->withPivot(['start_date', 'end_date']); // Opsional: jika Anda ingin mengakses data dari tabel pivot
    }

    // Helper untuk menghitung jumlah santri aktif di kamar ini
    // Ini akan memanggil relasi currentStudents() dan menghitung hasilnya
    public function currentOccupancy()
    {
        return $this->currentStudents->count();
    }

    /**
     * Metode untuk memperbarui jumlah santri aktif di kamar ini
     * dan mengupdate kolom 'current_occupancy' di database.
     */
    public function updateCurrentOccupancy()
    {
        // Hitung ulang jumlah santri aktif dan simpan ke kolom current_occupancy
        $this->current_occupancy = $this->currentStudents()->count();
        $this->save(); // Simpan perubahan ke database
    }

    // Relasi untuk mendapatkan barang yang ada di kamar ini
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
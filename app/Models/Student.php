<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Pastikan ini di-import

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'nis',
        'name',
        'gender', // Pastikan nilai di DB adalah 'L' atau 'P' (atau 'Laki-laki'/'Perempuan')
        'place_of_birth',
        'date_of_birth',
        'nisn',
        'last_education',
        'school_origin',
        'address',
        'province',
        'city',
        'district',
        'village',
        'parent_name',
        'parent_phone',
        'parent_email',
        'parent_occupation',
        'admission_year',
        'status',
        'category',
        'type',
        'halaqoh_period',
        'photo_path',
        'document_akta_path',
        'document_kk_path',
        'document_ijazah_path',
        'document_photo_path',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
    /**
     * Relasi ke Program (program yang diikuti santri).
     * Pastikan relasi ini sesuai dengan struktur database Anda.
     */
// Dalam model Student.php
public function program()
{
    return $this->belongsTo(Program::class, 'category'); // karena category menyimpan program_id
}



    /**
     * Relasi Many-to-Many ke Halaqoh (santri tergabung di satu atau lebih halaqoh).
     */
    public function halaqohs()
    {
        return $this->belongsToMany(Halaqoh::class)
                    ->withPivot('join_date', 'status')
                    ->withTimestamps();
    }

    /**
     * Relasi ke pembayaran (semua riwayat pembayaran).
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    

    /**
     * Relasi ke penempatan kamar (semua riwayat penempatan).
     */
    public function placements()
    {
        return $this->hasMany(StudentRoomPlacement::class);
    }

    /**
     * Relasi untuk mendapatkan penempatan kamar aktif saat ini (jika ada).
     * Ini adalah relasi yang digunakan di RoomController dan assign.blade.php.
     * Mengubah nama dari `currentPlacement` menjadi `currentRoomPlacement`
     * agar konsisten dengan penggunaan sebelumnya.
     */
    public function currentRoomPlacement() // <<< NAMA RELASI DISESUAIKAN
    {
        return $this->hasOne(StudentRoomPlacement::class)->whereNull('end_date'); // Hanya yang aktif
    }

    /**
     * Untuk mendapatkan kamar aktif santri (melalui penempatan aktif).
     * Menggunakan hasOneThrough untuk akses langsung ke objek Room.
     */
    public function currentRoom()
    {
        return $this->hasOneThrough(
            Room::class,
            StudentRoomPlacement::class,
            'student_id', // Foreign key on StudentRoomPlacement table
            'id',         // Local key on Room table
            'id',         // Local key on Student table
            'room_id'     // Foreign key on StudentRoomPlacement table
        )->where('student_room_placements.end_date', null); // Pastikan hanya yang aktif
    }

    protected static function booted(): void
    {
        static::creating(function (Student $student) {
            if (empty($student->nis)) {
                // Pastikan nilai gender yang masuk ke generateUniqueNis() sesuai
                // dengan yang diharapkan oleh fungsi tersebut (misal: 'Laki-laki' atau 'Perempuan')
                // Jika di DB 'L'/'P', Anda mungkin perlu mapping di sini.
                $student->nis = self::generateUniqueNis(
                    $student->type ?? 'Pulang-Pergi',
                    $student->gender ?? 'Laki-laki', // Pastikan ini 'Laki-laki' atau 'Perempuan'
                    $student->admission_year ?? date('Y')
                );
            }
        });
    }

    /**
     * Generate Unique NIS (DBM-[YEAR]-[TYPE]-[GENDER]-[XXXX])
     * Pastikan $gender yang masuk ke sini adalah 'Laki-laki' atau 'Perempuan'
     * agar substr($gender, 0, 1) menghasilkan 'L' atau 'P'.
     */
    public static function generateUniqueNis(string $type, string $gender, ?string $admissionYear = null): string
    {
        if (empty($gender)) {
            throw new \InvalidArgumentException("Jenis kelamin tidak boleh kosong.");
        }

        if (empty($admissionYear)) {
            throw new \InvalidArgumentException("Tahun masuk tidak boleh kosong.");
        }

        $yearPart = $admissionYear;
        $typeInitialMap = [
            'Asrama' => 'ASR',
            'Pulang-Pergi' => 'TPQ',
        ];
        $typeInitial = $typeInitialMap[$type] ?? 'TPQ';

        // Pastikan $gender adalah 'Laki-laki' atau 'Perempuan'
        $genderInitial = '';
        if (strtolower($gender) === 'laki-laki') {
            $genderInitial = 'L';
        } elseif (strtolower($gender) === 'perempuan') {
            $genderInitial = 'P';
        } else {
            // Handle unexpected gender value if necessary
            $genderInitial = 'X'; // Default atau throw error
        }


        $prefix = "DBM{$yearPart}{$typeInitial}{$genderInitial}";

        $lastNis = self::where('nis', 'like', "{$prefix}%")
            ->orderBy('nis', 'desc')
            ->pluck('nis')
            ->first();

        $nextNumber = $lastNis
            ? (int) substr($lastNis, strlen($prefix)) + 1
            : 1;

        return $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

}
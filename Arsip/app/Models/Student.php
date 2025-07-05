<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'nis',
        'name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'nisn',
        'last_education',
        'school_origin',
        'address',
        'city',
        'province',
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

    protected static function booted(): void
{
    static::creating(function (Student $student) {
        if (empty($student->nis)) {
            $student->nis = self::generateUniqueNis(
                $student->type ?? 'Pulang-Pergi',  // default type jika kosong
                $student->gender ?? 'Laki-laki',
                $student->admission_year ?? date('Y')
            );
        }
    });
}


/**
 * Generate a unique NIS with type and gender.
 * Format: DBM-[YEAR]-[TYPE]-[GENDER]-[XXX]
 * Example: DBM-2025-TP-L-001
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
    $typeInitial = $typeInitialMap[$type] ?? 'TPQ'; // default fallback
    $genderInitial = strtoupper(substr($gender, 0, 1));

    $prefix = "DBM{$yearPart}{$typeInitial}{$genderInitial}";

    $lastNis = self::where('nis', 'like', "{$prefix}%")
        ->orderBy('nis', 'desc')
        ->pluck('nis')
        ->first();

    if ($lastNis) {
        $lastNumber = (int) substr($lastNis, strlen($prefix));
        $nextNumber = $lastNumber + 1;
    } else {
        $nextNumber = 1;
    }

    $paddedSequence = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    return $prefix . $paddedSequence;
}




}

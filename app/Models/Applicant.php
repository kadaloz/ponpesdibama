<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'full_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'nisn',
        'last_education',
        'school_origin',
        'parent_name',
        'parent_phone',
        'parent_email',
        'parent_occupation',
        'address',
        'city',
        'province',
        'chosen_program',
        'ppdb_type', // Sudah ada
        'halaqoh_period', // NEW: Ditambahkan
        'document_akta_path',
        'document_kk_path',
        'document_ijazah_path',
        'document_photo_path',
        'status',
        'admin_notes',
        'district',
        'village',

    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Applicant $applicant) {
            if (empty($applicant->registration_number)) {
                $applicant->registration_number = self::generateUniqueRegistrationNumber();
            }
        });

        // Hapus file dokumen terkait saat record pendaftar dihapus
        static::deleting(function (Applicant $applicant) {
            $documentPaths = [
                $applicant->document_akta_path,
                $applicant->document_kk_path,
                $applicant->document_ijazah_path,
                $applicant->document_photo_path,
            ];

            foreach ($documentPaths as $path) {
                if ($path) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
                }
            }
        });
    }

    /**
     * Generate a unique registration number.
     * Format: PPDB-TAHUN-ACAK6DIGIT
     */
    public static function generateUniqueRegistrationNumber(): string
    {
        $year = date('Y');
        $randomNumber = Str::upper(Str::random(6));
        $registrationNumber = "PPDB-{$year}-{$randomNumber}";

        while (self::where('registration_number', $registrationNumber)->exists()) {
            $randomNumber = Str::upper(Str::random(6));
            $registrationNumber = "PPDB-{$year}-{$randomNumber}";
        }

        return $registrationNumber;
    }

    // Relasi One-to-one ke Student (jika pendaftar sudah menjadi santri)
    public function student()
    {
        return $this->hasOne(Student::class);
    }
}

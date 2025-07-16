<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halaqoh extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'teacher_id',
        'start_date',
        'end_date',
        'status',
        'student_limit',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Relasi ke Pengajar (Teacher)
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Relasi Many-to-Many ke Santri (Student) via halaqoh_student pivot table.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class)
                    ->withPivot('join_date', 'status') // Penting: akses kolom pivot
                    ->withTimestamps();                // Menyimpan timestamps di pivot table
    }

    /**
     * Relasi One-to-Many ke Jadwal Halaqoh.
     */
    public function schedules()
    {
        return $this->hasMany(HalaqohSchedule::class)
                    ->orderBy('day_of_week')
                    ->orderBy('start_time');
    }
}

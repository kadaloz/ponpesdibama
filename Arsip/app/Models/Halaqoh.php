<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Fixed: use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    // Relasi Many-to-One ke Teacher (pengajar utama halaqoh)
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Relasi Many-to-Many ke Student (santri yang tergabung dalam halaqoh)
    public function students()
    {
        return $this->belongsToMany(Student::class, 'halaqoh_student')->withPivot('join_date', 'status')->withTimestamps();
    }

    // Relasi One-to-Many ke HalaqohSchedule (jadwal halaqoh)
    public function schedules()
    {
        return $this->hasMany(HalaqohSchedule::class)->orderBy('day_of_week')->orderBy('start_time');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRoomPlacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'room_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relasi ke model Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relasi ke model Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Scope untuk mendapatkan penempatan yang sedang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mendapatkan penempatan yang sudah berakhir
    public function scopeEnded($query)
    {
        return $query->where('is_active', false);
    }
}
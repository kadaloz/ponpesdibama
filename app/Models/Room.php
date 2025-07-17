<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'capacity',
        'gender_type',
        'status',
        'description',
    ];

    // Jika Anda ingin membuat relasi ke student_room_placements di masa mendatang
    // public function placements()
    // {
    //     return $this->hasMany(StudentRoomPlacement::class);
    // }

    // Jika Anda ingin mendapatkan daftar santri yang saat ini menempati kamar ini (akan dibahas nanti)
    // public function currentStudents()
    // {
    //     return $this->hasMany(StudentRoomPlacement::class)->whereNull('end_date')->with('student');
    // }
}
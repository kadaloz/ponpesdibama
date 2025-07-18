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

    // Relasi ke penempatan santri
    public function placements()
    {
        return $this->hasMany(StudentRoomPlacement::class);
    }

    // Relasi untuk mendapatkan santri yang saat ini menempati kamar ini
    public function currentStudents()
    {
        return $this->hasMany(StudentRoomPlacement::class)->where('is_active', true)->with('student');
    }

    // Helper untuk menghitung jumlah santri aktif di kamar ini
    public function currentOccupancy()
    {
        return $this->currentStudents->count();
    }
    // Relasi untuk mendapatkan barang yang ada di kamar ini
    public function items()
    {
        return $this->hasMany(RoomItem::class);
    }    
}
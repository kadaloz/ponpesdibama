<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Properti yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'description',
        'serial_number',
        'condition',
        'acquisition_date',
        'status',
        'room_id', // Pastikan ini ada agar bisa diisi
        'assigned_to_student_id', // Pastikan ini ada agar bisa diisi
    ];

    /**
     * Dapatkan kamar tempat item ini berada.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Dapatkan santri yang meminjam/menggunakan item ini.
     */
    public function assignedToStudent()
    {
        return $this->belongsTo(Student::class, 'assigned_to_student_id');
    }
}
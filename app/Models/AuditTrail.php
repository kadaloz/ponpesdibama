<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Pastikan ini ada di $fillable
        'user_name', // Opsional, jika Anda menyimpan nama user langsung
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];

    // Tambahkan relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
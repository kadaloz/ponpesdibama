<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'full_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'phone_number',
        'specialization',
        'join_date',
        'status',
        'user_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'join_date' => 'date',
    ];

    // Relasi One-to-One ke User (jika pengajar memiliki akun login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

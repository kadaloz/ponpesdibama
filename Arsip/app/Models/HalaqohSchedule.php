<?php

namespace App\Models; // Fixed: namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Fixed: use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HalaqohSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'halaqoh_id',
        'day_of_week',
        'start_time',
        'end_time',
        'location',
    ];

    protected $casts = [
        'start_time' => 'datetime', // Cast to Carbon instance for time manipulation
        'end_time' => 'datetime',
    ];

    // Relasi Many-to-One ke Halaqoh
    public function halaqoh()
    {
        return $this->belongsTo(Halaqoh::class);
    }
}

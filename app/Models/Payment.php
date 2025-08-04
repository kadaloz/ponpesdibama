<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  // Import HasFactory trait for factory support


class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'category_id',
        'month',
        'paid_at',
        'amount',
        'method',
        'note',
    ];

    protected $casts = [
        'paid_at' => 'date',
        'amount' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function category()
    {
        return $this->belongsTo(PaymentCategory::class, 'category_id');
    }
}

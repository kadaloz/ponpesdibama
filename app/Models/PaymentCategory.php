<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'category_id');
    }
}

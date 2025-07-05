<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HalaqohScheduleLog extends Model
{
     protected $fillable = [
        'halaqoh_id', 'schedule_id', 'action', 'data_before', 'data_after', 'user_id'
    ];

    protected $casts = [
        'data_before' => 'array',
        'data_after' => 'array',
    ];
    
    public function user()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

}

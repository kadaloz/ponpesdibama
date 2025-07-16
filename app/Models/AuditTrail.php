<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $fillable = [
        'user_name',
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];
}

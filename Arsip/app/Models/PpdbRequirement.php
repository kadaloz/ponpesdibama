<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PpdbRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', // bisa dalam bentuk HTML list
    ];

    /**
     * Get the content as an array.
     *
     * @return array
     */
    public function getContentArrayAttribute()
    {
        return explode("\n", $this->content);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'published_at',
        'category_id', // pastikan ini ada jika pakai kategori
    ];

    // Untuk binding route by slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi ke kategori (satu berita punya satu kategori)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

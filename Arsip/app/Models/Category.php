<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // Relasi: 1 kategori memiliki banyak berita
    public function news()
    {
        return $this->hasMany(News::class);
    }

    // Slug sebagai primary route model binding (jika perlu)
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Setter otomatis slug jika diisi name
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
}

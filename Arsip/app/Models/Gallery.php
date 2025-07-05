<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Untuk slug

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Relasi One-to-Many ke GalleryImage
    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }

    // Ambil semua gambar yang di-publish dari semua galeri
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Menggunakan slug untuk route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        // Generate slug saat membuat galeri baru jika belum ada
        static::creating(function (Gallery $gallery) {
            if (empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title . '-' . Str::random(5));
            }
        });

        // Hapus cover_image dan gambar terkait ketika galeri dihapus
        static::deleting(function (Gallery $gallery) {
            if ($gallery->cover_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->cover_image);
            }
            // Hapus juga semua gambar terkait
            $gallery->images->each(function ($image) {
                if ($image->image_path) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
                }
                $image->delete();
            });
        });
    }
}


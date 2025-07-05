<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'image_path',
        'caption',
        'order',
    ];

    // Relasi Many-to-One ke Gallery
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        // Hapus file gambar saat record dihapus
        static::deleting(function (GalleryImage $image) {
            if ($image->image_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
            }
        });
    }
}


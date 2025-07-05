<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery; // Import Model Gallery
use Illuminate\Http\Request;

class GalleryPublicController extends Controller
{
    public function index()
    {
        $galleries = Gallery::published()->latest()->get(); // Ambil hanya galeri yang dipublikasi
        return view('web.galleries.index_public', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        // Pastikan galeri yang ditampilkan adalah yang sudah dipublikasi
        if (!$gallery->is_published) {
            abort(404);
        }
        $gallery->load('images'); // Load gambar-gambar terkait
        return view('web.galleries.show', compact('gallery'));
    }
}
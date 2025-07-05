<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        // Middleware untuk melindungi seluruh controller berdasarkan izin
        $this->middleware('permission:view galleries')->only(['index', 'show']);
        $this->middleware('permission:create galleries')->only(['create', 'store']);
        $this->middleware('permission:edit galleries')->only(['edit', 'update']);
        $this->middleware('permission:delete galleries')->only(['destroy', 'deleteImage']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allGalleries = Gallery::latest()->get();
        return view('admin.galleries.index', compact('allGalleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'is_published' => 'boolean',
        'images.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'images.*.caption' => 'nullable|string|max:255',
    ]);

    $data = $request->except(['_token', 'images']);
    $data['slug'] = Str::slug($request->title);

    // Upload cover image (jika ada)
    if ($request->hasFile('cover_image')) {
        $data['cover_image'] = $request->file('cover_image')->store('gallery_covers', 'public');
    }

    // Simpan galeri utama
    $gallery = Gallery::create($data);

    // Upload gambar-gambar tambahan (jika ada)
    if ($request->has('images')) {
        foreach ($request->input('images') as $key => $imageData) {
            if ($request->hasFile("images.{$key}.image")) {
                $imageFile = $request->file("images.{$key}.image");

                if ($imageFile->isValid()) {
                    $imagePath = $imageFile->store('gallery_images', 'public');

                    GalleryImage::create([
                        'gallery_id' => $gallery->id,
                        'image_path' => $imagePath,
                        'caption' => $imageData['caption'] ?? null,
                        'order' => $key,
                    ]);
                }
            }
        }
    }

    return redirect()->route('admin.galleries.index')->with('success', 'Album galeri berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('images');
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $gallery->load('images');
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_published' => 'boolean',
            'existing_images.*.caption' => 'nullable|string|max:255', // Validasi caption gambar yang sudah ada
            'existing_images.*.order' => 'nullable|integer', // Validasi urutan gambar yang sudah ada
            'new_images.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Validasi gambar baru
            'new_images.*.caption' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['_token', '_method', 'existing_images', 'new_images', 'delete_existing_cover']);

        // Handle Cover Image Update
        if ($request->hasFile('cover_image')) {
            if ($gallery->cover_image) {
                Storage::disk('public')->delete($gallery->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('gallery_covers', 'public');
        } elseif ($request->has('delete_existing_cover')) {
            if ($gallery->cover_image) {
                Storage::disk('public')->delete($gallery->cover_image);
            }
            $data['cover_image'] = null;
        } else {
            // Penting: Jika tidak ada upload baru dan tidak ada checkbox hapus, pertahankan cover yang sudah ada.
            // Jika tidak, cover akan menjadi null.
            $data['cover_image'] = $gallery->cover_image;
        }

        $gallery->update($data);

        // Update Existing Images and re-order
        if ($request->has('existing_images')) {
            foreach ($request->input('existing_images') as $imageId => $imageData) {
                $image = GalleryImage::find($imageId);
                if ($image) {
                    $image->update([
                        'caption' => $imageData['caption'] ?? null,
                        'order' => $imageData['order'] ?? 0,
                    ]);
                }
            }
        }

        // Handle New Images Upload
        // Iterasi melalui array input file 'new_images'
   if ($request->has('new_images')) {
    $currentMaxOrder = $gallery->images()->max('order') ?? 0;

    foreach ($request->input('new_images') as $key => $imageData) {
        // Ambil file secara manual berdasarkan key
        if ($request->hasFile("new_images.{$key}.image")) {
            $imageFile = $request->file("new_images.{$key}.image");

            if ($imageFile->isValid()) {
                $imagePath = $imageFile->store('gallery_images', 'public');
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $imagePath,
                    'caption' => $imageData['caption'] ?? null,
                    'order' => $currentMaxOrder + $key + 1,
                ]);
            }
        }
    }
}



        return redirect()->route('admin.galleries.index')->with('success', 'Album galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete(); // Model observer akan menangani penghapusan gambar terkait
        return redirect()->route('admin.galleries.index')->with('success', 'Album galeri berhasil dihapus!');
    }

    /**
     * Menghapus gambar individu dari galeri via AJAX.
     */
    public function deleteImage(Request $request, GalleryImage $image)
    {
        if (!auth()->user()->can('delete galleries')) { // Menggunakan izin granular 'delete galleries'
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $image->delete();
        return response()->json(['message' => 'Gambar berhasil dihapus.']);
    }
}
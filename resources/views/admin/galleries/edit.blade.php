{{-- resources/views/admin/galleries/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Album Galeri: ' . $gallery->title)

@section('header_admin', 'Edit Album Galeri')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-2xl font-bold text-teal-700 mb-6">Edit Album: <span class="text-indigo-700">{{ $gallery->title }}</span></h3>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Pastikan action mengarah ke admin.galleries.update dengan ID galeri --}}
            <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT') {{-- Pastikan ini ada untuk mengubah method POST menjadi PUT --}}

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Album</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('title', $gallery->title) }}" required>
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Album (Opsional)</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('description', $gallery->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Cover Album (Opsional, Maks. 5MB)</label>
                    <input type="file" name="cover_image" id="cover_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                    @if ($gallery->cover_image)
                        <div class="mt-2 flex items-center space-x-2">
                            <p class="text-sm text-gray-600">Cover saat ini:</p>
                            <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="Cover Album" class="h-24 w-auto object-cover rounded-md shadow-sm">
                            <div class="flex items-center">
                                <input type="checkbox" name="delete_existing_cover" id="delete_existing_cover" value="1" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300 rounded">
                                <label for="delete_existing_cover" class="ml-2 text-sm text-red-600">Hapus Cover</label>
                            </div>
                        </div>
                    @endif
                    @error('cover_image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="is_published" class="block text-sm font-medium text-gray-700">Status Publikasi</label>
                    <div class="flex items-center space-x-3 mt-2">
                        <input type="hidden" name="is_published" value="0"> {{-- Hidden field untuk memastikan nilai 0 terkirim jika tidak dicentang --}}
                        <input type="checkbox" name="is_published" id="is_published" value="1"
                               class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded"
                               {{ old('is_published', $gallery->is_published) ? 'checked' : '' }}>
                        <label for="is_published" class="text-sm text-gray-900">Publikasikan Album ini</label>
                    </div>
                    @error('is_published')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Gambar Dalam Album</h3>
                <p class="text-sm text-gray-600 mb-4">Kelola gambar yang sudah ada (ubah keterangan/urutan) atau tambahkan gambar baru.</p>

                <div id="existing-images-container" class="space-y-4 mb-6">
                    @foreach ($gallery->images->sortBy('order') as $image)
                        <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-4 p-3 border border-gray-200 rounded-md bg-gray-50 existing-image-item" id="image-{{ $image->id }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}" class="h-20 w-20 object-cover rounded-md flex-shrink-0">
                            <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-2 w-full">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Keterangan Gambar</label>
                                    <input type="text" name="existing_images[{{ $image->id }}][caption]" class="mt-1 block w-full px-3 py-1 border border-gray-300 rounded-md shadow-sm text-base" value="{{ old('existing_images.' . $image->id . '.caption', $image->caption) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Urutan</label>
                                    <input type="number" name="existing_images[{{ $image->id }}][order]" class="mt-1 block w-full px-3 py-1 border border-gray-300 rounded-md shadow-sm text-base" value="{{ old('existing_images.' . $image->id . '.order', $image->order) }}">
                                </div>
                            </div>
                            <button type="button" onclick="deleteExistingImage({{ $image->id }}, this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm font-semibold flex-shrink-0">Hapus Gambar</button>
                        </div>
                    @endforeach
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Tambah Gambar Baru</h3>
                <div id="new-image-upload-container" class="space-y-4">
                    {{-- Template for new image upload --}}
                    <div class="flex items-end space-x-2 new-image-upload-item">
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Gambar</label>
                            <input type="file" name="new_images[0][image]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" accept="image/*">
                            @error('new_images.0.image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Keterangan Gambar (Opsional)</label>
                            <input type="text" name="new_images[0][caption]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>
                        <button type="button" onclick="removeNewImageField(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm font-semibold flex-shrink-0">Hapus</button>
                    </div>
                </div>
                <button type="button" id="add-new-image-field" class="mt-4 px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600 text-sm font-semibold">Tambah Gambar Baru Lain</button>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-700 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                        Simpan Perubahan Album
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        let newImageIndex = 1; // Start from 1 because the first one is new_images[0]

        document.getElementById('add-new-image-field').addEventListener('click', function() {
            const container = document.getElementById('new-image-upload-container');
            const newItem = document.createElement('div');
            newItem.className = 'flex items-end space-x-2 new-image-upload-item';
            newItem.innerHTML = `
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="new_images[${newImageIndex}][image]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" accept="image/*">
                </div>
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700">Keterangan Gambar (Opsional)</label>
                    <input type="text" name="new_images[${newImageIndex}][caption]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base">
                </div>
                <button type="button" onclick="removeNewImageField(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm font-semibold flex-shrink-0">Hapus</button>
            `;
            container.appendChild(newItem);
            newImageIndex++;
        });

        function removeNewImageField(button) {
            button.closest('.new-image-upload-item').remove();
        }

        // Function to delete existing image via AJAX
        function deleteExistingImage(imageId, button) {
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                fetch(`/admin/galleries/images/${imageId}`, { // Sesuaikan endpoint API Anda
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        button.closest('.existing-image-item').remove(); // Hapus item dari DOM jika sukses
                    } else {
                        alert('Gagal menghapus gambar.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus gambar.');
                });
            }
        }
    </script>
    @endpush
@endsection
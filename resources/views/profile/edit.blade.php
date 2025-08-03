{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.admin') {{-- Menggunakan layout admin yang baru --}}

@section('title', 'Profil Admin') {{-- Judul halaman untuk browser --}}

@section('header_admin', 'Profil Admin') {{-- Judul di top bar admin --}}

@section('admin_content') {{-- Konten utama admin panel --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

{{-- Modal Cropper.js --}}
<div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center" x-show="open" x-cloak>
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full mx-4">
        <h3 class="text-lg font-bold mb-4">Crop Foto</h3>
        <div class="max-w-lg max-h-96">
            <img x-ref="image" :src="imageUrl" alt="Crop Image" class="block max-w-full h-auto">
        </div>
        <div class="mt-4 flex justify-end gap-2">
            <button type="button" @click="resetCropper()" class="px-4 py-2 text-sm font-semibold rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">
                Batal
            </button>
            <button type="button" @click="
                const croppedData = cropper.getCroppedCanvas({ width: 256, height: 256 }).toDataURL();
                document.getElementById('cropped_photo_data').value = croppedData;
                resetCropper();
            " class="px-4 py-2 text-sm font-semibold rounded-md text-white bg-violet-600 hover:bg-violet-700">
                Crop & Simpan
            </button>
        </div>
    </div>
</div>

{{-- Cropper.js CDN --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
@endsection

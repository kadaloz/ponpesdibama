<?php use App\Models\Setting; ?>
{{-- resources/views/admin/settings/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('header_admin', 'Pengaturan Website')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-2xl font-bold text-teal-700 mb-6">Kelola Informasi Website</h3>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Konten Tentang Kami - Menggunakan TinyMCE --}}
                <div>
                    <label for="about_us_content" class="block text-sm font-medium text-gray-700">Konten Tentang Pondok</label>
                    <textarea name="about_us_content" id="about_us_content" rows="12" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('about_us_content', $settings['about_us_content'] ?? '') }}</textarea>
                    @error('about_us_content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kutipan Misi --}}
                <div>
                    <label for="mission_quote" class="block text-sm font-medium text-gray-700">Kutipan Misi</label>
                    <textarea name="mission_quote" id="mission_quote" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('mission_quote', $settings['mission_quote'] ?? '') }}</textarea>
                    @error('mission_quote')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto Pondok --}}
                <div>
                    <label for="pondok_photo" class="block text-sm font-medium text-gray-700">Foto Pondok</label>
                    <input type="file" name="pondok_photo" id="pondok_photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                    @if ($settings['pondok_photo'])
                        <p class="mt-2 text-sm text-gray-600">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $settings['pondok_photo']) }}" alt="Foto Pondok" class="h-32 w-auto object-cover rounded-md mt-2 shadow-sm">
                    @endif
                    @error('pondok_photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Informasi Kontak --}}
                <h4 class="text-xl font-bold text-gray-800 pt-4 border-t border-gray-200">Informasi Kontak</h4>
                <div>
                    <label for="contact_address" class="block text-sm font-medium text-gray-700">Alamat Kontak</label>
                    <input type="text" name="contact_address" id="contact_address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('contact_address', $settings['contact_address'] ?? '') }}">
                    @error('contact_address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon/HP</label>
                    <input type="text" name="contact_phone" id="contact_phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
                    @error('contact_phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input type="email" name="contact_email" id="contact_email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                    @error('contact_email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- URL Peta Lokasi (iframe Google Maps) --}}
                <div>
                    <label for="location_map_url" class="block text-sm font-medium text-gray-700">URL Peta Lokasi (iframe Google Maps Embed)</label>
                    <input type="url" name="location_map_url" id="location_map_url" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('location_map_url', $settings['location_map_url'] ?? '') }}" placeholder="Contoh: https://www.google.com/maps/embed?pb=!1m18...">
                    @error('location_map_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @if ($settings['location_map_url'])
                        <p class="mt-2 text-sm text-gray-600">Pratinjau Peta:</p>
                        <div class="mt-2 w-full h-64 bg-gray-100 border border-gray-300 rounded-md overflow-hidden">
                            <iframe src="{{ $settings['location_map_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    @endif
                </div>

                {{-- Kontrol Status PPDB - Toggle Switch --}}
                <div class="pt-4 border-t border-gray-200">
                    <label for="is_ppdb_open" class="block text-xl font-bold text-gray-800 mb-2">Status Pendaftaran PSB</label>
                    <div class="flex items-center space-x-3">
                        <input type="hidden" name="is_ppdb_open" value="0"> {{-- Hidden input untuk mengirim nilai 0 jika checkbox tidak dicentang --}}
                        <input type="checkbox" name="is_ppdb_open" id="is_ppdb_open" value="1"
                               class="focus:ring-teal-500 h-5 w-5 text-teal-600 border-gray-300 rounded"
                               {{ old('is_ppdb_open', $settings['is_ppdb_open']) ? 'checked' : '' }}>
                        <label for="is_ppdb_open" class="text-lg font-medium text-gray-700">Aktifkan Pendaftaran PSB Online</label>
                    </div>
                    @error('is_ppdb_open')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tahun Ajaran PPDB --}}
                <div class="pt-4 border-t border-gray-200">
                    <label for="ppdb_academic_year" class="block text-xl font-bold text-gray-800 mb-2">Tahun Ajaran PSB</label>
                    <input type="text" name="ppdb_academic_year" id="ppdb_academic_year"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base"
                           value="{{ old('ppdb_academic_year', $settings['ppdb_academic_year'] ?? '') }}" placeholder="Contoh: 2024/2025">
                    @error('ppdb_academic_year')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Teks Heading CTA Pendaftaran --}}
                <div class="pt-4 border-t border-gray-200">
                    <label for="cta_enrollment_heading" class="block text-xl font-bold text-gray-800 mb-2">Teks Heading Pendaftaran Utama</label>
                    <input type="text" name="cta_enrollment_heading" id="cta_enrollment_heading"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base"
                           value="{{ old('cta_enrollment_heading', $settings['cta_enrollment_heading'] ?? '') }}" placeholder="Siapkan Masa Depan Gemilang...">
                    @error('cta_enrollment_heading')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 focus:bg-teal-600 active:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
    {{-- TinyMCE CDN --}}
    <script src="https://cdn.tiny.cloud/1/5z7dyo2elrz9pbgfp27oma4dyd1o43erntiuom6kypppmriu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#about_us_content',
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar_mode: 'floating',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_style: 'body { font-family:Inter,sans-serif; font-size:16px }'
        });
    </script>
@endpush
@endsection

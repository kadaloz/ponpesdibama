@php use App\Models\Setting; @endphp
{{-- resources/views/admin/settings/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('header_admin', 'Pengaturan Website')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-2xl font-bold text-teal-700 mb-6">Kelola Informasi Website</h3>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Tentang Pondok --}}
            <div>
                <label for="about_us_content" class="block text-sm font-medium text-gray-700">Konten Tentang Pondok</label>
                <textarea name="about_us_content" id="about_us_content" rows="12" class="ckeditor mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('about_us_content', $settings['about_us_content'] ?? '') }}</textarea>
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
                <input type="file" name="pondok_photo" id="pondok_photo" class="mt-1 block w-full text-sm text-gray-500 file:rounded-md file:border-0 file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                @if ($settings['pondok_photo'])
                    <p class="mt-2 text-sm text-gray-600">Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $settings['pondok_photo']) }}" alt="Foto Pondok" class="h-32 w-auto object-cover rounded-md mt-2 shadow-sm">
                @endif
                @error('pondok_photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kontak --}}
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

            {{-- Peta --}}
            <div>
                <label for="location_map_url" class="block text-sm font-medium text-gray-700">URL Peta Lokasi (iframe Google Maps Embed)</label>
                <input type="url" name="location_map_url" id="location_map_url" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('location_map_url', $settings['location_map_url'] ?? '') }}" placeholder="https://www.google.com/maps/embed?...">
                @error('location_map_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                @if ($settings['location_map_url'])
                    <div class="mt-2 w-full h-64 border rounded-md overflow-hidden">
                        <iframe src="{{ $settings['location_map_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                @endif
            </div>

{{-- PPDB Tipe Pendaftaran --}}
<div x-data="{ ppdbOpen: {{ old('is_ppdb_open', $settings['is_ppdb_open']) ? 'true' : 'false' }} }">
    {{-- Toggle PPDB --}}
    <div class="pt-4 border-t border-gray-200">
        <label for="is_ppdb_open" class="block text-xl font-bold text-gray-800 mb-2">
            Status Pendaftaran PSB
        </label>
        <div class="flex items-center space-x-3">
            <input type="hidden" name="is_ppdb_open" value="0">
            <input
                type="checkbox"
                name="is_ppdb_open"
                id="is_ppdb_open"
                value="1"
                x-model="ppdbOpen"
                class="h-5 w-5 text-teal-600 border-gray-300 rounded"
                {{ old('is_ppdb_open', $settings['is_ppdb_open']) ? 'checked' : '' }}
            >
            <label for="is_ppdb_open" class="text-lg font-medium text-gray-700">
                Aktifkan PSB Online
            </label>
        </div>
    </div>

    {{-- Tipe Pendaftaran --}}
    <div class="pt-4" x-show="ppdbOpen" x-transition>
        <label class="block text-xl font-bold text-gray-800 mb-2">
            Tipe Pendaftaran yang Dibuka
        </label>
        <div class="flex items-center space-x-6">
            {{-- Asrama --}}
            <div class="flex items-center space-x-2">
                <input type="hidden" name="ppdb_asrama_open" value="0">
                <input
                    type="checkbox"
                    name="ppdb_asrama_open"
                    id="ppdb_asrama_open"
                    value="1"
                    class="h-5 w-5 text-teal-600 border-gray-300 rounded"
                    {{ old('ppdb_asrama_open', $settings['ppdb_asrama_open']) ? 'checked' : '' }}
                >
                <label for="ppdb_asrama_open" class="text-lg font-medium text-gray-700">
                    Asrama
                </label>
            </div>

            {{-- Pulang-Pergi --}}
            <div class="flex items-center space-x-2">
                <input type="hidden" name="ppdb_pulang_pergi_open" value="0">
                <input
                    type="checkbox"
                    name="ppdb_pulang_pergi_open"
                    id="ppdb_pulang_pergi_open"
                    value="1"
                    class="h-5 w-5 text-teal-600 border-gray-300 rounded"
                    {{ old('ppdb_pulang_pergi_open', $settings['ppdb_pulang_pergi_open']) ? 'checked' : '' }}
                >
                <label for="ppdb_pulang_pergi_open" class="text-lg font-medium text-gray-700">
                    Pulang-Pergi
                </label>
            </div>
        </div>
    </div>
</div>



            {{-- Tahun Ajaran --}}
            <div class="pt-4 border-t border-gray-200">
                <label for="ppdb_academic_year" class="block text-xl font-bold text-gray-800 mb-2">Tahun Ajaran PSB</label>
                <input type="text" name="ppdb_academic_year" id="ppdb_academic_year" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" value="{{ old('ppdb_academic_year', $settings['ppdb_academic_year'] ?? '') }}">
            </div>

            {{-- CTA --}}
            <div class="pt-4 border-t border-gray-200">
                <label for="cta_enrollment_heading" class="block text-xl font-bold text-gray-800 mb-2">Teks Heading Pendaftaran Utama</label>
                <input type="text" name="cta_enrollment_heading" id="cta_enrollment_heading" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" value="{{ old('cta_enrollment_heading', $settings['cta_enrollment_heading'] ?? '') }}">
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-500 text-white font-semibold text-sm uppercase tracking-widest rounded-md hover:bg-teal-600 transition">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    {{-- CKEditor 5 CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#about_us_content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
@endsection

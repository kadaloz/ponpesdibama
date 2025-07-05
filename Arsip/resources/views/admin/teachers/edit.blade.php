@extends('layouts.admin')

@section('title', 'Edit Pengajar: ' . $teacher->full_name)
@section('header_admin', 'Edit Data Pengajar')

@section('admin_content')
<div class="bg-white shadow rounded-xl overflow-hidden">
    <div class="p-6 text-gray-900 space-y-8">
        <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <h3 class="text-2xl font-bold text-teal-700 border-b pb-3">Formulir Edit Pengajar</h3>
            </div>

            {{-- Informasi Dasar --}}
            <section class="space-y-4">
                <div>
                    <x-input-label for="full_name" value="Nama Lengkap *" />
                    <x-text-input id="full_name" name="full_name" type="text" class="w-full" required
                        value="{{ old('full_name', $teacher->full_name) }}" />
                    <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="nip" value="NIP (Opsional)" />
                    <x-text-input id="nip" name="nip" type="text" class="w-full"
                        value="{{ old('nip', $teacher->nip) }}" />
                    <x-input-error :messages="$errors->get('nip')" class="mt-1" />
                </div>
            </section>

            {{-- Data Pribadi --}}
            <section>
                <h4 class="text-lg font-semibold text-gray-700 mt-6 mb-3">Data Pribadi</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="gender" value="Jenis Kelamin" />
                        <select name="gender" id="gender" class="w-full border-gray-300 rounded-md">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('gender', $teacher->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender', $teacher->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="place_of_birth" value="Tempat Lahir" />
                        <x-text-input id="place_of_birth" name="place_of_birth" type="text" class="w-full"
                            value="{{ old('place_of_birth', $teacher->place_of_birth) }}" />
                        <x-input-error :messages="$errors->get('place_of_birth')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="date_of_birth" value="Tanggal Lahir" />
                        <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="w-full"
                            value="{{ old('date_of_birth', optional($teacher->date_of_birth)->format('Y-m-d')) }}" />
                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="phone_number" value="No. HP / Telepon" />
                        <x-text-input id="phone_number" name="phone_number" type="text" class="w-full"
                            value="{{ old('phone_number', $teacher->phone_number) }}" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-1" />
                    </div>
                </div>
            </section>

            {{-- Informasi Akademik --}}
            <section>
                <h4 class="text-lg font-semibold text-gray-700 mt-6 mb-3">Informasi Akademik</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="specialization" value="Spesialisasi" />
                        <x-text-input id="specialization" name="specialization" type="text" class="w-full"
                            value="{{ old('specialization', $teacher->specialization) }}" />
                        <x-input-error :messages="$errors->get('specialization')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="join_date" value="Tanggal Bergabung" />
                        <x-text-input id="join_date" name="join_date" type="date" class="w-full"
                            value="{{ old('join_date', optional($teacher->join_date)->format('Y-m-d')) }}" />
                        <x-input-error :messages="$errors->get('join_date')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="status" value="Status Aktif" />
                        <select name="status" id="status" class="w-full border-gray-300 rounded-md" required>
                            <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-1" />
                    </div>
                </div>
            </section>

            {{-- Akun Terkait --}}
            <section>
                <h4 class="text-lg font-semibold text-gray-700 mt-6 mb-3">Relasi Akun</h4>
                <x-input-label for="user_id" value="Hubungkan dengan Akun Pengguna" />
                <p class="text-sm text-gray-600 mb-2">Hanya menampilkan user dengan role "mudabbir" yang belum memiliki pengajar.</p>
                <select name="user_id" id="user_id" class="w-full border-gray-300 rounded-md">
                    <option value="">Tidak Dihubungkan</option>
                    @isset($unassignedUsers)
                        @foreach ($unassignedUsers as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $teacher->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }}) - {{ $user->getRoleNames()->implode(', ') }}
                            </option>
                        @endforeach
                    @endisset
                </select>
                <x-input-error :messages="$errors->get('user_id')" class="mt-1" />
            </section>

            {{-- Tombol --}}
            <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                <a href="{{ route('admin.teachers.index') }}"
                    class="inline-flex items-center text-sm px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full shadow-sm">
                    <x-heroicon-o-arrow-left class="w-4 h-4 mr-2" />
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold text-sm rounded-full shadow">
                    <x-heroicon-o-pencil class="w-4 h-4 mr-2" />
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

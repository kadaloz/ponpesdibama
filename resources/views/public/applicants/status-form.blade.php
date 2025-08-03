@extends('web.apps')
@section('title', 'Cek Status Pendaftaran - PonpesDIBAMA')
@section('meta_description', 'Cek status pendaftaran Anda di PonpesDIBAMA. Masukkan nomor pendaftaran untuk melihat status.')
@section('meta_keywords', 'ppdb online, cek status pendaftaran, pondok pesantren, pendidikan islam')
@section('meta_image', asset('storage/images/logo/pondok.png'))
@section('main_content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Cek Status Pendaftaran</h2>

    <form method="GET" action="{{ route('ppdb.applicants.status') }}">
        <label for="reg_num" class="block mb-2 font-medium">Nomor Registrasi</label>
        <input type="text" name="reg_num" id="reg_num"
               class="w-full p-2 border rounded" value="{{ old('reg_num') }}">
        @error('reg_num')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="mt-4 px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
            Cek Status
        </button>
    </form>
</div>
@endsection

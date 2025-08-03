@extends('web.apps')
@section('title', 'Cek Status Pendaftaran - PonpesDIBAMA')
@section('meta_description', 'Cek status pendaftaran Anda di PonpesDIBAMA. Masukkan nomor pendaftaran untuk melihat status.')
@section('meta_keywords', 'ppdb online, cek status pendaftaran, pondok pesantren, pendidikan islam')
@section('meta_image', asset('storage/images/logo/pondok.png'))

@section('main_content')
<section class="py-20 bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 max-w-xl">
        <div class="bg-white p-8 md:p-10 rounded-xl shadow-lg border border-gray-200">
            
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Cek Status Pendaftaran</h2>
                <p class="text-gray-600">Masukkan nomor registrasi Anda untuk melihat status pendaftaran terbaru.</p>
            </div>

            <form method="GET" action="{{ route('ppdb.applicants.status') }}" class="space-y-4">
                <div>
                    <label for="reg_num" class="block mb-2 text-lg font-medium text-gray-700">
                        Nomor Registrasi
                    </label>
                    <input type="text" name="reg_num" id="reg_num" placeholder="Contoh: PPDB-12345"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" 
                           value="{{ old('reg_num') }}" required>
                    @error('reg_num')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full px-6 py-3 bg-teal-600 text-white font-semibold rounded-lg shadow-md hover:bg-teal-700 transition-colors">
                        Cek Status
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>
@endsection
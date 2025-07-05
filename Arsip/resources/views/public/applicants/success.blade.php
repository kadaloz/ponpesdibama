{{-- resources/views/public/applicants/success.blade.php --}}
@extends('web.apps') {{-- Menggunakan layout utama website --}}

@section('title', 'Pendaftaran Berhasil - PonpesDIBAMA')

@section('main_content')
    <section class="py-24 md:py-40 bg-gradient-to-r from-teal-600 to-green-600 text-white flex items-center justify-center min-h-[80vh] rounded-b-lg shadow-xl"> {{-- Tinggi min-h lebih besar --}}
        <div class="container mx-auto text-center px-4">
            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 drop-shadow-md">
                Pendaftaran Berhasil Dikirim!
            </h2>
            <p class="text-xl md:text-2xl mb-8 opacity-90">
                Terima kasih telah mendaftar di Ponpes DIBAMA.
            </p>
            @if (session('success'))
                <p class="text-lg md:text-xl font-semibold mb-8 bg-white text-teal-800 p-4 rounded-lg shadow-md mx-auto max-w-lg">
                    {{ session('success') }}
                </p>
            @endif

            <div class="bg-white text-gray-800 p-8 rounded-xl shadow-lg mx-auto max-w-lg">
                <h3 class="text-2xl font-bold text-teal-700 mb-4">Informasi Verifikasi Daftar Ulang</h3>
                <p class="mb-4 text-lg">
                    Simpan nomor pendaftaran ini untuk proses verifikasi dan daftar ulang:
                </p>
                <p class="text-3xl md:text-4xl font-extrabold text-blue-700 mb-6 break-words">
                    {{ $registrationNumber ?? 'Tidak Tersedia' }}
                </p>

                @if ($registrationNumber)
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-2">Barcode Verifikasi:</p>
                        <svg id="barcodeSvg" class="mx-auto w-full max-w-[250px] h-auto"></svg> {{-- SVG element untuk barcode --}}
                    </div>
                @endif

                <p class="text-md text-gray-600">
                    Silakan cetak halaman ini atau catat nomor pendaftaran Anda.
                    Kami akan menghubungi Anda untuk informasi selanjutnya.
                </p>
            </div>

            <div class="mt-8">
                <a href="{{ url('/') }}" class="inline-flex items-center px-8 py-4 bg-white text-teal-700 rounded-full text-lg font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
    {{-- JsBarcode CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registrationNumber = "{{ $registrationNumber ?? '' }}";
            if (registrationNumber) {
                // Generate Barcode
                JsBarcode("#barcodeSvg", registrationNumber, {
                    format: "CODE128", // Atau EAN13, CODE39, dll. Sesuaikan kebutuhan
                    displayValue: true,
                    width: 2,
                    height: 100,
                    margin: 10,
                    textMargin: 0,
                    font: "Inter", // Menggunakan font Inter
                    fontSize: 18,
                });
            }
        });
    </script>
    @endpush
@endsection
